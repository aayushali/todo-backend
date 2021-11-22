@extends('layouts/app')

@section('content')


<!-- As a heading -->
<h1 class="text-center text-white fw-bolder">Todo App</h1>
<h3 class="text-center text-white pt-3">What next? Add something to your list!</h3>

<div class=" w-50 mx-auto">
    <form action="{{ route('todo.store') }}" method="POST">
        @csrf
        <input type="text" class="form-control shadow-lg p-3 mb-2 bg-body rounded " name="title" placeholder="Enter new todo..">
        <button type="submit" class="btn btn-success float-right ">Add Todo</button>
    </form>
</div>
<div class="mt-5 w-50 mx-auto">
    <h2 class="text-white text-bold">My Todo List:</h2>
    <div>
        @forelse ($todos as $todo)
        <div class=" d-flex  justify-content-between mt-3 shadow p-3 mb-1 bg-white rounded" aria-current=" true">
            <div>
                @if($todo->completed == 0)
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right" width="33" height="33" viewBox="0 0 24 24" stroke-width="3" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <polyline points="9 6 15 12 9 18" />
                </svg>
                @else <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="33" height="33" viewBox="0 0 24 24" stroke-width="3" stroke="#00FF00" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l5 5l10 -10" />
                </svg>
                @endif
                {{ $todo->title }}
            </div>
            <div class="d-flex align-items-center">
                @if($todo->completed == 0 )
                <form action="{{ route('todo.update', $todo->id )}}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="text" name="completed" value="1" hidden>
                    <button class="btn btn-success float-right mr-3">Mark as Complete</button>
                </form>
                @else
                <form action="{{ route('todo.update', $todo->id )}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="text" name="completed" value="0" hidden>
                    <button class="btn btn-warning float-right px-3 mr-3">Mark Incomplete</button>
                </form>
                @endif
                <a href="{{ route('todo.edit', $todo->id) }}" class="inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="33" height="33" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                        <line x1="16" y1="5" x2="19" y2="8" />
                    </svg></a>
                <form action="{{ route('todo.destroy', $todo->id )}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="border-0 bg-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="33" height="33" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff2825" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <line x1="4" y1="7" x2="20" y2="7" />
                            <line x1="10" y1="11" x2="10" y2="17" />
                            <line x1="14" y1="11" x2="14" y2="17" />
                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <p class=" text-center">Nothing is added in your list.</p>
        @endforelse
    </div>
</div>
@endsection