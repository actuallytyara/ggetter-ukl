<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GoalController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', function () {
    return view('login_static');
})->name('login');

// Simple session-based demo auth: POST /login will set a session value
Route::post('/login', function (Request $request) {
    $data = $request->only(['email', 'password']);
    if (!empty($data['email']) && !empty($data['password'])) {
        $name = explode('@', $data['email'])[0];
        $request->session()->put('user_email', $data['email']);
        $request->session()->put('user_name', ucfirst($name));
        return redirect('/dashboard');
    }
    return back()->with('error', 'Masukkan email dan password');
});

Route::get('/dashboard', function (Request $request) {
    if ($request->session()->has('user_email')) {
        return view('dashboard_static');
    }
    return redirect()->route('login');
})->name('dashboard');

Route::get('/settings', function () {
    return view('setting_static');
})->name('settings');

Route::post('/logout', function (Request $request) {
    $request->session()->flush();
    return redirect('/');
});

// Keep existing resource routes if needed elsewhere in the app
// Route::resource('users', UserController::class);
// Route::resource('categories', CategoryController::class);
// Route::resource('goals', GoalController::class);
Route::view('/dashboard-static', 'dashboard_static');
Route::view('/login-static', 'login_static');

Route::resource('users', UserController::class);
Route::resource('categories', CategoryController::class);
Route::resource('goals', GoalController::class);