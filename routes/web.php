<?php

use FreelancerConnect\Controllers\Auth;
use Pecee\SimpleRouter\SimpleRouter as Route;

Route::group(['prefix' => '/freelancer-connect'], function (){
    Route::get('/', [Auth::class, 'index']);
    Route::post('/login', [Auth::class, 'login']);
});