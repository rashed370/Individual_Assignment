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
