<?php

use Illuminate\Support\Facades\Route;

Route::get("/", "App\Http\Controllers\Web\Home@index")->name("home");
