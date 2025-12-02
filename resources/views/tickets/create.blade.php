@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Log New Ticket</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('tickets.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="category">Category</label>
            <select name="category" id="category" class="form-control" required>
                <option value="sales">Sales</option>
                <option value="accounts">Accounts</option>
                <option value="it">IT</option>
            </select>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="issue">Issue Description</label>
            <textarea name="issue" class="form-control" rows="4" required></textarea>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="latitude">Latitude</label>
                <input type="text" name="latitude" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="longitude">Longitude</label>
                <input type="text" name="longitude" class="form-control">
            </div>
        </div>

        <button type="submit" class="btn btn-success">Submit Ticket</button>
    </form>
</div>
@endsection
