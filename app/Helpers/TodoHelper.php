<?php

namespace App\Helpers;

use App\Models\Todo;

class TodoHelper
{
    public static function createTodo($name)
    {
        $validated = ['name' => $name];
        Todo::create($validated);
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
