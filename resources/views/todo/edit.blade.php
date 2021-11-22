@extends('layouts/app')

@section('content')


<div class="mt-5 w-50 mx-auto">
    <h1>Edit your Todo</h1>
    <form action="{{ route('todo.update', $todo->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" class="form-control" name="title" value="{{ $todo->title }}">
        <button type="submit" class="btn btn-success mt-2 float-right">Update Todo</button>
    </form>
</div>
@endsection