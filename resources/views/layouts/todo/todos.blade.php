@extends("layouts.todo.index")

@section("content")

<div class="container">

    <a href="/home" class="btn btn-secondary mb-5">Go to home</a>

    <div class="card py-2 d-flex flex-column align-items-center justify-content-center">

        <span class="display-2">Todo List</span>

        <form action="/todos" method="POST" class="w-50">
            @csrf
            <div class="input-group my-3 ">
                <input type="text" name="title" class="form-control mr-2" placeholder="Add new todo"
                    aria-label="Add new todo" aria-describedby="button-addon2">

                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" id="button-addon2">Add</button>
                </div>
            </div>
        </form>

        @include('layouts.alert')


        <table class="table table-lg table-hover overfllow-auto">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($todos as $key => $value)
                <tr>
                    <td scope="{{$key + 1}}">{{$key + 1}}</td>
                    <td>{{$value->title}}</td>
                    <td>{{$value->status}}</td>
                    <td>
                        <a href="#" class="btn btn-warning">Edit</a>
                        <a href="{{'/todos/'.$value->id}}" class="btn btn-danger" data-method="delete">Delete</a>
                    </td>
                </tr>
                @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection