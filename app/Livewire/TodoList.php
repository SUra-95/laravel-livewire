<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;
use App\Helpers\TodoHelper;
use Illuminate\Support\Facades\Session;

class TodoList extends Component
{
    use WithPagination;
    
    
    #[Rule('required|min:3|max:50')]
    public $name;
    public $search;
    public $editingTodoID;
    #[Rule('required|min:3|max:50')]
    public $editingTodoName;
    
    protected $todoHelper;
    public $modalOpen = false;

    public function mount(){
        $this->todoHelper = new TodoHelper();
    }
    
    public function create(){
        // Check if $todoHelper is not set and initialize it
        if (!$this->todoHelper) {
            $this->todoHelper = new TodoHelper();
        }

        // validate
        $validated = $this->validateOnly('name');
        //create the todo
        $this->todoHelper->createTodo($validated['name']);
        $this->modalOpen = false;
        // clear the input
        $this->reset('name');
        //send the flash message
        Session::flash('success', 'Saved.');
    }


    public function createModalOpen(){
        $this->modalOpen = true;
    }

    // public function delete(Todo $todo){
    //     $todo->delete();
    // }

    public function toggle($todoID){
        $todo = Todo::find($todoID);
        $todo->completed = !$todo->completed;
        $todo->save();
    }

    public function delete($todoID){
        TodoHelper::deleteTodo($todoID);
    }

    public function edit($todoID){
        $this->editingTodoID = $todoID;
        $this->editingTodoName = '';
        TodoHelper::editTodo($this->editingTodoID, $this->editingTodoName);
    }

    public function cancelEdit(){
        $this->reset('editingTodoID', 'editingTodoName');
    }
    public function update(){
        $this->validateOnly('editingTodoName');
        TodoHelper::updateTodo($this->editingTodoID, $this->editingTodoName);
            $this->cancelEdit();
    }

    public function render(){
        return view('livewire.todo-list', [
            'todos' => Todo::latest()->where('name', 'like', "%{$this->search}%")->paginate(3)
        ]);
    }
}
