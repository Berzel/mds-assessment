@extends('layouts.app')


@section('content')
<div class="container mt-2">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h5 mb-0">
                {{ $task->title }}
            </h1>
            <small>
                {{ ucfirst($task->status) }} : {{ $task->created_at->diffForHumans() }}
            </small>
        </div>
        <div>
            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteTaskModal-{{ $task->id }}">
                Delete
            </button>

            <div class="modal fade" id="deleteTaskModal-{{ $task->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5">Delete task</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete task - <strong>{{ $task->title }}</strong>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form action="{{ route('tasks.destroy', ['task' => $task]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete task</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <a href={{ route('tasks.edit', ['task' => $task]) }} class="btn btn-primary btn-sm">
                Edit
            </a>
        </div>
    </div>

    <div class="mt-4">
        {{ $task->description }}
    </div>
</div>
@endsection
