@extends('admin.master')

@section('title', 'API Documentation - Send OTP')

@push('styles')
<style>
    .api-section {
        margin-bottom: 2rem;
    }

    .api-label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #343a40;
    }

    .api-code {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        font-size: 14px;
        line-height: 1.5;
        overflow-x: auto;
        border: 1px solid #dee2e6;
    }

    .api-title {
        font-size: 24px;
        font-weight: bold;
        color: #007bff;
        margin-bottom: 1.5rem;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">

    <div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="mb-4 text-primary">
            <i class="fas fa-code me-2"></i> API Documentation - Send OTP
        </h3>
        <p class="text-muted">
            Welcome to the API documentation for sending OTPs (One-Time Passwords) via SMS.
            This API allows you to send OTPs to users' phone numbers securely and efficiently.
        </p>

        <div class="alert alert-dark d-flex justify-content-between align-items-center mt-4">
            <div>
                <strong>My API Key:</strong>
                <span class="text-monospace">{{ Auth::user()->api_key }}</span>
            </div>
            <button class="btn btn-outline-light btn-sm" onclick="copyApiKey()">
                <i class="fas fa-copy me-1"></i> Copy
            </button>
        </div>
    </div>
</div>

<script>
    function copyApiKey() {
        const key = "{{ Auth::user()->api_key }}";
        navigator.clipboard.writeText(key).then(() => {
            alert("API Key copied to clipboard!");
        });
    }
</script>


    <h4 class="api-title">📨 Send OTP API</h4>

    <div class="api-section">
        <div class="api-label">🔗 What is the Endpoint?</div>
        <pre class="api-code">POST {{ config('app.url') }}/api/otp</pre>
    </div>

    <div class="api-section">
        <div class="api-label">📥 What headers should I send?</div>
        <pre class="api-code">{
  "Content-Type": "application/json",
  "Accept": "application/json"
}</pre>
    </div>

    <div class="api-section">
        <div class="api-label">📦 What is the request body?</div>
        <pre class="api-code">{
  "api_key": "your-user-api-key",
  "otp_code": 123456,
  "phone_number": "+6598765432"
}</pre>
    </div>

    <div class="api-section">
        <div class="api-label">💡 Example using cURL</div>
        <pre class="api-code">curl -X POST {{ config('app.url') }}/api/otp \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "api_key": "your-user-api-key",
    "otp_code": 123456,
    "phone_number": "+6598765432"
}'</pre>
    </div>

    <div class="api-section">
        <div class="api-label">✅ What will I get if successful?</div>
        <pre class="api-code">{
  "status": "success",
  "message": "OTP sent successfully",
  "api_key": "your-user-api-key",
  "otp_code": 123456,
  "phone_number": "+6598765432",
  "sms_cost": 20,
  "country": "Singapore"
}</pre>
    </div>

    <div class="api-section">
        <div class="api-label">🚫 What if something goes wrong?</div>
        <pre class="api-code">{
  "status": "error",
  "message": "OTP limit reached. Try again later."
}</pre>
    </div>
</div>
@endsection
