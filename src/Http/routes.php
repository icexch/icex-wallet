<?php

Route::prefix('icex-wallet')->group(function () {
    Route::prefix('nodes')->group(function () {
        Route::group(['prefix' => '{node}'], function() {
            Route::get('/getinfo', 'Icex\IcexWallet\Http\Controllers\NodeController@getInfo');
            //
        });
    });
});