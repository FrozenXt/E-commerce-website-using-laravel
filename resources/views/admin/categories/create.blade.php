@extends('admin.layouts.app')

@section('title', 'Add Category')
@section('page-title', 'Add New Category')

@section('content')
<div class="dashboard-wrapper">
    <div class="dashboard-header">
        <div class="header-content">
            <h1 class="dashboard-title">Add New Category</h1>
            <p class="dashboard-subtitle">Create a new category to organize your products and services.</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Categories
            </a>
        </div>
    </div>

    <!-- Category Form Card -->
    <div class="dashboard-card">
        <div class="card-header">
            <h2 class="card-title">Category Details</h2>
        </div>
        <div class="card-content p-4">
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-grid">
                    <!-- Category Name -->
                    <div class="form-group">
                        <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter category name" value="{{ old('name') }}" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div class="form-group">
                        <label for="slug" class="form-label">Slug (Auto or Manual)</label>
                        <input type="text" name="slug" id="slug" class="form-control" placeholder="category-slug" value="{{ old('slug') }}">
                        @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-group full-width">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4" placeholder="Write a short description...">{{ old('description') }}</textarea>
                    </div>

                    <!-- Image Upload -->
                    <div class="form-group">
                        <label for="image" class="form-label">Category Image</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        <div class="image-preview mt-3" id="imagePreview">
                            <img src="#" alt="Preview" class="preview-img" style="display: none;">
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label for="is_active" class="form-label">Status</label>
                        <select name="is_active" id="is_active" class="form-control">
                            <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-actions mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
        color: var(--dark);
    }

    .form-control {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        background: var(--white);
        font-size: 15px;
        transition: var(--transition);
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        outline: none;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        border: none;
        border-radius: var(--radius);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
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

    .btn-primary:hover {
        background: #274bdb;
    }

    .image-preview {
        border: 1px dashed var(--border);
        border-radius: var(--radius);
        padding: 10px;
        text-align: center;
    }

    .preview-img {
        max-width: 200px;
        border-radius: var(--radius);
    }
</style>
@endpush

@push('scripts')
<script>
document.getElementById('image').addEventListener('change', function(e) {
    const [file] = e.target.files;
    if (file) {
        const preview = document.querySelector('.preview-img');
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
});
</script>
@endpush
@endsection
