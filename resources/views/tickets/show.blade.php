@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ticket #{{ $ticket->id }}</h2>

    <table class="table table-bordered">
        <tr>
            <th>Category</th>
            <td>{{ ucfirst($ticket->category) }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $ticket->first_name }} {{ $ticket->last_name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $ticket->email }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ ucfirst($ticket->status) }}</td>
        </tr>
        <tr>
            <th>Issue</th>
            <td>{{ $ticket->issue }}</td>
        </tr>
        <tr>
            <th>Location</th>
            <td>{{ $ticket->latitude }}, {{ $ticket->longitude }}</td>
        </tr>
        <tr>
            <th>Date Logged</th>
            <td>{{ $ticket->created_at->format('Y-m-d H:i') }}</td>
        </tr>
    </table>

    <form action="{{ route('tickets.updateStatus', $ticket) }}" method="POST" class="form-inline">
        @csrf
        <label class="mr-2">Update Status:</label>
        <select name="status" class="form-control mr-2">
            <option value="new" {{ $ticket->status == 'new' ? 'selected' : '' }}>New</option>
            <option value="in progress" {{ $ticket->status == 'in progress' ? 'selected' : '' }}>In Progress</option>
            <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
        </select>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
