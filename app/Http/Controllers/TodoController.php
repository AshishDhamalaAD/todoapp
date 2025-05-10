<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $todos = Todo::query()
            ->where('user_id', Auth::id())
            // ->latest('id')
            ->latest('reminder_at')
            ->paginate(10);

        return view('todos.index', [
            'todos' => $todos,
        ]);
    }
}
