@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Support Tickets</h2>
    <a href="{{ route('tickets.create') }}" class="btn btn-success">Log New Ticket</a>
</div>

{{-- Filter & Sort Form --}}
<form method="GET" class="mb-4">
    <div class="row g-3">
        <div class="col-md-3">
            <label class="form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
        </div>
        <div class="col-md-3">
            <label class="form-label">End Date</label>
            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
        </div>
        <div class="col-md-3">
            <label class="form-label">Sort By</label>
            <select name="sort_by" class="form-select">
                <option value="created_at" {{ request('sort_by', 'created_at') == 'created_at' ? 'selected' : '' }}>
                    Date Logged (default)
                </option>
                <option value="first_name" {{ request('sort_by') == 'first_name' ? 'selected' : '' }}>First Name</option>
                <option value="last_name" {{ request('sort_by') == 'last_name' ? 'selected' : '' }}>Last Name</option>
                <option value="status" {{ request('sort_by') == 'status' ? 'selected' : '' }}>Status</option>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Direction</label>
            <select name="direction" class="form-select">
                <option value="desc" {{ request('direction', 'desc') == 'desc' ? 'selected' : '' }}>Descending</option>
                <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
            </select>
        </div>
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-primary me-2">Apply Filters</button>
        <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Clear</a>
    </div>
</form>

{{-- Success message --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- Tickets Table --}}
@if($tickets->count())
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Logged On</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ ucfirst($ticket->category) }}</td>
                        <td>{{ $ticket->first_name }} {{ $ticket->last_name }}</td>
                        <td>{{ $ticket->email }}</td>
                        <td>
                            {{-- PHP 7.4 compatible badge logic --}}
                            @if($ticket->status === 'new')
                                <span class="badge bg-danger">New</span>
                            @elseif($ticket->status === 'in_progress')
                                <span class="badge bg-warning text-dark">In Progress</span>
                            @elseif($ticket->status === 'resolved')
                                <span class="badge bg-success">Resolved</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($ticket->status) }}</span>
                            @endif
                        </td>
                        <td>{{ $ticket->created_at->format('d M Y') }}</td>
                        <td class="text-center">
                            <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-sm btn-info">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $tickets->appends(request()->query())->links() }}
@else
    <div class="alert alert-info">
        No tickets found. Try adjusting filters or <a href="{{ route('tickets.create') }}">log a new one</a>.
    </div>
@endif
@endsection
