<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Todo;

class TodoController extends Controller
{   
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        $todos = Todo::all();

        // **MUTATE TODO STATUS
        foreach($todos as $todo) {

            if($todo->status == 0) {
                $todo->status = 'Pending';
            } 
            else if($todo->status == 1) {
                $todo->status = 'Done';
            }
        }

        return view('layouts.todo.todos', compact('todos'));
    }

    public function insert(Request $request) {

        // *FORM VALIDATION
        Validator::make($request->all(), [
            'title' => 'required|min:6|max:50'
        ])->validate();

        // *INSERT NEW TODO
        $data = ['title' => $request->title];
        Todo::create($data);
        
        return redirect()->back();
    }

    public function delete() {
        dd("test");
    }
}
