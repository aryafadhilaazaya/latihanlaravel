<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/galeri', function () {
    return view('galeri');
});

Route::get('/tentang', function () {
    return view('tentang');
});