
@extends('admin.layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>All Employees</h2>
        <a href="{{ route('admin.home') }}" class="btn btn-primary mb-3">Back to Admin Home</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Department</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->username }}</td>
                        <td>{{ $employee->department }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

