@extends("layouts.todo.index");

@section("content")
<div class="container">

    <a href="/todos" class="btn btn-secondary mb-5">Go Back</a>

    <div class="card py-2 d-flex flex-column align-items-center justify-content-center">

        <span class="display-2">Edit Todo</span>

        <form action="{{route('todos.update', $todo)}}" method="POST" class="w-50">
            @csrf
            @method("PUT")
            <div class="input-group my-3 ">
                <input type="text" name="title" class="form-control mr-2" aria-label="Update Todo"
                    aria-describedby="button-addon2" value="{{$todo->title}}">
                <input aria-hidden="true" hidden name="id" value="{{$todo->id}}">
                <div class=" input-group-append">
                    <button class="btn btn-primary" type="submit" id="button-addon2">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection