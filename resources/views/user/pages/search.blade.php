@extends('user.layout.app')

@section('content')
    <form action="{{ route('search') }}">
        <div class="row">
            <div class="col">
                <input type="text" class="form-control" name="film_name" placeholder="Film name" value="{{ request()->query('film_name') }}" />
            </div>
            <div class="col">
                <input type="text" class="form-control" name="actor_name" placeholder="Actor name" value="{{ request()->query('actor_name') }}" />
            </div>
            <div class="col">
                <input type="text" class="form-control" name="producer_name" placeholder="Producer name" value="{{ request()->query('producer_name') }}" />
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <select class="form-control" name="year">
                    @php ($currentYear = date('Y'))
                    <option value="">Select Year</option>
                    @for ($i = 1970; $i <= $currentYear; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="col">
                <button type="submit" class="btn btn-success">Search</button>
            </div>
        </div>
    </form>
    <div class="row mt-5" style="display: flex; justify-content: flex-start; gap: 24px;">
        @if(!$films->isEmpty())
            <hr>
            @foreach ($films as $film)
                <div class="card mt-4" style="width: 18rem;">
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
