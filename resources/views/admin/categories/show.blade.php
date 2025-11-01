@extends('admin.layouts.app')

@section('title', 'Category Details')
@section('page-title', 'Category Details')

@section('content')
<div class="dashboard-wrapper">
    <div class="dashboard-header">
        <div class="header-content">
            <h1 class="dashboard-title">Category Details</h1>
            <p class="dashboard-subtitle">View the information of this category in detail.</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Categories
            </a>
        </div>
    </div>

    <!-- Category Details Card -->
    <div class="dashboard-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="card-title mb-0">{{ $category->name }}</h2>
            <div>
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary me-2">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>

        <div class="card-content p-4">
            <div class="category-details-grid">
                <!-- Image -->
                <div class="detail-item image-section">
                    <label class="detail-label">Category Image</label>
                    @if($category->image)
                        <img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->name }}" class="category-img">
                    @else
                        <div class="no-image">No image uploaded</div>
                    @endif
                </div>

                <!-- Basic Info -->
                <div class="detail-item">
                    <label class="detail-label">Category Name</label>
                    <p class="detail-value">{{ $category->name }}</p>
                </div>

                <div class="detail-item">
                    <label class="detail-label">Slug</label>
                    <p class="detail-value text-muted">{{ $category->slug }}</p>
                </div>

                <div class="detail-item">
                    <label class="detail-label">Status</label>
                    <p class="detail-value">
                        @if($category->is_active)
                            <span class="status-badge active">Active</span>
                        @else
                            <span class="status-badge inactive">Inactive</span>
                        @endif
                    </p>
                </div>

                <div class="detail-item full-width">
                    <label class="detail-label">Description</label>
                    <p class="detail-value">{{ $category->description ?? 'No description provided.' }}</p>
                </div>

                <div class="detail-item">
                    <label class="detail-label">Created At</label>
                    <p class="detail-value">{{ $category->created_at->format('d M, Y h:i A') }}</p>
                </div>

                <div class="detail-item">
                    <label class="detail-label">Last Updated</label>
                    <p class="detail-value">{{ $category->updated_at->format('d M, Y h:i A') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .category-details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 20px;
        align-items: start;
    }

    .detail-item {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 15px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    .detail-item.full-width {
        grid-column: 1 / -1;
    }

    .detail-label {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 8px;
        display: block;
    }

    .detail-value {
        font-size: 15px;
        color: var(--text);
        line-height: 1.6;
    }

    .category-img {
        max-width: 100%;
        border-radius: var(--radius);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .no-image {
        padding: 30px;
        text-align: center;
        color: var(--gray);
        border: 1px dashed var(--border);
        border-radius: var(--radius);
        font-style: italic;
    }

    .status-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    .status-badge.active {
        background-color: #d1e7dd;
        color: #0f5132;
    }

    .status-badge.inactive {
        background-color: #f8d7da;
        color: #842029;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: none;
        border-radius: var(--radius);
        padding: 8px 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
    }

    .btn-secondary {
        background: var(--gray);
        color: white;
        text-decoration: none;
    }

    .btn-danger {
        background: #dc3545;
        color: white;
    }

    .btn:hover {
        opacity: 0.9;
    }
</style>
@endpush
@endsection
