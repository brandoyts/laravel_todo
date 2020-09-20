<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Todo;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $todos = Todo::where('user_id', auth()->id())->get();

        // **SET TODO STATUS
        // foreach ($todos as $todo) {

        //     if ($todo->status === 0) {
        //         $todo->status = 'Pending';
        //     } else if ($todo->status === 1) {
        //         $todo->status = 'Done';
        //     }
        // }

        return view('layouts.todo.todos', compact('todos'));
    }

    public function insert(Request $request)
    {
        if (Auth::check()) {

            // *FORM VALIDATION
            Validator::make($request->all(), [
                'title' => 'required|min:6|max:50'
            ])->validate();

            // *INSERT NEW TODO
            $data = ['user_id' => auth()->id(), 'title' => $request->title];
            Todo::create($data);
        }


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


        if ($request->status) {
            $status = $request->status;
            $this->updateStatus($todo, $status);
        } else if ($request->title) {
            $todo->title = $request->title;
            $todo->save();
            return redirect('todos');
        }
    }

    protected function updateStatus($todo, $status)
    {
        // *CHECK STATUS
        if ($status == "true") {
            $todo->status = true;
            $todo->save();
        } elseif ($status == "false") {
            $todo->status = false;
            $todo->save();
        }
    }


    public function delete(Request $request)
    {

        Todo::where("id", $request->id)->delete();
    }
}
