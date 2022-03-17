@extends('default')

@section('title', 'todo')

@section('content')

    <h2>Todo</h2>
    <p>
        {{ $todo->todoList->name }}
    </p>
    <p>
        {{ $todo->content }}
    </p>
    <p>
        @foreach($todo->tags as $tag)
            {{ $tag->name }}
        @endforeach
    </p>

@endsection
