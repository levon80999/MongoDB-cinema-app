@extends('user.layout.app')

@section('content')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-6">
                        <div class="white-box text-center">
                            <img src="{{ asset('/public/images/'.$film->image) }}" width="430"
                                 height="600" class="img-responsive">
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-6">
                        <h3 class="box-title mt-5">{{ $film->name }}</h3>
                        <hr>
                        <p>{{ $film->description }}</p>
                        <button class="btn btn-dark btn-rounded mr-1" data-toggle="tooltip" title="" data-original-title="Add to cart">
                            <i class="fa fa-play"></i> Watch trailer
                        </button>
                        <a href="{{ route('sessions.choose', ['id' => $film->id]) }}" class="btn btn-primary btn-rounded">Buy ticket</a>
                        <h3 class="box-title mt-5">Actors</h3>
                        <hr>
                        <div class="row" style="display: flex; justify-content: start;">
                            @foreach ($film->actors as $actor)
                                <div class="col-3">
                                    <div class="card" style="width: 9rem;">
                                        <img src="{{ asset('/public/actors/images/'.$actor->image) }}" width="auto" height="200"
                                             alt="{{ $actor->image }}"/>
                                        <div class="card-body">
                                            <a href="{{ route('actor.single', ['id' => $actor->_id]) }}" class="card-title">{{ $actor->fullName }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <h3 class="box-title mt-5">Producer</h3>
                        <hr>
                        <div class="card" style="width: 9rem;">
                            <img src="{{ asset('/public/producers/images/'.$film->producer->image) }}" width="auto" height="auto"
                                 alt="{{ $film->producer->image }}"/>
                            <div class="card-body">
                                <a href="{{ route('producer.single', ['id' => $film->producer_id]) }}" class="card-title">{{ $film->producer->fullName }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h3 class="box-title mt-5">General Info</h3>
                        <div class="table-responsive">
                            <table class="table table-striped table-product">
                                <tbody>
                                    <tr>
                                        <td width="200px">Realise Date:</td>
                                        <td>{{ $film->date }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200px">Country:</td>
                                        <td>{{ $film->country }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200px">Budget: </td>
                                        <td>{{ $film->budget }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200px">Genre: </td>
                                        <td>{{ $film->genre }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200px">Age: </td>
                                        <td>{{ $film->age ?? '0+' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200px">Time: </td>
                                        <td>{{ $film->duration }} Minutes</td>
                                    </tr>
                                    <tr>
                                        <td width="200px">Mounting: </td>
                                        <td>{{ $film->mounting }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200px">Composer: </td>
                                        <td>{{ $film->composer }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200px">Operator: </td>
                                        <td>{{ $film->operator }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200px">Scenario: </td>
                                        <td>{{ $film->scenario }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
