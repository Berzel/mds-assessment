@extends('layouts.app')

@php
    $statuses = [
        'pending',
        'progress',
        'completed'
    ];
@endphp

@section('content')
    <div class="container mt-2">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h5 mb-0 fw-semibold">
                    Add Task
                </h1>
                <small>
                    Add a new task to your list
                </small>
            </div>
        </div>

        <form class="d-block mt-4 w-md-50" method="POST" action={{ route('tasks.store') }}>
            @csrf
            <div class="mb-4">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title') }}" name="title">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="status" class="form-label">Status</label>
                <select class="form-select @error('status') is-invalid @enderror" aria-label="Choose status" name="status">
                    <option >Choose status</option>
                    @foreach ($statuses as $status)
                        <option value="{{$status}}" {{ old('status') === $status ? 'selected' : null }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
                @error('status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="4" name="description">{{ old('description') }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Add Task</button>
        </form>
    </div>
@endsection
