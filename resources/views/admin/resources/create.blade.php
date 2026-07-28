@extends('layouts.layout') 

@section('title', 'Create Resource')

@section('content')
    <div class="d-flex justify-content-between align-items-center pt-1 pb-3 mb-4 border-bottom">
        <h1 class="h3">Create Resource</h1>
        <a href="{{ route('admin.resources.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.resources.store') }}" method="POST" enctype="multipart/form-data" id="resourceForm">
        @csrf
        <div class="bg-white rounded-3 border p-4">
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Title *</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Type *</label>
                        <select name="type" class="form-control @error('type') is-invalid @enderror" required>
                            <option value="">Select type</option>
                            <option value="document" {{ old('type')=='document'?'selected':'' }}>Document</option>
                            <option value="video" {{ old('type')=='video'?'selected':'' }}>Video</option>
                            <option value="link" {{ old('type')=='link'?'selected':'' }}>Link</option>
                            <option value="other" {{ old('type')=='other'?'selected':'' }}>Other</option>
                        </select>
                        @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload File</label>
                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                        @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="text-muted">Max 10MB</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">External URL</label>
                        <input type="url" name="external_url" class="form-control @error('external_url') is-invalid @enderror" value="{{ old('external_url') }}" placeholder="https://...">
                        @error('external_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="text-muted">Use URL instead of file upload</small>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="is_published" class="form-check-input" id="isPublished" {{ old('is_published', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="isPublished">Published</label>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <span class="spinner-border spinner-border-sm d-none me-2" id="spinner"></span>
                    <span id="btnText"><i class="fas fa-save me-1"></i> Save Resource</span>
                </button>
            </div>
        </div>
    </form>

    <script>
        document.getElementById('resourceForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            document.getElementById('spinner').classList.remove('d-none');
            document.getElementById('btnText').innerHTML = 'Saving...';
        });
    </script>
@endsection