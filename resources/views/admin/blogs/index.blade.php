@extends('layouts.layout')

@section('title', 'Blog Posts')

@section('content')
    <div class="d-flex justify-content-between align-items-center pt-1 pb-3 mb-4 border-bottom">
        <h1 class="h3">Blog Posts</h1>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> New Post
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="bg-white rounded-3 border p-3">
        @if($posts->count())
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $post->title }}</strong>
                                    @if($post->featured_image)
                                        <i class="fas fa-image text-muted ms-1"></i>
                                    @endif
                                </td>
                                <td>{{ $post->author ?? 'BAFAI' }}</td>
                                <td>
                                    @if($post->is_published && $post->published_at <= now())
                                        <span class="badge bg-success">Published</span>
                                    @elseif($post->is_published && $post->published_at > now())
                                        <span class="badge bg-warning">Scheduled</span>
                                    @else
                                        <span class="badge bg-secondary">Draft</span>
                                    @endif
                                </td>
                                <td>{{ $post->created_at->format('M d, Y') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.blogs.edit', $post) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $post->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete "<strong>{{ $post->title }}</strong>"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('admin.blogs.destroy', $post) }}" method="POST">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted text-center py-3">No blog posts yet. <a href="{{ route('admin.blogs.create') }}">Create one now</a>.</p>
        @endif
    </div>
@endsection