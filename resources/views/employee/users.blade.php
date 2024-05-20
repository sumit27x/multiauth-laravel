
@extends('employee.layouts.app')

@section('title', 'All Users')

@section('content')
<div class="container mt-5">
    <h2>All Users</h2>
    <a href="{{ route('employee.home') }}" class="btn btn-primary mb-3">Back to Employee Home</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Username</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Registered At</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->gender }}</td>
                    <td>{{ $user->dob }}</td>
                    <td>{{ $user->registered_at }}</td>
                    <td>{{ $user->status ? 'Active' : 'Inactive' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
