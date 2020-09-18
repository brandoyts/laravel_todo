<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Todo;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $todos = Todo::all();

        // **SET TODO STATUS
        foreach ($todos as $todo) {

            if ($todo->status === 0) {
                $todo->status = 'Pending';
            } else if ($todo->status === 1) {
                $todo->status = 'Done';
            }
        }

        return view('layouts.todo.todos', compact('todos'));
    }

    public function insert(Request $request)
    {

        // *FORM VALIDATION
        Validator::make($request->all(), [
            'title' => 'required|min:6|max:50'
        ])->validate();

        // *INSERT NEW TODO
        $data = ['title' => $request->title];
        Todo::create($data);

        return redirect()->back();
    }


    // **RENDER EDIT VIEW
    public function edit($id)
    {

        $todo = Todo::find($id);

        return view('layouts.todo.edit', compact('todo'));
    }


    // **UPDATE TOTDO
    public function update(Request $request)
    {
        $todo = Todo::find($request->id);
        $todo->title = $request->title;
        $todo->save();

        return redirect('todos');
    }




    public function delete($id)
    {
        Todo::where("id", $id)->delete();
        return redirect()->back();
    }
}
