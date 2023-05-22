@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h5 mb-0 fw-semibold">
                Update Profile
            </h1>
            <small>
                Lorem ipsum dolor sit amet.
            </small>
        </div>
    </div>

    <form class="d-block mt-4 w-md-50" method="POST" action={{ route('profile.update') }}>
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') ?? $user->name }}" name="name">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') ?? $user->email }}" name="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mt-5 mb-4 border-b">
            <h2 class="h6 mb-0 fw-semibold">
                Change password
            </h2>
            <small>
                Leave blank if you do not wish to change your password
            </small>
        </div>

        <div class="mb-4">
            <label for="current_password" class="form-label">Current Password</label>
            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
            @error('current_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="form-label">New Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Password Confirmation</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection
