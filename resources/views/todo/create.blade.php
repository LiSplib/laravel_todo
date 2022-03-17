@extends('default')

@section('title', 'create Todo')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('todo.create' )}}" method="post" class="form" >
        <div class="form-group">
        @csrf
            <label for="content">Content</label>
            <input type="text" name="content" class="form-control">
            <label for="done">Done</label>
            <input type="checkbox" name="done" class="form-control">
            <label for="todo_list_id">List Todo</label>
            <select name="todo_list_id" class="'form-control">
                @foreach($todoList as $list)
                    <option value="{{ $list->id }}">{{ $list->name }}</option>
                @endforeach
            </select>
            <label for="tags">tags</label>
            <input type="text" name="tags" value="tag1, tag2, tag3" class="form-control">
            <button type="submit">OK</button>
        </div>
    </form>
@endsection
