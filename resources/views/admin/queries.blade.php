@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>All Queries</h2>
    <a href="{{ route('admin.home') }}" class="btn btn-primary mb-3">Back to Admin Home</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Message</th>
                <th>Status</th>
                <th>Handled By</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($queries as $query)
                <tr>
                    <td>{{ $query->user->username }}</td>
                    <td>{{ $query->message }}</td>
                    <td>{{ $query->status}}</td>
                    <td>{{ $query->employee ? $query->employee->username : 'N/A' }}</td>
                    <td>{{ $query->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

