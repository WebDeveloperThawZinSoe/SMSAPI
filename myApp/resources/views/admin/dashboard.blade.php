@extends('admin.master')

@section('title', 'Admin Dashboard')

@push('styles')
<style>
    .card-stat {
        border: none;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        transition: 0.3s ease;
    }
    .card-stat:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 28px rgba(0,0,0,0.15);
    }
    .card-icon {
        font-size: 2.5rem;
        opacity: 0.8;
    }
    .card-title {
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 0.3rem;
    }
    .card-value {
        font-size: 2rem;
        font-weight: bold;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <h3 class="mb-4"><i class="fas fa-chart-line me-2"></i> Admin Dashboard</h3>
    
    <div class="row g-4">
        {{-- Total Users --}}
        <div class="col-md-3">
            <div class="card-stat bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="card-title">Total Users</div>
                        <div class="card-value">{{ $totalUsers }}</div>
                    </div>
                    <div class="card-icon"><i class="fas fa-users"></i></div>
                </div>
            </div>
        </div>

        {{-- Total Completed Order Money --}}
        <div class="col-md-3">
            <div class="card-stat bg-success text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="card-title">Completed Orders</div>
                        <div class="card-value">{{ number_format($totalCompletedOrderMoney) }}</div>
                    </div>
                    <div class="card-icon"><i class="fas fa-money-bill-wave"></i></div>
                </div>
            </div>
        </div>

        {{-- Total SMS Count --}}
        <div class="col-md-3">
            <div class="card-stat bg-info text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="card-title">Total SMS Sent</div>
                        <div class="card-value">{{ number_format($totalSmsCount) }}</div>
                    </div>
                    <div class="card-icon"><i class="fas fa-envelope"></i></div>
                </div>
            </div>
        </div>

        {{-- Today's SMS Count --}}
        <div class="col-md-3">
            <div class="card-stat bg-warning text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="card-title">Today’s SMS</div>
                        <div class="card-value">{{ number_format($todaySmsCount) }}</div>
                    </div>
                    <div class="card-icon"><i class="fas fa-calendar-day"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
