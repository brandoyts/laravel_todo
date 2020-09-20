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
                <tr class="table-row">
                    <td>{{$value->title}}</td>

                    @if ($value->status)
                    <td class="status text-success" data_todo_id="{{$value->id}}">Finished</td>
                    @else
                    <td class="status text-muted" data_todo_id="{{$value->id}}">Pending</td>
                    @endif

                    <td>
                        <a href=" {{route('todos.edit', $value->id)}}"><i class="fas fa-edit text-warning"></i></a>
                        <i class="btn fas fa-trash-alt text-danger delete-btn" data_todo_id="{{$value->id}}"></i>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


{{-- DOM MANIPULATION --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
       
        todoAjax = (method, todoData) => {
            // CHECK METHOD
            if (method === "DELETE") {
                $.ajax({
                    type: "POST",
                    url: `/todos/delete/${todoData.id}`,
                    data: {"_method": method, "id": todoData.id},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }
            else if (method === "PUT") {
                $.ajax({
                    type: "POST",
                    url: `/todos/edit/${todoData.id}`,
                    data: {"_method": method, "id": todoData.id, status: todoData.status},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }
        }
       
         let isClicked = false;

        // GRAB EACH TABLE ROWS
        // UPDATE STATUS
        $(".status").click(e => {
            const todoId = e.target.attributes.data_todo_id.value;
            const todoData = {id: todoId, status: null};

            if (e.target.classList.contains("text-success")) {
                e.target.classList.remove("text-success");
                e.target.classList.add("text-muted");
                e.target.textContent = "Pending";
                todoData.status = false;
                todoAjax("PUT", todoData);
            }
            else if (e.target.classList.contains("text-muted")) {
                e.target.classList.remove("text-muted");
                e.target.classList.add("text-success");
                e.target.textContent = "Finished";
                todoData.status = true;
                todoAjax("PUT", todoData);
            }

           
            isClicked = !isClicked;
        });
        
        // GRAB EACH DELETE BTN
        $(".delete-btn").click(e => {
            e.target.parentNode.parentNode.remove();

            // DELETE REQUEST
            const todoId = e.target.attributes.data_todo_id.value;
            const todoData = {id: todoId};
            todoAjax("DELETE", todoData);
        });

    });
</script>



@endsection