@extends('layouts.layout') 

@section('title', 'Resources')

@section('content')
    <div class="d-flex justify-content-between align-items-center pt-1 pb-3 mb-4 border-bottom">
        <h1 class="h3">Resources</h1>
        <a href="{{ route('admin.resources.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> New Resource
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="bg-white rounded-3 border p-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>File / Link</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($resources as $resource)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $resource->title }}</strong></td>
                            <td><span class="badge bg-secondary">{{ ucfirst($resource->type) }}</span></td>
                            <td>
                                @if($resource->file_path)
                                    <i class="fas fa-file me-1"></i> File
                                @elseif($resource->external_url)
                                    <i class="fas fa-link me-1"></i> Link
                                @else
                                    —
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $resource->is_published ? 'success' : 'secondary' }}">
                                    {{ $resource->is_published ? 'Published' : 'Draft' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.resources.edit', $resource) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $resource->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $resource->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirm Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                Delete "<strong>{{ $resource->title }}</strong>"?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('admin.resources.destroy', $resource) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted">No resources found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection