@extends('layouts.layout') @section('title', 'Edit Discount')

@section('content')
    <div class="d-flex justify-content-between align-items-center pt-1 pb-3 mb-4 border-bottom">
        <h1 class="h3">Edit Discount Code</h1>
        <a href="{{ route('admin.discounts.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i> Back</a>
    </div>

    {{-- Display all errors at the top --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-exclamation-circle"></i> Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('admin.discounts.update', $discount) }}" method="POST" id="discountForm">
        @csrf @method('PUT')
        <div class="bg-white rounded-3 border p-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label>Code *</label>
                        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code', $discount->code) }}" required placeholder="SUMMER20">
                        @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Type *</label>
                        <select name="type" class="form-control @error('type') is-invalid @enderror" required>
                            <option value="percentage" {{ old('type', $discount->type) == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                            <option value="fixed" {{ old('type', $discount->type) == 'fixed' ? 'selected' : '' }}>Fixed Amount ($)</option>
                        </select>
                        @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Value *</label>
                        <input type="number" step="0.01" name="value" class="form-control @error('value') is-invalid @enderror" value="{{ old('value', $discount->value) }}" required>
                        @error('value') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label>Max Uses</label>
                        <input type="number" name="max_uses" class="form-control @error('max_uses') is-invalid @enderror" value="{{ old('max_uses', $discount->max_uses) }}" placeholder="Leave empty for unlimited">
                        @error('max_uses') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Expires At</label>
                        <input type="datetime-local" name="expires_at" class="form-control @error('expires_at') is-invalid @enderror" value="{{ old('expires_at', $discount->expires_at ? $discount->expires_at->format('Y-m-d\TH:i') : '') }}">
                        @error('expires_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="isActive" {{ old('is_active', $discount->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="isActive">Active</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="submitBtn">
                <span class="spinner-border spinner-border-sm d-none me-2" id="spinner"></span>
                <span id="btnText"><i class="fas fa-save me-1"></i> Update</span>
            </button>
        </div>
    </form>

    <script>
        document.getElementById('discountForm')?.addEventListener('submit', function(e) {
            const btn = document.getElementById('submitBtn');
            const spinner = document.getElementById('spinner');
            const btnText = document.getElementById('btnText');
            if (!btn.disabled) {
                btn.disabled = true;
                spinner.classList.remove('d-none');
                btnText.innerHTML = 'Updating...';
            }
        });
    </script>
@endsection