@extends('admin.master')

@section('title', 'User Dashboard')

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
    <h3 class="mb-4"><i class="fas fa-chart-line me-2"></i> User Dashboard</h3>

    <div class="row g-4">
        {{-- Total SMS Sent --}}
        <div class="col-md-4 col-sm-6">
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

        {{-- Remaining SMS --}}
        <div class="col-md-4 col-sm-6">
            <div class="card-stat bg-secondary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="card-title">Remaining SMS</div>
                        <div class="card-value">{{ number_format($remain) }}</div>
                    </div>
                    <div class="card-icon"><i class="fas fa-hourglass-half"></i></div>
                </div>
            </div>
        </div>

        {{-- Today’s SMS Count --}}
        <div class="col-md-4 col-sm-6">
            <div class="card-stat bg-warning text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="card-title">Today's SMS</div>
                        <div class="card-value">{{ number_format($todaySmsCount) }}</div>
                    </div>
                    <div class="card-icon"><i class="fas fa-calendar-day"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
