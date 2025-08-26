@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit User</h2>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control">
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <div class="mb-3">
            <label>New Password (leave blank to keep current)</label>
            <input type="password" name="password" class="form-control">
            <input type="password" name="password_confirmation" class="form-control mt-2" placeholder="Confirm Password">
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
