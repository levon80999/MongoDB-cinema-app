@extends('user.layout.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="white-box text-center">
                            <img src="{{ asset('/public/actors/images/'.$actor->image) }}" width="300"
                                 height="auto" class="img-responsive">
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-6">
                        <h3 class="box-title mt-5">{{ $actor->fullName }}</h3>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped table-product">
                                <tbody>
                                    <tr>
                                        <td width="200px">Date Of Birth:</td>
                                        <td>{{ $actor->dateOfBirth }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200px">Height: </td>
                                        <td>{{ $actor->height }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200px">Children: </td>
                                        <td>{{ $actor->children ? implode(', ', $actor->children) : '' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <p>{{ $actor->description }}</p>
                    </div>
                    <div class="row" style="display: flex; justify-content: start; gap: 30px;">
                        @if(!$actor->films->isEmpty())
                            <h2>Films</h2>
                            <hr>
                            @foreach ($actor->films as $film)
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
                </div>
            </div>
        </div>
    </div>
@endsection
