@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">All Users <a href="{{ route('users_add') }}" class="btn btn-success float-right btn-sm">Add New</a></div>

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

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{ucfirst($user->role)}}</td>
                                        <td><a class="btn btn-primary btn-sm" href="{{route('users_update', ['id' => $user->id])}}">Edit</a> <a class="btn btn-danger btn-sm" href="{{route('users_delete', ['id' => $user->id])}}">Delete</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('home') }}">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
