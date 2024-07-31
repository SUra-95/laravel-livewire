<?php

namespace App\Helpers;

use App\Mail\TodoCreatedEmail;
use App\Models\Todo;
use Illuminate\Support\Facades\Mail;

class TodoHelper
{
    public static function createTodo($validated)
    {
        $todo= Todo::create($validated);
        Mail::to(auth()->user()->email)->send(new TodoCreatedEmail([
            'name' => auth()->user()->email,
            'todo' => $todo->name,
            'createdAt' => $todo->created_at->format('Y-m-d H:i:s'),
            'image' => $todo->image,
        ]));
    }

    public static function updateTodo($id, $name)
    {
        $todo = Todo::find($id);
        if ($todo) {
            $todo->name = $name;
            $todo->save();
        }
    }

    public static function editTodo($id, &$name)
    {
        $todo = Todo::find($id);
        if ($todo) {
            $name = $todo->name;
        }
    }

    public static function deleteTodo($id)
    {
        Todo::find($id)->delete();
    }
}
