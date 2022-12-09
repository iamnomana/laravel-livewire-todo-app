<?php

namespace App\Http\Livewire\Todo;

use App\Models\Todo;
use Livewire\Component;

class Show extends Component
{
    public $todos, $todo,  $todo_id;
    public $isOpen = false;

    public function render()
    {
        $this->todos = Todo::all();
        return view('livewire.todo.show');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->todo = '';
        $this->todo_id = '';
    }

    public function store()
    {
        $this->validate([
            'todo' => 'required',
            'body' => 'required',
        ]);

        Todo::updateOrCreate(['id' => $this->todo_id], [
            'todo' => $this->todo
        ]);

        session()->flash(
            'message',
            $this->todo_id ? 'Todo Updated Successfully.' : 'Todo Created Successfully.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $todo = Todo::findOrFail($id);
        $this->todo_id = $id;
        $this->todo = $todo->todo;


        $this->openModal();
    }

    public function delete($id)
    {
        Todo::find($id)->delete();
        session()->flash('message', 'Todo Deleted Successfully.');
    }
}
