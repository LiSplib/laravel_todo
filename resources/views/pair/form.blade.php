@extends('default')

@section('title', 'formulaire')

@section('content')
<form action="{{ route('is_even' )}}" method="post" class="form form-control" >
    @csrf
    <input type="text" name="value">
    <button type="submit">OK</button>
</form>
@endsection
