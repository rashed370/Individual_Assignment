@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('status_error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('status_error') }}
                        </div>
                    @endif

                    <ul>
                        <li><a href="{{ route('profile') }}">Update Profile</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
