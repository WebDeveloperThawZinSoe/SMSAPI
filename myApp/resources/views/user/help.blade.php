@extends('admin.master')

@section('title', 'FAQ')

@push('styles')
@endpush

@section('content')
<div class="container py-4">
    <h2 class="mb-4"><i class="fas fa-question-circle me-2"></i> Frequently Asked Questions</h2>

    <div class="accordion" id="faqAccordion">
        <!-- Q1 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                    1. Do credits expire?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <strong>No</strong>, your credits do not expire.
                </div>
            </div>
        </div>

        <!-- Q2 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                    2. Can I send messages other than OTP?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <strong>Yes</strong>, OTP is open for all. If you want to connect for other message types, contact the admin at:
                    <br>
                    <ul class="mb-0 mt-2">
                        <li>Email: <code>thawzinsoe.dev@gmail.com</code></li>
                        <li>Phone: <code>09403077739</code></li>
                    </ul>
                    <p class="mt-2 mb-0 text-muted"><em>This is the startup beta version.</em></p>
                </div>
            </div>
        </div>

        <!-- Q3 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                    3. Can I send to other countries?
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <strong>Yes</strong>, supported countries include:
                    <ul class="mb-0 mt-2">
                        <li>Myanmar</li>
                        <li>Thailand</li>
                        <li>Singapore</li>
                        <li>Malaysia</li>
                        <li>Japan</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Q4 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                    4. How long does it take after payment?
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Maximum time is <strong>24 hours</strong>. On average, it is activated <strong>immediately</strong>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
