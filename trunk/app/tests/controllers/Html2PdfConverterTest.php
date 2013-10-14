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
        $user = FactoryMuff::create('User');
        $converter = FactoryMuff::create('Converter');
        $transaction = FactoryMuff::create('Transaction');

        $converterService = \Mockery::mock('ConverterService');
        $this->app->instance('ConverterService', $converterService);

        $transactionService = \Mockery::mock('TransactionService');
        $this->app->instance('TransactionService', $transactionService);

        $pdfConverter = \Mockery::mock('PDFConverter');
        $this->app->instance('PDFConverter', $pdfConverter);

        $userMock = \Mockery::mock('UserService');
        $this->app->instance('UserService', $userMock);

        $userRepoMock = Mockery::mock('UserRepositoryInterface');
        $this->app->instance('UserRepositoryInterface', $userRepoMock);
        $userRepoMock->shouldReceive('getUser')->andReturn($user);

        $convertRepoInterfaceMock = Mockery::mock('ConverterRepositoryInterface');
        $this->app->instance('ConverterRepositoryInterface', $convertRepoInterfaceMock);

        $transactionRepositoryInterfaceMock = Mockery::mock('TransactionRepositoryInterface');
        $this->app->instance('TransactionRepositoryInterface', $transactionRepositoryInterfaceMock);

        $convertRepoInterfaceMock->shouldReceive('getConverter')->andReturn($converter);
        $convertRepoInterfaceMock->shouldReceive('getLock');
        $transactionRepositoryInterfaceMock->shouldReceive('create');


        $params = array(
            'accessUsername' => 'string',
            'accessKey' => 'string',
            'url' => 'http://www.google.com'
        );

        $response = $this->action('POST', 'Html2PdfConverterController@postPdf', $params);
        $this->assertTrue($response->isOk());


    }

}