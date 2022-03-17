@extends('default')

@section('title', 'todo')

@section('content')

    <div class="container">
{{--        <a href="{{route('todo.create')}}" class="btn btn-primary">Create</a>--}}
        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">Count</th>
            </tr>
            </thead>
            <tbody>
            @foreach($lists as $list)
                <tr>
                    <th scope="row">{{ $list->id }}</th>
                    <td>{{ $list->name }}</td>
                    <td>{{ $list->todos->count() }}</td>
{{--                    <td><a href="{{route('list.delete', ['todo' => $todo->id])}}" class="btn btn-danger">Delete</a></td>--}}
{{--                    <td><a href="{{route('todo.show', ['todo' => $todo->id])}}" class="btn btn-primary">Show</a></td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@endsection
