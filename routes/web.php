<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\TaskController;
use App\Models\User;
use App\Models\Goal;
use App\Models\Habit;
use App\Models\Task;

// ==========================================
// 1. TAMPILAN UTAMA & READ DATA (Dashboard)
// ==========================================
Route::get('/dashboard', function () {
    if (!session('user_email')) {
        return redirect()->route('login');
    }

    $userId = session('user_id');

    $goals = Goal::where('user_id', $userId)->get();
    $habits = Habit::with('user')->where('user_id', $userId)->get();
    $tasks = Task::with(['goal', 'habit', 'user'])->where('user_id', $userId)->orderBy('tanggal')->get();

    $completedTasks = $tasks->where('status', 'completed')->count();
    $productivityScore = $tasks->count() ? round($completedTasks / $tasks->count() * 100) : 0;

    $today = Carbon::today();
    $weekly = collect(range(0, 6))->mapWithKeys(function ($day) use ($today, $tasks) {
        $date = $today->copy()->addDays($day);
        $count = $tasks->where('tanggal', $date->toDateString())->count();
        return [$date->format('D') => min(100, $count * 20)];
    })->toArray();

    $upcoming = $tasks->where('status', 'pending')->sortBy('tanggal')->take(5);

    return view('dashboard', compact('goals', 'habits', 'tasks', 'weekly', 'productivityScore', 'upcoming'));
})->name('dashboard');

// ==========================================
// 2. AUTH SYSTEM (Login, Register, Logout)
// ==========================================
Route::get('/', function () {
    return view('landing');
})->name('home');

Route::get('/landing', function () {
    return view('landing');
})->name('landing');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $data = $request->only(['email', 'password']);
    if (!empty($data['email']) && !empty($data['password'])) {
        // ensure a User exists and store the id in session so data is scoped per-account
        $user = User::firstOrCreate(
            ['email' => $data['email']],
            [
                'name' => Str::before($data['email'], '@'),
                'password' => bcrypt('password123'),
            ]
        );

        $request->session()->put('user_email', $user->email);
        $request->session()->put('user_name', ucfirst($user->name));
        $request->session()->put('user_id', $user->id);

        return redirect()->route('dashboard');
    }
    return back()->with('error', 'Masukkan email dan password');
});

Route::get('/register', function () {
    return view('auth.register'); 
})->name('register');

Route::post('/register', function (Request $request) {

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:6',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    return redirect()->route('login')
        ->with('success', 'Registrasi berhasil!');
});

Route::post('/logout', function (Request $request) {
    $request->session()->flush();
    return redirect('/landing');
})->name('logout');

Route::get('/settings', function () {
    return view('setting_static');
})->name('settings');

// ==========================================
// 3. RESOURCE CONTROLLERS
// ==========================================
Route::resource('users', UserController::class);
Route::resource('categories', CategoryController::class);
Route::resource('goals', GoalController::class)->except(['show']);
Route::resource('habits', HabitController::class)->except(['show']);
Route::resource('tasks', TaskController::class)->except(['show']);

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