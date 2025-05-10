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
        return view('todos.create', [
            'todo' => new Todo(),
        ]);
    }

    public function store(TodoRequest $request)
    {
        Todo::create($request->safe()->merge([
            'user_id' => Auth::id(),
        ])->all());

        return to_route('todo.index')
            ->with('success_message', 'Todo Created Successfully.');
    }

    public function edit(Request $request, Todo $todo)
    {
        return view('todos.create', [
            'todo' => $todo,
        ]);
    }

    public function update(TodoRequest $request, Todo $todo)
    {
        $todo->update($request->safe()->merge([
            'user_id' => Auth::id(),
        ])->all());

        return to_route('todo.index')
            ->with('success_message', 'Todo Updated Successfully.');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return back()
            ->with('success_message', 'Todo Deleted Successfully.');
    }
}
