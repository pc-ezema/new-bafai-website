@extends('layouts.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-3 mb-4 border-bottom">
        <h1 class="h3">Dashboard</h1>
        <span class="text-muted small">Welcome back, {{ Auth::guard('admin')->user()->name ?? 'Admin' }}</span>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="stats-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="number">{{ $totalUsers }}</div>
                        <div class="label">Total Users</div>
                    </div>
                    <i class="fas fa-users icon"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="number">{{ $totalBlogs }}</div>
                        <div class="label">Total Blogs</div>
                    </div>
                    <i class="fas fa-blog icon"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="bg-white rounded-3 border p-3">
                <h6 class="fw-semibold mb-3">Recent Users</h6>
                <ul class="list-group list-group-flush">
                    @forelse($recentUsers as $user)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $user->name }}</span>
                            <span class="text-muted small">{{ $user->email }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">No users yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="bg-white rounded-3 border p-3">
                <h6 class="fw-semibold mb-3">Recent Blogs</h6>
                <ul class="list-group list-group-flush">
                    @forelse($recentBlogs as $blog)
                        <li class="list-group-item">{{ $blog->title }}</li>
                    @empty
                        <li class="list-group-item text-muted">No blogs yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection