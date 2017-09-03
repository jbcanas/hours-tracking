<?php

use App\Models\Employee;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/login', function() {
    return view('login');
});

Route::any('{all}', function () {
    return view('index');
})
    ->where(['all' => '.*']);
