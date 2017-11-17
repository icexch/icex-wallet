<?php

Route::prefix('icex-wallet')->group(function () {
    Route::prefix('nodes')->group(function () {
        Route::group(['prefix' => '{node}'], function() {
            Route::get('/{method}', 'Icex\IcexWallet\Http\Controllers\NodeController@executeMethod');
            //
        });
    });
});