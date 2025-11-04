@extends('admin.layouts.app')

@section('title', 'Admin - Contact Messages')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">📩 Contact Messages</h2>

    <!-- Contacts Table -->
    <div class="card shadow-sm p-4 rounded-3">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Received On</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $index => $contact)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ Str::limit($contact->subject, 40) }}</td>
                        <td>{{ Str::limit($contact->message, 60) }}</td>
                        <td>
                            @if($contact->status === 'new')
                                <span class="badge bg-success">New</span>
                            @elseif($contact->status === 'read')
                                <span class="badge bg-info">Read</span>
                            @else
                                <span class="badge bg-secondary">Replied</span>
                            @endif
                        </td>
                        <td>{{ $contact->created_at->format('d M Y, h:i A') }}</td>
                        <td>
                            <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn btn-sm btn-primary">View</a>
                            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete this contact message?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-muted py-4">
                            <i class="fas fa-inbox" style="font-size: 2rem; color: #ccc;"></i><br>
                            No contact messages found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination (if added later) -->
        @if(method_exists($contacts, 'links'))
            <div class="d-flex justify-content-center mt-3">
                {{ $contacts->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
