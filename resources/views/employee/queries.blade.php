@extends('employee.layouts.app')

@section('content')
<div class="container">
    <h2>All Queries</h2>
    <a href="{{ route('employee.home') }}" class="btn btn-primary mb-3">Back to Employee Home</a>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Message</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($queries as $query)
                <tr>
                    <td>{{ $query->user->username }}</td>
                    <td>{{ $query->message }}</td>
                    <td>{{ $query->status }}</td>
                    <td>{{ $query->created_at }}</td>
                    <td>
                        @if ($query->status == 'Pending')
                            <form action="{{ route('queries.updateStatus', $query) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="Read">
                                <button type="submit" class="btn btn-success">Mark as Read</button>
                            </form>
                            <form action="{{ route('queries.updateStatus', $query) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="Dumped">
                                <button type="submit" class="btn btn-danger">Mark as Dumped</button>
                            </form>
                        @else
                            <button class="btn btn-secondary" disabled>{{ $query->status }}</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
