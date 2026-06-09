<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Category;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    public function index()
    {
        $userId = session('user_id');
        $goals = Goal::where('user_id', $userId)->get();
        return view('goals.index', compact('goals'));
    }

    public function create()
    {
        $categories = $this->ensureCategories();
        return view('goals.create', compact('categories'));
    }

    protected function ensureCategories()
    {
        if (!Category::count()) {
            $defaultCategories = ['Health', 'Career', 'Personal', 'Learning', 'Finance'];
            foreach ($defaultCategories as $name) {
                Category::updateOrCreate(
                    ['nama' => $name],
                    ['deskripsi' => "Default category for {$name}"]
                );
            }
        }

        return Category::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'progress' => 'required|integer|min:0|max:100',
        ]);

        $data = $request->only(['title', 'category', 'description', 'progress']);
        $data['user_id'] = session('user_id');

        Goal::create($data);

        return redirect()->route('goals.index')->with('success', 'Goal successfully added.');
    }

    public function edit($id)
    {
        $goal = Goal::findOrFail($id);
        if ($goal->user_id !== session('user_id')) {
            abort(403);
        }
        $categories = $this->ensureCategories();

        return view('goals.edit', compact('goal', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $goal = Goal::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'progress' => 'required|integer|min:0|max:100',
        ]);

        if ($goal->user_id !== session('user_id')) {
            abort(403);
        }

        $goal->update($request->only(['title', 'category', 'description', 'progress']));

        return redirect()->route('goals.index')->with('success', 'Goal updated successfully.');
    }

    public function destroy($id)
    {
        Goal::destroy($id);

        return redirect()->route('goals.index')->with('success', 'Goal deleted successfully.');
    }
}
