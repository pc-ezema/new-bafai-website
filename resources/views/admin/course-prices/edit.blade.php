@extends('layouts.layout') @section('title', 'Edit Course Price')

@section('content')
    <div class="d-flex justify-content-between align-items-center pt-1 pb-3 mb-4 border-bottom">
        <h1 class="h3">Edit Price for: {{ $course->fullname }}</h1>
        <a href="{{ route('admin.course-prices.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>

    <form action="{{ route('admin.course-prices.update', $course->id) }}" method="POST" id="priceForm">
        @csrf @method('PUT')
        <div class="bg-white rounded-3 border p-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label>Original Price (USD)</label>
                        <input type="number" step="0.01" name="original_price" class="form-control @error('original_price') is-invalid @enderror"
                               value="{{ old('original_price', $price->original_price ?? '') }}" placeholder="e.g. 199.00">
                        @error('original_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Discounted Price (USD)</label>
                        <input type="number" step="0.01" name="discounted_price" class="form-control @error('discounted_price') is-invalid @enderror"
                               value="{{ old('discounted_price', $price->discounted_price ?? '') }}" placeholder="Leave empty for no discount">
                        @error('discounted_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label>Currency</label>
                        <input type="text" name="currency" class="form-control @error('currency') is-invalid @enderror"
                               value="{{ old('currency', $price->currency ?? 'USD') }}" maxlength="3">
                        @error('currency') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Discount End Date</label>
                        <input type="datetime-local" name="discount_ends_at" class="form-control @error('discount_ends_at') is-invalid @enderror"
                               value="{{ old('discount_ends_at', $price && $price->discount_ends_at ? \Carbon\Carbon::parse($price->discount_ends_at)->format('Y-m-d\TH:i') : '') }}">
                        @error('discount_ends_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="text-muted">Leave empty for no expiration.</small>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="submitBtn">
                <span class="spinner-border spinner-border-sm d-none me-2" id="spinner" role="status" aria-hidden="true"></span>
                <span id="btnText"><i class="fas fa-save me-1"></i> Update Price</span>
            </button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('priceForm');
            const submitBtn = document.getElementById('submitBtn');
            const spinner = document.getElementById('spinner');
            const btnText = document.getElementById('btnText');

            if (form) {
                form.addEventListener('submit', function(e) {
                    // If form is invalid (HTML5 validation), let browser handle it
                    if (!form.checkValidity()) {
                        // Re-enable button if it was disabled (e.g., from previous attempt)
                        enableButton();
                        return;
                    }

                    // Prevent double submission
                    if (submitBtn.disabled) {
                        e.preventDefault();
                        return;
                    }

                    // Disable button and show spinner
                    disableButton();
                });
            }

            function disableButton() {
                submitBtn.disabled = true;
                spinner.classList.remove('d-none');
                btnText.innerHTML = 'Updating...';
            }

            function enableButton() {
                submitBtn.disabled = false;
                spinner.classList.add('d-none');
                btnText.innerHTML = '<i class="fas fa-save me-1"></i> Update Price';
            }

            // Re-enable button if validation fails (e.g., user corrects and resubmits)
            // The form will reload on validation error, so we don't need client-side re-enable.
            // But we can re-enable if the user changes a field after the button was disabled.
            // However, disabling only happens on submit, so we don't need this.
        });
    </script>
@endsection