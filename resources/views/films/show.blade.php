@extends ('layouts.app')

@section ('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="films">
                        <h2 class="film-title">{{ $film->name }}</h2>
                        <p class="film-meta">{{ $film->created_at }}</p>
                        <p class="film-description">{{ str_limit($film->description, $limit = 150, $end = '...') }}</p>
                    </div>

                    @if( Auth::user() )
                        <div class="container col-md-12">
                            <h4>Leave a comment</h4>

                            <form action="{{ action('Web\CommentController@store') }}" method="POST" accept-charset="utf-8">
                                {{ csrf_field() }}
                                <input type="hidden" name="film_id" value="{{ $film->id }}">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input name="name" class="form-control" id="name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label for="comment">Comment</label>
                                    <textarea name="comment" class="form-control" id="comment" placeholder="Comment"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            <div class=row></div>
                        </div>
                        <hr>
                    @endif

                    <h5 class="mt-5">Comments</h5>

                    <div class="container col-md-12">
                        @foreach($film->comments as $comment)
                            <div>
                                <span>Name: {{ $comment->name }}</span>
                                <br>
                                <span>Comment: {{ $comment->comment }}</span>
                                <br>
                                <span>{{ $comment->created_at }}</span>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection