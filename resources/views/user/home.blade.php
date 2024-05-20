@extends('user.layouts.user')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center text-white bg-black">{{ __('User Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- {{ __('You are logged in!') }} -->
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
