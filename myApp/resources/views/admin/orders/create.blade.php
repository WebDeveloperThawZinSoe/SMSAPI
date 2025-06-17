@extends('admin.master')

@section('title', 'Create Order')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Create New Order</h1>

    <form action="{{ route('orders.store') }}" method="POST" class="shadow p-4 rounded bg-white">
        @csrf
        @include('admin.orders._form', ['order' => null, 'users' => $users, 'buttonText' => 'Create Order'])
    </form>
</div>
@endsection
