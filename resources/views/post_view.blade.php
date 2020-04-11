@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $post->place }} [ {{ $post->genre }} ]</div>

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

                        {{ $post->details }}
                        <br><br>
                        <p>
                            <strong>Country:</strong><br>
                            {{ $post->country }}
                        </p>
                        <p>
                            <strong>Travel Medium:</strong><br>
                            {{ $post->medium }}
                        </p>
                        <p>
                            <strong>Estimated Cost:</strong><br>
                            {{ $post->cost }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
