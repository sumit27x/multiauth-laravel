@extends('user.layouts.app')

@section('content')
<div class="container">
    <h2>Submit a Query</h2>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('queries.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea class="form-control" id="message" name="message" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </form>
</div>
@endsection
