@extends('layouts.app')

@php
    $statuses = [
        'pending',
        'progress',
        'completed'
    ];


    $sorts = [
        'created_at:asc' => 'Oldest first',
        'created_at:desc' => 'Latest first'
    ];
@endphp

@section('content')
<div class="container mt-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h5 mb-0">
                Tasks
            </h1>
            <small>
                Task Managment System
            </small>
        </div>
        <div>
            <a href={{ route('tasks.create') }} class="btn btn-primary">
                Add New Task
            </a>
        </div>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <div>
            <form method="GET" action={{ route('tasks.index') }} id="taskFilterForm">
                <div class="input-group mb-3">
                    <input type="text" name="q" value="{{ old('q') ?? request('q') }}" class="form-control" placeholder="Search..." aria-label="Search for title or description" aria-describedby="button-addon2">
                    <select class="form-select" name="status">
                        <option value="">Status...</option>
                        @foreach ($statuses as $status)
                            <option value="{{$status}}" {{ (old('status') ?? request('status')) === $status ? 'selected' : null }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-secondary" type="submit" id="button-addon2">Filter</button>
                </div>
            </form>
        </div>
        <div>
            <select class="form-select" form="taskFilterForm" id="sortSelector" name="sort">
                <option value="">Sorting...</option>
                @foreach ($sorts as $value => $label)
                    <option value="{{ $value }}" {{ (old('sort') ?? request('sort')) === $value ? 'selected' : null }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <table class="table table-hover bg-white rounded shadow-sm overflow-hidden">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <th scope="row">{{ $task->id }}</th>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->status }}</td>
                    <td>
                        <div>
                            <a href={{ route('tasks.edit', ['task' => $task]) }} class="text-primary">Edit</a>
                            <button type="button" class="text-danger btn-link btn" data-bs-toggle="modal" data-bs-target="#deleteTaskModal-{{ $task->id }}">
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
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $tasks->appends(request()->all())->links() }}
</div>
@endsection


@section('scripts')
    <script>
        const sortSelector = document.getElementById("sortSelector");
        const filterForm = document.getElementById('taskFilterForm');

        sortSelector.addEventListener('change', function(event) {
            filterForm.submit();
        });
    </script>
@endsection
