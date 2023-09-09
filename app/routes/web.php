<?php
namespace App\routes;
use App\FreelancerConnect\app\controllers\Auth;
use \Pecee\SimpleRouter\SimpleRouter as Route;

Route::group(['prefix' => '/freelancer-connect'], function (){
    Route::get('/', [Auth::class, 'index']);
});