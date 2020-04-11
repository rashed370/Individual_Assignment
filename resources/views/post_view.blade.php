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

                <div class="card mt-4">
                    @if($post->comments->count()>0)
                    <div class="card-header">Comments</div>
                    <div class="card-body">
                        @foreach($post->comments as $comment)
                            <p>
                                <strong>{{ $comment->user->name }}</strong><br>
                                {{ $comment->comment }}
                                @if(auth()->user()->role=='admin')
                                    <br>
                                    <a href="{{ route('posts_delete_comment', ['id' => $comment->id]) }}" class="badge badge-danger btn-sm">Remove</a>
                                @endif
                            </p>
                        @endforeach
                    </div>
                    @endif

                    @if(auth()->user()->role=='user')
                    <div class="card-footer">
                        <form action="{{ route('posts_comment_post', ['id' => $post->id]) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="comment">Leave a Comment</label>
                                <textarea id="comment" class="form-control @error('comment') is-invalid @enderror" name="comment" required>{{ old('comment') }}</textarea>
                                @error('comment')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    @endif
                </div>

            </div>
        </div>

    </div>
@endsection
