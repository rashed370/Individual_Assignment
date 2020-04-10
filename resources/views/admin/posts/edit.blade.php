@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update Post <a href="{{ route( 'home' ) }}" class="btn btn-danger float-right btn-sm">Cancel</a></div>

                    <div class="card-body">
                        @if (session('status_error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('status_error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('posts_update_post', ['id' => $post->id]) }}">
                            @csrf

                            <div class="form-group row">
                                <label for="place" class="col-md-4 col-form-label text-md-right">{{ __('Place') }}</label>

                                <div class="col-md-6">
                                    <input id="place" type="text" class="form-control @error('place') is-invalid @enderror" name="place" value="{{ old('place', $post->place) }}" required autocomplete="place" autofocus>

                                    @error('place')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="details" class="col-md-4 col-form-label text-md-right">{{ __('Short History') }}</label>

                                <div class="col-md-6">
                                    <textarea id="details" class="form-control @error('details') is-invalid @enderror" name="details" required>{{ old('details', $post->details) }}</textarea>

                                    @error('details')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                                <div class="col-md-6">
                                    <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country', $post->country) }}" required autocomplete="country" autofocus>

                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="genre" class="col-md-4 col-form-label text-md-right">{{ __('Genre') }}</label>

                                <div class="col-md-6">
                                    <input id="genre" type="text" class="form-control @error('genre') is-invalid @enderror" name="genre" value="{{ old('genre', $post->genre) }}" required autocomplete="genre" autofocus>

                                    @error('genre')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="medium" class="col-md-4 col-form-label text-md-right">{{ __('Travel Medium') }}</label>

                                <div class="col-md-6">
                                    <input id="medium" type="text" class="form-control @error('medium') is-invalid @enderror" name="medium" value="{{ old('medium', $post->medium) }}" required autocomplete="medium" autofocus>

                                    @error('genre')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cost" class="col-md-4 col-form-label text-md-right">{{ __('Cost') }}</label>

                                <div class="col-md-6">
                                    <input id="cost" type="text" class="form-control @error('cost') is-invalid @enderror" name="cost" value="{{ old('cost', $post->cost) }}" required autocomplete="cost" autofocus>

                                    @error('cost')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Information') }}
                                    </button>
                                    <a class="ml-2" href="{{ route('home') }}">Back to Home</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
