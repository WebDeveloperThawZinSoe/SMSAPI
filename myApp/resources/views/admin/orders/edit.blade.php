@extends('admin.master')

@section('title', 'Edit Order')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Edit Order #{{ $order->order_number }}</h1>

    <form action="{{ route('orders.update', $order) }}" method="POST" class="shadow p-4 rounded bg-white">
        @csrf
        @method('PUT')
        @include('admin.orders._form', ['order' => $order, 'users' => $users, 'buttonText' => 'Update Order'])
    </form>
</div>
@endsection
