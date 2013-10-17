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
    private $userService;
    private $processService;


    public function __construct(ConverterService $converterService, TransactionService $transactionService,
                                PDFConverter $pdfConverter, UserService $userService, ProcessService $processService)
    {
        $this->converterService = $converterService;
        $this->transactionService = $transactionService;
        $this->pdfConverter = $pdfConverter;
        $this->userService = $userService;
        $this->processService = $processService;
    }


    public function postPdf()
    {

        $accessKey = Input::get('accessKey', null);
        $accessUserName = Input::get('accessUsername', null);
        $url = Input::get('url', null);
        $htmlContent = Input::get('HTMLContent', null);
        $name = Input::get('name', "");
        $isJavascript = Input::get('javascript', false);
        if (is_null($accessKey || is_null($accessUserName)))
            App::abort(HTTPConstants::NOT_FOUND, Lang::get('responseMessages.invalidUserNamePassword'));

        try {
            $user = $this->userService->getUser(null, $accessUserName, $accessKey, null);

            if (!$user) {
                App::abort(HTTPConstants::AUTHENTICATION_FAILED);
            }

            if (is_null($url) && is_null($htmlContent))
                App::abort(HTTPConstants::NOT_FOUND, Lang::get('responseMessages.badRequest'));

            if (!$htmlContent)
                $html = file_get_contents($url);
            else
                $html = $htmlContent;
            $converter = null;
            for ($timer = 0; $timer < 30; $timer += 1) {
                $converter = $this->converterService->getConverter(null, null, null, ConverterStatuses::IDLE);
                if ($converter) {
                    break;
                }
                sleep(1);
            }

            if (is_null($converter))
                return Response::json(array('error' => Lang::get('responseMessages.serviceUnavailable')), HTTPConstants::SERVICE_NOT_AVAILABLE);

            $this->converterService->getLock($converter->id);

            $transaction = $this->transactionService->create($converter->id, $user->id, $name, 0, 1, new DateTime(),
                null, null, false);
            $pdfConverterDetails = $this->pdfConverter->convert($converter->location, $html);
            // as exec run processes in background, waiting process to run till 1 minute , if duration kill
            $isRunning = true;

            for ($timer = 0; $timer < 60; $timer += 5) {
                if (!$this->processService->isProcessRunning($pdfConverterDetails['processId'])) {
                    $isRunning = false;
                    break;
                }
                sleep(5);
            }
            if ($isRunning)
                $this->processService->killProcess($pdfConverterDetails['processId']);
            $this->converterService->releaseLock($converter->id);
            $fileSize = 0;
            if (File::isFile($pdfConverterDetails['filePath']))
                $fileSize = File::size($pdfConverterDetails['filePath']);
            if ($fileSize == 0)
                $fileSize = 512 * 1024;

            $tokens = ceil($fileSize / (512 * 1024));

            $transaction = $this->transactionService->updateTransaction($transaction->id, null,
                $user->id, null, $fileSize, $tokens,
                null, new DateTime(), $pdfConverterDetails['processId'], $isRunning);
            if (File::isFile($pdfConverterDetails['filePath']))
                return ExtendedResponse::binary($pdfConverterDetails['filePath'], $name);
            else
                return Response::json(array('error' => Lang::get('responseMessages.maximumExecutionTimeout')), HTTPConstants::TIME_OUT);

        } catch (Exception $e) {
            return Response::json(array('error' => Lang::get('responseMessages.internalServer')), HTTPConstants::DATABASE_ERROR_CODE);
        }


    }
}