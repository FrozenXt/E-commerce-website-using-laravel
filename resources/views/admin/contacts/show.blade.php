@extends('admin.layouts.app')

@section('title', 'View Message')

@section('content')

<div class="admin-page">
    <div class="page-header">
        <h1>Message Details</h1>
        <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">← Back to Messages</a>
    </div>

```
<div class="card mt-4">
    <div class="card-header">
        <h3>{{ $message->subject ?? 'No Subject' }}</h3>
    </div>
    <div class="card-body">
        <p><strong>From:</strong> {{ $message->name }} ({{ $message->email }})</p>
        @if($message->phone)
            <p><strong>Phone:</strong> {{ $message->phone }}</p>
        @endif
        <hr>
        <p style="white-space: pre-line;">{{ $message->body }}</p>
        <hr>
        <p class="text-muted"><strong>Received:</strong> {{ $message->created_at->format('d M Y, h:i A') }}</p>
    </div>

    <div class="card-footer d-flex justify-content-between">
        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Message</button>
        </form>

        @if (! $message->is_read)
            <form action="{{ route('admin.messages.markAsRead', $message) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Mark as Read</button>
            </form>
        @endif
    </div>
</div>
```

</div>
@endsection
