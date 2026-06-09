<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GoalController;
use App\Models\User;
use App\Models\Goal;

// ==========================================
// 1. TAMPILAN UTAMA & READ DATA (Dashboard)
// ==========================================
Route::get('/dashboard', function () {
    $users = User::all();
    $goals = Goal::all(); 
    return view('dashboard_static', compact('users', 'goals'));
})->name('dashboard');

// ==========================================
// 2. AUTH SYSTEM (Login, Register, Logout)
// ==========================================
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', function () {
    return view('login_static');
})->name('login');

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

Route::get('/register', function () {
    return view('auth.register'); 
})->name('register');

Route::post('/logout', function (Request $request) {
    $request->session()->flush();
    return redirect('/');
});

Route::get('/settings', function () {
    return view('setting_static');
})->name('settings');

// ==========================================
// 3. CRUD SYSTEM (Proses Simpan & Hapus)
// ==========================================

// CRUD USERS
Route::post('/users/store', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
    ]);
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt('password123'),
    ]);
    return redirect()->route('dashboard')->with('success', 'User berhasil ditambahkan!');
})->name('users.store');

Route::delete('/users/delete/{id}', function ($id) {
    User::findOrFail($id)->delete();
    return redirect()->route('dashboard')->with('success', 'User berhasil dihapus!');
})->name('users.delete');

// CRUD GOALS
Route::post('/goals/store', function (Request $request) {
    $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string',
        'progress' => 'required|integer|min:0|max:100',
    ]);
    Goal::create($request->only(['title', 'category', 'progress']));
    return redirect()->route('dashboard')->with('success', 'Goal berhasil ditambahkan!');
})->name('goals.store');

Route::delete('/goals/delete/{id}', function ($id) {
    Goal::findOrFail($id)->delete();
    return redirect()->route('dashboard')->with('success', 'Goal berhasil dihapus!');
})->name('goals.delete');


// ==========================================
// 4. RESOURCE CONTROLLERS (Jika dibutuhkan)
// ==========================================
Route::resource('users', UserController::class);
Route::resource('categories', CategoryController::class);
Route::resource('goals', GoalController::class);

Route::view('/dashboard-static', 'dashboard_static');
Route::view('/login-static', 'login_static');

// API Endpoint 1: Mengambil JSON data Goals
Route::get('/api/goals', function() {
    return response()->json(\App\Models\Goal::all());
});

// API Endpoint 2: Mengambil JSON data Users
Route::get('/api/users', function() {
    return response()->json(\App\Models\User::all());
});