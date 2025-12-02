@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ticket Status #{{ $ticket->id }}</h2>

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
            <th>Status</th>
            <td>{{ ucfirst($ticket->status) }}</td>
        </tr>
        <tr>
            <th>Issue</th>
            <td>{{ $ticket->issue }}</td>
        </tr>
        <tr>
            <th>Date Logged</th>
            <td>{{ $ticket->created_at->format('Y-m-d H:i') }}</td>
        </tr>
    </table>
</div>
@endsection
