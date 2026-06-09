<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use App\Models\User;
use Illuminate\Http\Request;

class HabitController extends Controller
{
    public function index()
    {
        $userId = session('user_id');
        $habits = Habit::with('user')->where('user_id', $userId)->orderBy('nama')->get();
        return view('habits.index', compact('habits'));
    }

    public function create()
    {
        return view('habits.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'frekuensi' => 'required|in:daily,weekly,monthly',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->only(['nama', 'frekuensi', 'status']);
        $data['user_id'] = session('user_id');

        Habit::create($data);

        return redirect()->route('habits.index')->with('success', 'Habit successfully added.');
    }

    public function edit($id)
    {
        $habit = Habit::findOrFail($id);
        if ($habit->user_id !== session('user_id')) {
            abort(403);
        }

        $users = User::where('id', session('user_id'))->orderBy('name')->get();

        return view('habits.edit', compact('habit', 'users'));
    }

    public function update(Request $request, $id)
    {
        $habit = Habit::findOrFail($id);

        if ($habit->user_id !== session('user_id')) {
            abort(403);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'frekuensi' => 'required|in:daily,weekly,monthly',
            'status' => 'required|in:active,inactive',
        ]);

        $habit->update($request->only(['nama', 'frekuensi', 'status']));

        return redirect()->route('habits.index')->with('success', 'Habit updated successfully.');
    }

    public function destroy($id)
    {
        $habit = Habit::findOrFail($id);
        if ($habit->user_id !== session('user_id')) {
            abort(403);
        }

        Habit::destroy($id);

        return redirect()->route('habits.index')->with('success', 'Habit deleted successfully.');
    }
}
