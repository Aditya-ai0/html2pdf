<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 10/9/13
 * Time: 1:57 AM
 * To change this template use File | Settings | File Templates.
 */

class Html2PdfConverter
{

    private $converterService;
    private $transactionService;
    private $pdfConverter;


    public function __construct(ConverterService $converterService, TransactionService $transactionService,
                                PDFConverter $pdfConverter)
    {
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

        if (is_null($url) || is_null($htmlContent))
            App::abort(400, Lang::get('responseMessages.badRequest'));
        $user = Auth::getUser();

        if (!$htmlContent)
            $html = File::get($url);
        else
            $html = $htmlContent;
        $converter = $this->converterService->getConverter(null, null, null, 0);
        $transaction = $this->transactionService->create($converter->id, $name, null, null, new DateTime(), null, null, false);
//        TODO: add handler when all converters are busy
//        if (is_null($converter))
//            ;

        $pdfConverterDetails = $this->pdfConverter->convert($html);
        $fileSize = File::size($pdfConverterDetails['filePath']);
        //TODO : killed
        if ($fileSize == 0)
            $fileSize = 512;
        $tokens = ceil($fileSize / 512);
        $transaction = $this->transactionService->updateTransaction($transaction->id, null, null, $fileSize, $tokens,
            null, new DateTime(), $pdfConverterDetails['processId'], false);

    }
}