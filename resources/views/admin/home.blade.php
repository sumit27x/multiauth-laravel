@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center bg-black text-white" >{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- {{ __('You are logged in!') }} -->

                    <form action="{{ route('admin.registerEmployee') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="mb-3">
        <label for="department" class="form-label">Department</label>
        <input type="text" class="form-control" id="department" name="department" required>
    </div>
    <button type="submit" class="btn btn-primary bg-black border-0">Register Employee</button>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
