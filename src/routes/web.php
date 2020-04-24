<?php

Route::group(['namespace' => 'KomjIT\LarAgent\Http\Controllers', 'prefix' => 'komjit/laragent', 'middleware' => ['web']], function () {

    Route::get('get-pdf', 'InvoiceController@getPDF');
    Route::get('create-proforma', 'InvoiceController@createProforma');

});
