<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the todos for the authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $todos = $user->todos()->orderBy('created_at', 'desc')->get();
        // return response()->json($todos);

        return inertia('Dashboard', [
            'todos' => $todos, // response()->json($todos),
        ]);
    }

    /**
     * Store a newly created todo in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|in:pending,backlog,complete',
            'priority' => 'required|string',
        ]);

        $todo = Auth::user()->todos()->create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'priority' => $request->priority,
        ]);

        // return response()->json($todo, 201);
        return redirect()->back()->with('success', 'Todo created successfully.');
    }

    // update
    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|string|in:pending,backlog,complete',
            'priority' => 'sometimes|string',
        ]);

        $todo = Todo::findOrFail($id);

        // Ensure the authenticated user is the owner of the todo
        if ($todo->user_id !== $request->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $todo->update($request->only(['title', 'description', 'status', 'priority']));

        return redirect()->route('dashboard')->with('success', 'Todo updated successfully.');
    }

    // delete
    public function destroy(Request $request, $id)
    {
        $todo = Todo::findOrFail($id);

        if ($todo->user_id !== $request->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $todo->delete();

        return redirect()->route('dashboard')->with('success', 'Todo deleted successfully.');
    }
}
