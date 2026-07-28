@extends('layouts.layout') 

@section('title', 'All Users')

@section('content')
    <div class="d-flex justify-content-between align-items-center pt-1 pb-3 mb-4 border-bottom">
        <h1 class="h3">All Users</h1>
        <span class="text-muted">Total: {{ $users->count() }}</span>
    </div>

    {{-- Search & Filter Form --}}
    <form method="GET" action="{{ route('admin.users') }}" class="row g-3 mb-4">
        <div class="col-md-3">
            <input type="text" name="search" class="form-control" placeholder="Search by name or email..." value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <select name="country" class="form-select">
                <option value="">All Countries</option>
                @foreach($countries as $code)
                    <option value="{{ $code }}" {{ request('country') == $code ? 'selected' : '' }}>
                        {{ strtoupper($code) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="course_interest" class="form-select">
                <option value="">All Interests</option>
                @foreach($interests as $interest)
                    <option value="{{ $interest }}" {{ request('course_interest') == $interest ? 'selected' : '' }}>
                        {{ $interest }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}" placeholder="Date From">
        </div>
        <div class="col-md-2">
            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}" placeholder="Date To">
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>

    {{-- Export Button --}}
    <div class="mb-3">
        <a href="{{ route('admin.users.export', request()->query()) }}" class="btn btn-success">
            <i class="fas fa-file-excel me-1"></i> Export as CSV
        </a>
        <a href="{{ route('admin.users') }}" class="btn btn-secondary">
            <i class="fas fa-sync me-1"></i> Reset Filters
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="bg-white rounded-3 border p-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Country</th>
                        <th>Phone (Primary)</th>
                        <th>Referral Code</th>
                        <th>Referred By</th>
                        <th>Course Interest</th>
                        <th>Moodle ID</th>
                        <th>Registered</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->country ?? '—' }}</td>
                            <td>{{ $user->phone_primary ?? '—' }}</td>
                            <td>
                                <span class="badge bg-primary">{{ $user->referral_code ?? '—' }}</span>
                            </td>
                            <td>{{ $user->referred_by ?? '—' }}</td>
                            <td>{{ $user->course_interest ?? '—' }}</td>
                            <td>{{ $user->moodle_id ?? '—' }}</td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection