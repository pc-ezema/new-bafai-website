@extends('layouts.layout') @section('title', 'Course Prices')

@section('content')
    <div class="d-flex justify-content-between align-items-center pt-1 pb-3 mb-4 border-bottom">
        <h1 class="h3">Course Prices</h1>
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
                        <th>Course</th>
                        <th>Original Price</th>
                        <th>Discounted Price</th>
                        <th>Currency</th>
                        <th>Discount Ends</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($courses as $course)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $course->fullname }}</strong></td>
                            <td>{{ $course->original_price ? number_format($course->original_price, 2) : '—' }}</td>
                            <td>{{ $course->discounted_price ? number_format($course->discounted_price, 2) : '—' }}</td>
                            <td>{{ $course->currency ?? 'USD' }}</td>
                            <td>{{ $course->discount_ends_at ? \Carbon\Carbon::parse($course->discount_ends_at)->format('Y-m-d') : 'Never' }}</td>
                            <td>
                                @if($course->discounted_price && $course->discounted_price < $course->original_price)
                                    <span class="badge bg-success">On Sale</span>
                                @else
                                    <span class="badge bg-secondary">Regular</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.course-prices.edit', $course->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($course->original_price || $course->discounted_price)
                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $course->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $course->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">Remove price for "{{ $course->fullname }}"?</div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('admin.course-prices.destroy', $course->id) }}" method="POST">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center text-muted">No courses found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection