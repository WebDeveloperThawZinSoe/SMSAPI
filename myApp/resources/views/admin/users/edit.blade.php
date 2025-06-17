@extends('admin.master')

@section('title', 'Edit User')

@section('content')
<div class="col-md-6 mx-auto">
    <h2><i class="fas fa-user-edit"></i> Edit User</h2>

    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autofocus>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password (leave blank if no change)</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
        </div>

        <div class="mb-3">
            <label class="form-label">Assign Roles <span class="text-danger">*</span></label>
            <select name="roles[]" class="form-select @error('roles') is-invalid @enderror" multiple required>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}" @if(in_array($role->name, old('roles', $userRoles))) selected @endif>{{ ucfirst($role->name) }}</option>
                @endforeach
            </select>
            @error('roles') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i> Update User
        </button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>
@endsection
