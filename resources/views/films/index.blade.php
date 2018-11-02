@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @foreach($films as $film)
                            <div class="films">
                                <h2 class="film-title">
                                    <a href="{{ route('show.films', ['slug' => $film->slug]) }}">{{ $film->name }}</a>
                                </h2>

                                <p class="film-meta">{{ $film->created_at }}</p>

                                <p class="film-description">{{ str_limit($film->description, $limit = 150, $end = '...') }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <hr/>

                <div class="pagination">
                    {{ $films->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
