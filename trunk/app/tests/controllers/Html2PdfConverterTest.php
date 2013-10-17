<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 12/10/13
 * Time: 5:00 PM
 * To change this template use File | Settings | File Templates.
 */
use Zizaco\FactoryMuff\Facade\FactoryMuff;

class Html2PdfConverterTest extends TestCase
{

    public function tearDown()
    {
        \Mockery::close();
    }

    public function testPdfConverter()
    {
        $user = new User();
        $user->fill(array('id' => 1, 'accessUsername' => "rgf",
            'accessKey' => "dsfd",
            'username' => '',
            'password' => 'password'));
        $converter = new Converter();
        $converter->fill(array(
            'id' => 1,
            'name' => 1,
            'location' => 1,
            'status' => ConverterStatuses::IDLE));

        $transaction = new Transaction();
        $transaction->fill(array(
            'id' => 1,
            'converterId' => 1,
            'userId' => 1,
            'fileName' => 'string',
            'fileSize' => 10000,
            'tokens' => 1,
            'startTime' => new DateTime(),
            'endTime' => new DateTime(),
            'processId' => 1
        ));

        $converterService = \Mockery::mock('ConverterService');
        $this->app->instance('ConverterService', $converterService);

        $transactionService = \Mockery::mock('TransactionService');
        $this->app->instance('TransactionService', $transactionService);

        $pdfConverter = \Mockery::mock('PDFConverter');
        $this->app->instance('PDFConverter', $pdfConverter);

        $userMock = \Mockery::mock('UserService');
        $this->app->instance('UserService', $userMock);

        $userMock->shouldReceive('getUser')->andReturn($user);

        $converterService->shouldReceive('getConverter')->andReturn($converter);
        $converterService->shouldReceive('getLock')->andReturn();
        $converterService->shouldReceive('releaseLock')->andReturn();
        $pdfConverter->shouldReceive('convert')->andReturn(array('filePath' => public_path() . '/robots.txt', 'processId' => 1));

        $transactionService->shouldReceive('create')->once()->andReturn($transaction);
        $transactionService->shouldReceive('updateTransaction')->once()->andReturn($transaction);

        $processService = \Mockery::mock('ProcessService');
        $this->app->instance('ProcessService', $processService);
        $processService->shouldReceive('isProcessRunning')->once()->andReturn(false);
        $processService->shouldReceive('killProcess')->andReturn();

        $params = array(
            'accessUsername' => 'string',
            'accessKey' => 'string',
            'HTMLContent' => '<html><body>Test</body></html>'
        );
        $response = $this->action('POST', 'Html2PdfConverterController@postPdf', $params);
        $this->assertResponseOk();
    }

}