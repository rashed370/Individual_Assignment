@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Wish List <a href="{{ route('posts') }}" class="btn btn-success float-right btn-sm">Add New</a></div>

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
                            @php $totalCost = 0 @endphp
                            @foreach($posts as $post)
                                <tr>
                                    <td><a href="{{ route('posts_view', ['id' => $post->post->id]) }}">{{$post->post->place}}</a></td>
                                    <td>{{$post->post->genre}}</td>
                                    <td>{{$post->post->country}}</td>
                                    <td>{{$post->post->cost}}</td>
                                    <td><a class="btn btn-danger btn-sm" href="{{route('wishlist_delete', ['id' => $post->id])}}">Delete</a></td>
                                </tr>
                                @php $totalCost += $post->post->cost @endphp
                            @endforeach
                                <tr>
                                    <td colspan="3" class="text-right"> <strong>Total Cost</strong> </td>
                                    <td> {{ $totalCost }}</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="{{ route('home') }}">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
