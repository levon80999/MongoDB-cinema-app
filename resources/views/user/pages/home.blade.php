@extends('user.layout.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>Welcome to new line cinema </h1>
        <p>Be aware about new films in {{ date('Y') }}</p>
    </div>

    <form action="">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Title or description...">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">Search</button>
            </div>
        </div>
    </form>
    <div class="row" style="display: flex; justify-content: space-between;">
        @if(!$bestFilms->isEmpty())
            <h2>Best of {{ date('Y') }}</h2>
            <hr>
            @foreach ($bestFilms as $film)
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('/public/images/'.$film->image) }}" width="auto" height="200"
                         alt="{{ $film->image }}"/>
                    <div class="card-body">
                        <h5 class="card-title">{{ $film->name }}</h5>
                        <p class="card-text">{{ strlen($film->description) > 180 ? substr($film->description, 0, 176).'...' : $film->description }}</p>
                        <a href="{{ route('film.view', ['id' => $film->id]) }}" class="btn btn-primary">Watch</a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <br>
    <div class="row" style="display: flex; justify-content: space-between;">
        @if(!$recentFilms->isEmpty())
            <h2>Recent movies</h2>
            <hr>
            @foreach ($recentFilms as $film)
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('/public/images/'.$film->image) }}" width="auto" height="200"
                         alt="{{ $film->image }}"/>
                    <div class="card-body">
                        <h5 class="card-title">{{ $film->name }}</h5>
                        <p class="card-text">{{ strlen($film->description) > 180 ? substr($film->description, 0, 176).'...' : $film->description }}</p>
                        <a href="{{ route('film.view', ['id' => $film->id]) }}" class="btn btn-primary">Watch</a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <br>
    <div class="row" style="display: flex; justify-content: space-between;">
        @if(!$comingSoon->isEmpty())
            <h2>Coming Soon</h2>
            <hr>
            @foreach ($comingSoon as $film)
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('/public/images/'.$film->image) }}" width="auto" height="200"
                         alt="{{ $film->image }}"/>
                    <div class="card-body">
                        <h5 class="card-title">{{ $film->name }}</h5>
                        <p class="card-text">{{ strlen($film->description) > 180 ? substr($film->description, 0, 176).'...' : $film->description }}</p>
                        <a href="{{ route('film.view', ['id' => $film->id]) }}" class="btn btn-primary">Watch</a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
