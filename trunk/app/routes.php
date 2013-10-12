<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

App::bind('UserRepositoryInterface', 'EloquentUserRepository');
App::bind('ConverterRepositoryInterface', 'EloquentConverterRepository');
App::bind('TransactionRepositoryInterface', 'EloquentTransactionRepository');
App::bind('PDFConverter', 'WKHTMLPDfConverter');

Route::controller('user', 'UserController');
Route::controller('converter', 'ConverterController');
Route::controller('/', 'Html2PdfConverterController');


