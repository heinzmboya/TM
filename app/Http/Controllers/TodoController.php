<?php

namespace App\Http\Controllers;

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
        $todos = $user->todos; // Assuming a one-to-many relationship
        // return response()->json($todos);

        return inertia('Dashboard', [
            'todos' => $todos, // response()->json($todos),
        ]);
    }
}
