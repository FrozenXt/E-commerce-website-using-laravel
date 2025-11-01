@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Edit Category</h4>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-light btn-sm">
                <i class="bi bi-arrow-left"></i> Back to Categories
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="name" class="form-label fw-bold">Category Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name', $category->name) }}" 
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="Enter category name"
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if(isset($category->slug))
                <div class="form-group mb-3">
                    <label for="slug" class="form-label fw-bold">Slug</label>
                    <input 
                        type="text" 
                        id="slug" 
                        name="slug" 
                        value="{{ old('slug', $category->slug) }}" 
                        class="form-control"
                        placeholder="auto-generated or edit manually"
                    >
                </div>
                @endif

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
