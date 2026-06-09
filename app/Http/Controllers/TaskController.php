<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Habit;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $userId = session('user_id');
        $tasks = Task::with(['goal', 'habit', 'user'])->where('user_id', $userId)->orderBy('tanggal')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $userId = session('user_id');
        $goals = Goal::where('user_id', $userId)->orderBy('title')->get();
        $habits = Habit::where('user_id', $userId)->orderBy('nama')->get();

        return view('tasks.create', compact('goals', 'habits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,completed',
            'goal_id' => 'nullable|exists:goals,id',
            'habit_id' => 'nullable|exists:habits,id',
        ]);

        $data = $request->only(['goal_id', 'habit_id', 'judul', 'tanggal', 'priority', 'status']);
        $data['user_id'] = session('user_id');

        Task::create($data);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        if ($task->user_id !== session('user_id')) {
            abort(403);
        }

        $userId = session('user_id');
        $goals = Goal::where('user_id', $userId)->orderBy('title')->get();
        $habits = Habit::where('user_id', $userId)->orderBy('nama')->get();
        $users = User::where('id', $userId)->orderBy('name')->get();

        return view('tasks.edit', compact('task', 'goals', 'habits', 'users'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id !== session('user_id')) {
            abort(403);
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,completed',
            'goal_id' => 'nullable|exists:goals,id',
            'habit_id' => 'nullable|exists:habits,id',
        ]);

        $task->update($request->only(['goal_id', 'habit_id', 'judul', 'tanggal', 'priority', 'status']));

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        if ($task->user_id !== session('user_id')) {
            abort(403);
        }

        Task::destroy($id);

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
