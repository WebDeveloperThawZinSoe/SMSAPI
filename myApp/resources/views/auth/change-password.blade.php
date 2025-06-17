@extends('admin.master')

@section('title', 'Account Settings')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Account Settings</h2>

    {{-- Success Messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('api_success'))
        <div class="alert alert-success">{{ session('api_success') }}</div>
    @endif

    {{-- Error Messages --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Password Change Form --}}
    <div class="card mb-4">
        <div class="card-header">Change Password</div>
        <div class="card-body">
            <form method="POST" action="{{ route('update.password') }}">
                @csrf

                <div class="mb-3">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>

                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                </div>

                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
        </div>
    </div>

    {{-- API Key Regeneration Form --}}
    <div class="card">
        <div class="card-header">Regenerate API Key</div>
        <div class="card-body">
            <form method="POST" action="{{ route('regenerate.api.key') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Current API Key</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->api_key }}" readonly>
                </div>

                <button type="submit" class="btn btn-warning">Regenerate API Key</button>
            </form>
        </div>
    </div>
</div>
@endsection
