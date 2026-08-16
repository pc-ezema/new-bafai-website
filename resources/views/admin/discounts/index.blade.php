@extends('layouts.layout') @section('title', 'Discount Codes')

@section('content')
    <div class="d-flex justify-content-between align-items-center pt-1 pb-3 mb-4 border-bottom">
        <h1 class="h3">Discount Codes</h1>
        <a href="{{ route('admin.discounts.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> New Code
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-3 border p-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Type</th>
                        <th>Value</th>
                        <th>Uses</th>
                        <th>Max Uses</th>
                        <th>Expires</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($discounts as $discount)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $discount->code }}</strong></td>
                            <td>{{ ucfirst($discount->type) }}</td>
                            <td>{{ $discount->type === 'percentage' ? $discount->value.'%' : '$'.number_format($discount->value, 2) }}</td>
                            <td>{{ $discount->used_count }}</td>
                            <td>{{ $discount->max_uses ?? '∞' }}</td>
                            <td>{{ $discount->expires_at ? $discount->expires_at->format('Y-m-d') : 'Never' }}</td>
                            <td>
                                @if($discount->isValid())
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.discounts.edit', $discount) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $discount->id }}"><i class="fas fa-trash"></i></button>
                                <!-- delete modal -->
                                <div class="modal fade" id="deleteModal{{ $discount->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirm Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">Delete "{{ $discount->code }}"?</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('admin.discounts.destroy', $discount) }}" method="POST">
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
                        <tr><td colspan="9" class="text-center text-muted">No discount codes created yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection