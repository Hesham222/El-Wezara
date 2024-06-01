<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Organization\Http\Controllers')->group(function () {
    Route::prefix(config('Organization.moduleName'))->group(function () {
        require('organization.php');
    });
});
