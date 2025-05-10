<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $todos = Todo::query()
            ->where('user_id', Auth::id())
            ->latest('id')
            // ->latest('reminder_at')
            ->paginate(10);

        return view('todos.index', [
            'todos' => $todos,
        ]);
    }

    public function create(Request $request)
    {
        return view('todos.create');
    }

    public function store(TodoRequest $request)
    {
        Todo::create($request->safe()->merge([
            'user_id' => Auth::id(),
        ])->all());

        return to_route('todo.index')
            ->with('success_message', 'Todo Created Successfully.');
    }
}
