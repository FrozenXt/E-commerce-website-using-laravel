@extends('layouts.app')

@section('title', 'Add New Service')

@section('content')

<div class="form-container">
    <!-- Background Decoration -->
    <div class="bg-decoration"></div>

    <div class="form-wrapper">
        <!-- Header -->
        <div class="form-header">
            <div class="header-content">
                <div class="header-icon">
                    <i class="fas fa-tools"></i>
                </div>
                <div>
                    <h1 class="form-title">Add New Service</h1>
                    <p class="form-subtitle">Create a new service for your customers</p>
                </div>
            </div>
            <a href="{{ route('admin.services.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="alert-container">
                <div class="alert alert-error">
                    <div class="alert-icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="alert-content">
                        <h4 class="alert-title">Validation Error</h4>
                        <p class="alert-message">Please fix the following issues:</p>
                        <ul class="alert-list">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="service-form">
            @csrf

            <!-- Basic Information Section -->
            <div class="form-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i class="fas fa-info-circle"></i> Basic Information
                    </h2>
                    <p class="section-subtitle">Enter the basic details of your service</p>
                </div>

                <div class="form-grid">
                    <!-- Service Name -->
                    <div class="form-group full-width">
                        <label for="name" class="form-label">
                            Service Name
                            <span class="required">*</span>
                        </label>
                        <div class="input-wrapper">
                            <i class="fas fa-heading"></i>
                            <input type="text" name="name" id="name" class="form-control" 
                                   placeholder="Enter service name" value="{{ old('name') }}" required>
                        </div>
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div class="form-group full-width">
                        <label for="slug" class="form-label">
                            Slug
                            <span class="optional">(Optional)</span>
                        </label>
                        <div class="input-wrapper">
                            <i class="fas fa-link"></i>
                            <input type="text" name="slug" id="slug" class="form-control" 
                                   placeholder="auto-generated if empty" value="{{ old('slug') }}">
                        </div>
                        <small class="helper-text">Leave blank to auto-generate from service name</small>
                    </div>

                    <!-- Description -->
                    <div class="form-group full-width">
                        <label for="description" class="form-label">
                            Description
                            <span class="required">*</span>
                        </label>
                        <textarea name="description" id="description" class="form-control textarea-control" 
                                  rows="4" placeholder="Enter service description..." required>{{ old('description') }}</textarea>
                        <small class="helper-text">Provide a detailed description of the service</small>
                        @error('description')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Price and Duration Row -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="price" class="form-label">
                                Price (₹)
                                <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <i class="fas fa-rupee-sign"></i>
                                <input type="number" name="price" id="price" step="0.01" class="form-control" 
                                       placeholder="0.00" value="{{ old('price') }}" required>
                            </div>
                            @error('price')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="duration" class="form-label">
                                Duration (minutes)
                                <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <i class="fas fa-clock"></i>
                                <input type="number" name="duration" id="duration" class="form-control" 
                                       placeholder="e.g. 45" value="{{ old('duration') }}" required>
                            </div>
                            @error('duration')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Media Section -->
            <div class="form-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i class="fas fa-image"></i> Media & Icon
                    </h2>
                    <p class="section-subtitle">Add visual elements to your service</p>
                </div>

                <div class="form-grid">
                    <!-- Icon -->
                    <div class="form-group full-width">
                        <label for="icon" class="form-label">
                            Icon
                            <span class="optional">(Optional)</span>
                        </label>
                        <div class="input-wrapper">
                            <i class="fas fa-icons"></i>
                            <input type="text" name="icon" id="icon" class="form-control" 
                                   placeholder="e.g. fas fa-laptop" value="{{ old('icon') }}">
                        </div>
                        <small class="helper-text">
                            Use <a href="https://fontawesome.com/icons" target="_blank" class="helper-link">Font Awesome icons</a> or Image URL
                        </small>
                    </div>

                    <!-- Service Image -->
                    <div class="form-group full-width">
                        <label for="image" class="form-label">
                            Service Image
                            <span class="optional">(Optional)</span>
                        </label>
                        <div class="file-upload">
                            <input type="file" name="image" id="image" class="file-input" accept="image/*">
                            <div class="file-upload-content">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p class="file-upload-text">
                                    Click to upload or drag and drop
                                </p>
                                <small>JPG, JPEG, PNG up to 2MB</small>
                            </div>
                        </div>
                        <div id="imagePreview" class="image-preview" style="display: none;">
                            <img id="previewImg" src="" alt="Preview">
                            <button type="button" class="remove-image" onclick="removeImage()">&times;</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Section -->
            <div class="form-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i class="fas fa-cog"></i> Settings
                    </h2>
                    <p class="section-subtitle">Configure service settings</p>
                </div>

                <div class="form-grid">
                    <!-- Active Status Toggle -->
                    <div class="toggle-group">
                        <div class="toggle-content">
                            <label class="toggle-label">Active Service</label>
                            <p class="toggle-description">Enable this service to make it available for bookings</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" name="is_active" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Service
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    :root {
        --primary: #3b82f6;
        --primary-light: #dbeafe;
        --primary-dark: #1e40af;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --dark: #1f2937;
        --gray: #6b7280;
        --gray-light: #f3f4f6;
        --gray-lighter: #f9fafb;
        --border: #e5e7eb;
        --border-light: #f3f4f6;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .form-container {
        position: relative;
        min-height: 100vh;
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        padding: 2rem 1rem;
    }

    .bg-decoration {
        position: absolute;
        top: 0;
        right: 0;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .form-wrapper {
        position: relative;
        max-width: 900px;
        margin: 0 auto;
        background: white;
        border-radius: 1rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    /* Header */
    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 2rem;
        background: linear-gradient(135deg, var(--primary) 0%, #2563eb 100%);
        color: white;
    }

    .header-content {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .header-icon {
        width: 3.5rem;
        height: 3.5rem;
        border-radius: 0.75rem;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
    }

    .form-title {
        font-size: 1.75rem;
        font-weight: 700;
        margin: 0;
    }

    .form-subtitle {
        font-size: 0.95rem;
        opacity: 0.9;
        margin: 0.5rem 0 0 0;
    }

    .btn-back {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 0.5rem;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        text-decoration: none;
        font-size: 1.1rem;
    }

    .btn-back:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateX(-2px);
    }

    /* Alert */
    .alert-container {
        padding: 2rem;
    }

    .alert {
        display: flex;
        gap: 1rem;
        padding: 1.5rem;
        border-radius: 0.75rem;
        animation: slideDown 0.3s ease;
    }

    .alert-error {
        background: #fef2f2;
        border: 1px solid #fee2e2;
    }

    .alert-icon {
        color: var(--danger);
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .alert-title {
        font-weight: 700;
        color: var(--danger);
        margin: 0 0 0.5rem 0;
        font-size: 1rem;
    }

    .alert-message {
        color: var(--gray);
        margin: 0 0 0.75rem 0;
        font-size: 0.95rem;
    }

    .alert-list {
        list-style: none;
        margin: 0;
        padding-left: 0;
        color: var(--gray);
        font-size: 0.9rem;
    }

    .alert-list li {
        padding: 0.25rem 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .alert-list li:before {
        content: "•";
        color: var(--danger);
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Form Content */
    .service-form {
        padding: 2rem;
    }

    /* Form Section */
    .form-section {
        margin-bottom: 2.5rem;
        padding-bottom: 2.5rem;
        border-bottom: 1px solid var(--border-light);
    }

    .form-section:last-of-type {
        border-bottom: none;
        margin-bottom: 2rem;
    }

    .section-header {
        margin-bottom: 1.5rem;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--dark);
        margin: 0 0 0.5rem 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-title i {
        color: var(--primary);
    }

    .section-subtitle {
        font-size: 0.9rem;
        color: var(--gray);
        margin: 0;
    }

    /* Form Grid */
    .form-grid {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    /* Form Group */
    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-label {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .required {
        color: var(--danger);
        font-weight: 700;
    }

    .optional {
        color: var(--gray);
        font-weight: 500;
        font-size: 0.85rem;
    }

    /* Input Wrapper */
    .input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-wrapper i {
        position: absolute;
        left: 1rem;
        color: var(--primary);
        font-size: 1rem;
        pointer-events: none;
    }

    .form-control {
        width: 100%;
        padding: 0.85rem 1rem 0.85rem 2.75rem;
        border: 1px solid var(--border);
        border-radius: 0.5rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-light);
    }

    .form-control:disabled {
        background: var(--gray-lighter);
        color: var(--gray);
        cursor: not-allowed;
    }

    .textarea-control {
        resize: vertical;
        min-height: 100px;
        padding: 1rem 1rem 1rem 2.75rem;
    }

    .helper-text {
        display: block;
        font-size: 0.85rem;
        color: var(--gray);
        margin-top: 0.5rem;
    }

    .helper-link {
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .helper-link:hover {
        color: var(--primary-dark);
        text-decoration: underline;
    }

    .error-message {
        display: block;
        color: var(--danger);
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    /* File Upload */
    .file-upload {
        position: relative;
        cursor: pointer;
    }

    .file-input {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        top: 0;
        left: 0;
    }

    .file-upload-content {
        padding: 2rem;
        border: 2px dashed var(--border);
        border-radius: 0.75rem;
        text-align: center;
        background: var(--gray-lighter);
        transition: all 0.3s ease;
    }

    .file-upload:hover .file-upload-content {
        border-color: var(--primary);
        background: var(--primary-light);
    }

    .file-upload-content i {
        font-size: 2.5rem;
        color: var(--primary);
        margin-bottom: 0.75rem;
        display: block;
    }

    .file-upload-text {
        color: var(--dark);
        font-weight: 600;
        margin: 0;
    }

    .file-upload-content small {
        display: block;
        color: var(--gray);
        margin-top: 0.5rem;
    }

    /* Image Preview */
    .image-preview {
        position: relative;
        margin-top: 1rem;
        border-radius: 0.75rem;
        overflow: hidden;
        background: var(--gray-lighter);
    }

    .image-preview img {
        width: 100%;
        max-height: 300px;
        object-fit: cover;
        display: block;
    }

    .remove-image {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        background: var(--danger);
        color: white;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .remove-image:hover {
        background: #dc2626;
        transform: scale(1.1);
    }

    /* Toggle Group */
    .toggle-group {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem;
        background: var(--gray-lighter);
        border-radius: 0.75rem;
    }

    .toggle-label {
        font-weight: 600;
        color: var(--dark);
        margin: 0;
    }

    .toggle-description {
        font-size: 0.85rem;
        color: var(--gray);
        margin: 0.5rem 0 0 0;
    }

    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 3rem;
        height: 1.5rem;
    }

    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: var(--border);
        transition: 0.3s;
        border-radius: 1.5rem;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 1.2rem;
        width: 1.2rem;
        left: 0.15rem;
        bottom: 0.15rem;
        background-color: white;
        transition: 0.3s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background-color: var(--primary);
    }

    input:checked + .slider:before {
        transform: translateX(1.5rem);
    }

    /* Buttons */
    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.85rem 1.75rem;
        border: none;
        border-radius: 0.5rem;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
    }

    .btn-secondary {
        background: var(--gray-light);
        color: var(--dark);
        border: 1px solid var(--border);
    }

    .btn-secondary:hover {
        background: var(--border);
        transform: translateY(-2px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-container {
            padding: 1rem;
        }

        .form-wrapper {
            border-radius: 0.75rem;
        }

        .form-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
            padding: 1.5rem;
        }

        .form-title {
            font-size: 1.5rem;
        }

        .service-form {
            padding: 1.5rem;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }

        .section-title {
            font-size: 1.1rem;
        }

        .toggle-group {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .bg-decoration {
            width: 250px;
            height: 250px;
        }
    }

    @media (max-width: 480px) {
        .form-header {
            padding: 1rem;
        }

        .header-content {
            gap: 1rem;
        }

        .header-icon {
            width: 3rem;
            height: 3rem;
            font-size: 1.5rem;
        }

        .form-title {
            font-size: 1.25rem;
        }

        .service-form {
            padding: 1rem;
        }

        .form-section {
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
        }
    }
</style>

<script>
    // Auto-generate slug from name
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');

    if (nameInput && slugInput) {
        nameInput.addEventListener('input', function() {
            if (!slugInput.value) {
                const slug = this.value
                    .toLowerCase()
                    .trim()
                    .replace(/\s+/g, '-')
                    .replace(/[^\w-]+/g, '');
                slugInput.value = slug;
            }
        });
    }

    // Image preview
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');

    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Remove image preview
    function removeImage() {
        imageInput.value = '';
        imagePreview.style.display = 'none';
        previewImg.src = '';
    }

    // Form validation
    const form = document.querySelector('.service-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const requiredInputs = form.querySelectorAll('[required]');
            let isValid = true;

            requiredInputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('error');
                } else {
                    input.classList.remove('error');
                }
            });

            if (!isValid) {
                e.preventDefault();
            }
        });
    }
</script>

@endsection