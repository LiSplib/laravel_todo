@extends('default')

@section('title', 'todo')

@section('content')

    <div class="container">
        <a href="{{route('todo.create')}}" class="btn btn-primary">Create</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">List</th>
            <th scope="col">Tags</th>
            <th scope="col">Content</th>
            <th scope="col">Done</th>
            <th scope="col">Due Date</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($todos as $todo)
            <tr>
                <th scope="row">{{ $todo->id }}</th>
                <td>{{ Str::limit($todo->todoList->name, 5) }}</td>
                <td>
                    @foreach($todo->tags as $tag)
                        {{ $tag->name }}
                    @endforeach
                </td>
                <td>{{ $todo->content }}</td>
                <td>{{ $todo->done }}</td>
                <td>{{ $todo->due_date }}</td>
                <td><a href="{{route('todo.delete', ['todo' => $todo->id])}}" class="btn btn-danger">Delete</a></td>
                <td><a href="{{route('todo.show', ['todo' => $todo->id])}}" class="btn btn-primary">Show</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    </div>

@endsection
