@extends('admin.layouts.app')

@section('title', 'Edit Service')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Edit Service</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label>Service Name</label>
                <input type="text" name="name" class="form-control" value="{{ $service->name }}" required>
            </div>

              <div class="form-group mb-3">
                <label>Price</label>
                <input type="number" name="price" class="form-control" value="{{ $service->price }}" required>
            </div>
            <div class="form-group mb-3">
    <label>Duration (minutes)</label>
    <input type="number" name="duration" class="form-control" value="{{ $service->duration }}" required>
</div>



            <div class="form-group mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control">{{ $service->description }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label>Status</label>
                <select name="is_active" class="form-control">
                    <option value="1" {{ $service->is_active ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$service->is_active ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
