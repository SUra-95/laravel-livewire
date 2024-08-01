<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\TodoHelper;
use Illuminate\Support\Facades\Session;
use Livewire\WithFileUploads;

class TodoList extends Component
{
    use WithPagination;
    use WithFileUploads;
    
    public $name;
    public $search;
    public $editingTodoID;
    public $editingTodoName;
    public $image;
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
        $rules = [
            'name' => 'required|min:3|max:50',
            'image' => 'required|sometimes|image|max:2048|mimes:jpeg,png,jpg',
        ];
        // validate
        $validated = $this->validate($rules);
        // image upload 
        if ($this->image) {
            $validated['image'] = $this->image->store('uploads', 'public');
        }
        //create the todo
        $this->todoHelper->createTodo($validated);
        $this->modalOpen = true;
        // clear the input
        $this->reset('name', 'image');
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
            'todos' => Todo::latest()->where('name', 'like', "%{$this->search}%")->paginate(5)
        ]);
    }
}
