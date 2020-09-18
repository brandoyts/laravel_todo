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
                    <th scope="col">Title</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($todos as $key => $value)
                <tr>
                    <td>{{$value->title}}</td>
                    <td>{{$value->status}}</td>
                    <td>
                        <a href="{{route('todos.edit', $value->id)}}"><i class="fas fa-edit text-warning"></i></a>
                        <i class="btn fas fa-trash-alt text-danger" id="{{"delete-btn-".$key}}"></i>
                    </td>
                    <form hidden id="{{"form-delete-".$key}}" action="{{route('todos.delete', $value->id)}}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <input hidden aria-hidden="true" type="text" name="id" value="{{$value->id}}">
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


{{-- DOM MANIPULATION --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const rows = document.querySelector('tbody').children;
       
       for(let i = 0; i < rows.length; i++) {
           
           const deleteBtn = document.querySelector(`#delete-btn-${i}`);
           const formDelete = document.querySelector(`#form-delete-${i}`);

           deleteBtn.addEventListener("click", e => {
               e.preventDefault();
            

              
              formDelete.submit();
           });


       }
    });
</script>


@endsection