@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pending Posts</div>

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
                                <th>Place</th>
                                <th>Genre</th>
                                <th>Country</th>
                                <th>Cost</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td><a href="{{route('posts_view', ['id' => $post->id])}}">{{$post->place}}</a></td>
                                    <td>{{$post->genre}}</td>
                                    <td>{{$post->country}}</td>
                                    <td>{{$post->cost}}</td>
                                    <td><a class="btn btn-success btn-sm" href="{{route('posts_approve', ['id' => $post->id])}}">Approve</a> <a class="btn btn-primary btn-sm" href="{{route('posts_update', ['id' => $post->id])}}">Edit</a> <a class="btn btn-danger btn-sm" href="{{route('posts_delete', ['id' => $post->id])}}">Delete</a></td>
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
