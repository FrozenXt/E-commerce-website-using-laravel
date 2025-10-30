@extends('admin.layouts.app')

@section('title', 'Add New Product')
@section('page-title', 'Add New Product')

@section('content')
<div class="card" style="max-width: 900px;">
    <div class="card-header">
        <h3 class="card-title">Product Information</h3>
        <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-arrow-left"></i> Back to Products
        </a>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label class="form-label">Product Name *</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name')
            <small style="color: var(--danger);">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Category *</label>
            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                <option value="">Select a category</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
            @error('category_id')
            <small style="color: var(--danger);">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Description *</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
            @error('description')
            <small style="color: var(--danger);">{{ $message }}</small>
            @enderror
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label class="form-label">Regular Price *</label>
                <input type="number" name="price" step="0.01" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required>
                @error('price')
                <small style="color: var(--danger);">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Discount Price</label>
                <input type="number" name="discount_price" step="0.01" class="form-control @error('discount_price') is-invalid @enderror" value="{{ old('discount_price') }}">
                @error('discount_price')
                <small style="color: var(--danger);">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label class="form-label">Brand</label>
                <input type="text" name="brand" class="form-control @error('brand') is-invalid @enderror" value="{{ old('brand') }}">
                @error('brand')
                <small style="color: var(--danger);">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Stock Quantity *</label>
                <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', 0) }}" required>
                @error('stock')
                <small style="color: var(--danger);">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Product Image *</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" required>
            <small style="color: var(--gray); display: block; margin-top: 5px;">Accepted formats: JPG, PNG. Max size: 2MB</small>
            @error('image')
            <small style="color: var(--danger);">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} style="width: 20px; height: 20px;">
                <span class="form-label" style="margin: 0;">Mark as Featured Product</span>
            </label>
        </div>

        <div style="display: flex; gap: 15px; padding-top: 20px; border-top: 1px solid var(--gray-light);">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Create Product
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn" style="background: var(--gray-light); color: var(--dark);">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection