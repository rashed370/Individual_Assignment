@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Search</div>

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

                        <form method="post" action="{{ route('posts_search') }}">
                            @csrf
                            <div class="row">
                                <div class="col pr-1 pl-1">
                                    <input name="place" type="text" class="form-control" placeholder="Place" value="{{ old('place') }}">
                                </div>
                                <div class="col pr-1 pl-1">
                                    <input name="country" type="text" class="form-control" placeholder="Country" value="{{ old('country') }}">
                                </div>
                                <div class="col pr-1 pl-1">
                                    <input name="genre" type="text" class="form-control" placeholder="Genre" value="{{ old('genre') }}">
                                </div>
                                <div class="col pr-1 pl-1">
                                    <input name="cost_min" type="text" class="form-control" placeholder="Cost Min" value="{{ old('cost_min', 0) }}">
                                </div>
                                <div class="col pr-1 pl-1">
                                    <input name="cost_max" type="text" class="form-control" placeholder="Cost Max" value="{{ old('cost_max') }}">
                                </div>
                                <div class="col pr-1 pl-1">
                                    <button type="submit" class="btn btn-success">Search</button>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
                @foreach($posts as $post)
                    <div class="card mt-4">
                        <div class="card-header">{{ $post->place }} [ {{ $post->genre }} ]</div>

                        <div class="card-body">
                            {{ $post->details }}
                            <p><a href="{{ route('posts_view', ['id' => $post->id]) }}">View Details</a></p>
                        </div>
                        <div class="card-footer">{{ $post->cost }} BDT</div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
