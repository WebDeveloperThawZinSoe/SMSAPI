@extends('admin.master')

@section('title', 'Orders List')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Orders</h1>
        <!-- New Order button triggers modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newOrderModal">
            <i class="bi bi-plus-lg"></i> New Order
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Order Number</th>
                    <th>Total SMS</th>
                    <th>Rate</th>
                    <th>Total Cost</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                <tr>
                    <td>{{ $loop->iteration + $orders->firstItem() - 1 }}</td>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->total_sms }}</td>
                    <td>{{ number_format($order->rate, 2) }}</td>
                    <td>{{ number_format($order->total_cost, 2) }}</td>
                    <td>
                        @php
                            $statusColors = [
                                'pending' => 'warning',
                                'completed' => 'success',
                                'cancelled' => 'danger',
                            ];
                        @endphp
                        <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">No orders found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $orders->links() }}
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="newOrderModal" tabindex="-1" aria-labelledby="newOrderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newOrderModalLabel">New Order Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Contact Info:</strong></p>
        <ul>
            <li>Email: <a href="mailto:thawzinsoe.dev@gmail.com">thawzinsoe.dev@gmail.com</a></li>
            <li>Phone: 09403077739</li>
            <li>Telegram: <a href="https://t.me/thawmax2023" target="_blank">@thawmax2023</a></li>
        </ul>

        <p><strong>Pricing Details:</strong></p>
        <ul>
            <li><strong>First Order:</strong> 1 SMS Credit - 15 Kyats (Must buy at least 2000 credits, no limit)</li>
            <li><strong>After First Order:</strong> 1 SMS Credit - 21 Kyats (Must buy at least 1000 credits, no limit)</li>
        </ul>

        <p><strong>Payment Method:</strong></p>
        <p>KPay: 09403077739 (Thaw Zi Soe)</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        {{-- You can add a confirm/order button here if needed --}}
      </div>
    </div>
  </div>
</div>

@endsection
