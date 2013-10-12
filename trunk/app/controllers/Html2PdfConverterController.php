<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 10/9/13
 * Time: 1:57 AM
 * To change this template use File | Settings | File Templates.
 */

class Html2PdfConverterController extends BaseController
{

    private $converterService;
    private $transactionService;
    private $pdfConverter;


    public function __construct(ConverterService $converterService, TransactionService $transactionService,
                                PDFConverter $pdfConverter)
    {
        $this->beforeFilter('api.auth',
            array('except' => array()
            )
        );
        $this->converterService = $converterService;
        $this->transactionService = $transactionService;
        $this->pdfConverter = $pdfConverter;

    }


    public function postPdf()
    {

        $accessKey = Input::get('accessKey', null);
        $accessUserName = Input::get('accessUsername', null);
        $url = Input::get('url', null);
        $htmlContent = Input::get('HTMLContent', null);
        $name = Input::get('name', null);
        $isJavascript = Input::get('javascript', false);

        if (is_null($url) && is_null($htmlContent))
            App::abort(400, Lang::get('responseMessages.badRequest'));
        $user = Auth::getUser();

        if (!$htmlContent)
            $html = file_get_contents($url);
        else
            $html = $htmlContent;
        $converter = $this->converterService->getConverter(null, null, null, 0);
//        TODO: add handler when all converters are busy
        if (is_null($converter))
            return Response::json(array('error' => 'All instances are busy'));
        $this->converterService->getLock($converter->id);
        $transaction = $this->transactionService->create($converter->id, $user->id, $name, 0, 1, new DateTime(), null, null, false);

        $pdfConverterDetails = $this->pdfConverter->convert($converter->location, $html);
        // as exec run processes in background
        sleep(10);

        $this->converterService->releaseLock($converter->id);
        $fileSize = File::size($pdfConverterDetails['filePath']);
        //TODO : kill background process
        if ($fileSize == 0)
            $fileSize = 512 * 1024;
        $tokens = ceil($fileSize / (512 * 1024));
        $transaction = $this->transactionService->updateTransaction($transaction->id, null, $user->id, null, $fileSize, $tokens,
            null, new DateTime(), $pdfConverterDetails['processId'], false);
        if (File::isFile($pdfConverterDetails['filePath']))
            return Response::download($pdfConverterDetails['filePath'], $name);
        else
            return Response::json(array('error' => 'maximum execution time exceeded'), 403);

    }
}