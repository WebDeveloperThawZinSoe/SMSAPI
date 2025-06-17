@extends('admin.master')

@section('title', 'Pricing')

@push('styles')
@endpush

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-primary"><i class="fas fa-tags me-2"></i> Pricing Information</h2>

    <!-- First Time Order -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title text-success">📦 First Time Order</h5>
            <p class="card-text">
                <strong>1 SMS Credit = 15 MMK</strong><br>
                You need to buy at least <strong>2,000 credits</strong>.<br>
                <em>No upper limit.</em>
            </p>
        </div>
    </div>

    <!-- After First Time -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title text-warning">🔁 After First Order</h5>
            <p class="card-text">
                <strong>1 SMS Credit = 21 MMK</strong><br>
                Minimum purchase is <strong>1,000 credits</strong>.<br>
                <em>No upper limit.</em>
            </p>
        </div>
    </div>

    <!-- Country-wise Cost -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title text-info">🌍 Credit Cost by Country</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>Country Code</th>
                            <th>Country</th>
                            <th>Credit per SMS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><code>+95</code></td>
                            <td>Myanmar</td>
                            <td>1 Credit</td>
                        </tr>
                        <tr>
                            <td><code>+66</code></td>
                            <td>Thailand</td>
                            <td>4 Credits</td>
                        </tr>
                        <tr>
                            <td><code>+60</code></td>
                            <td>Malaysia</td>
                            <td>10 Credits</td>
                        </tr>
                        <tr>
                            <td><code>+65</code></td>
                            <td>Singapore</td>
                            <td>20 Credits</td>
                        </tr>
                        <tr>
                            <td><code>+81</code></td>
                            <td>Japan</td>
                            <td>35 Credits</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
