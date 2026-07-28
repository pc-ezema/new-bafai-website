@extends('layouts.layout')

@section('title', 'Edit Blog Post')

@section('content')
    <div class="d-flex justify-content-between align-items-center pt-1 pb-3 mb-4 border-bottom">
        <h1 class="h3">Edit Blog Post</h1>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>

    {{-- Display all validation errors at the top --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-exclamation-circle"></i> Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data" id="blogForm">
        @csrf @method('PUT')
        <div class="bg-white rounded-3 border p-4">
            <div class="row">
                <div class="col-md-8">
                    <!-- Title -->
                    <div class="mb-3">
                        <label class="form-label">Title *</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $blog->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Content (Quill Editor) -->
                    <div class="mb-3">
                        <label class="form-label">Content *</label>
                        <div id="editor" style="height: 400px;"></div>
                        <textarea name="content" id="content" style="display:none;">{{ old('content', $blog->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Featured Image -->
                    <div class="mb-3">
                        <label class="form-label">Featured Image</label>
                        @if($blog->featured_image)
                            <div class="mb-2">
                                <img src="{{ $blog->featured_image_url }}" alt="Current image" class="img-thumbnail" style="max-height:150px;">
                            </div>
                        @endif
                        <input type="file" name="featured_image" class="form-control @error('featured_image') is-invalid @enderror" accept="image/*">
                        @error('featured_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Leave empty to keep current image. Max 2MB.</small>
                    </div>
                    <!-- Author -->
                    <div class="mb-3">
                        <label class="form-label">Author</label>
                        <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" value="{{ old('author', $blog->author) }}">
                        @error('author')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Published At -->
                    <div class="mb-3">
                        <label class="form-label">Published At</label>
                        <input type="datetime-local" name="published_at" class="form-control @error('published_at') is-invalid @enderror" value="{{ old('published_at', $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}">
                        @error('published_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Publish Checkbox -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="is_published" class="form-check-input" id="isPublished" {{ old('is_published', $blog->is_published) ? 'checked' : '' }}>
                        <label class="form-check-label" for="isPublished">Published</label>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <span class="spinner-border spinner-border-sm d-none me-2" id="spinner" role="status" aria-hidden="true"></span>
                    <span id="btnText"><i class="fas fa-save me-1"></i> Update Post</span>
                </button>
            </div>
        </div>
    </form>

    <!-- Quill & Loader Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Quill Editor
            var quill = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['link', 'blockquote', 'code-block'],
                        ['clean']
                    ]
                }
            });

            var contentField = document.getElementById('content');
            if (contentField.value) {
                quill.root.innerHTML = contentField.value;
            }

            // Form submission with loader
            var form = document.getElementById('blogForm');
            var submitBtn = document.getElementById('submitBtn');
            var spinner = document.getElementById('spinner');
            var btnText = document.getElementById('btnText');

            form.addEventListener('submit', function() {
                // Update hidden textarea with Quill content
                contentField.value = quill.root.innerHTML;

                // Show loader and disable button
                if (!submitBtn.disabled) {
                    submitBtn.disabled = true;
                    spinner.classList.remove('d-none');
                    btnText.innerHTML = 'Updating...';
                }
            });
        });
    </script>
@endsection