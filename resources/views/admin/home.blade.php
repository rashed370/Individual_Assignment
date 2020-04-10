@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>

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
                        <li><a href="{{ route('users') }}">All Users</a></li>
                        <li><a href="{{ route('posts') }}">All Posts</a></li>
                        <li><a href="{{ route('posts_pending') }}">Pending Posts ({{ App\Post::where('published', 0)->count() }})</a></li>
                        <li><a href="{{ route('posts_modification') }}">Post Modification Request ({{ App\PostUpdate::count() }})</a></li>
                        <li><a href="{{ route('posts_delete_list') }}">Post Modification Request ({{ App\PostDelete::count() }})</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
