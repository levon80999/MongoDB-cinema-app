@extends('admin.layout.app')

@section('content')
    <div class="col py-3">
        <div class="d-flex justify-content-between">
            <h3>{{ empty($film) ? 'Create Film' : 'Edit Film' }}</h3>
            <a class="btn btn-light" href="{{ route('films.list') }}">Back to list</a>
        </div>

        @php ($action = empty($film) ? route('films.store') : route('films.update', ['id' => (string)$film->id]))

        <form action="{{ $action }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nameInput">Name</label>
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    id="nameInput"
                    placeholder="Name"
                    value="{{ old('name') ? old('name') : $film->name ?? '' }}">
                @if ($errors->has('name'))<span class="text-danger">{{ $errors->first('name') }}</span>@endif
            </div>
            <div class="form-group">
                <label for="descriptionInput">Description</label>
                <textarea class="form-control" name="description" id="descriptionInput" rows="5"
                          placeholder="Film Description">{{ !empty($film) ? $film->description : '' }}</textarea>
                @if ($errors->has('description'))<span class="text-danger">{{ $errors->first('description') }}</span>@endif
            </div>
            <div class="form-group">
                <label for="dateInput">Date</label>
                <input
                    type="date"
                    name="date"
                    class="form-control"
                    id="dateInput"
                    placeholder="Date"
                    value="{{ old('date') ? old('date') : $film->date ?? '' }}">
                @if ($errors->has('date'))<span class="text-danger">{{ $errors->first('date') }}</span>@endif
            </div>

            <div class="form-group">
                <label for="dateInput">Producer</label>
                <select class="form-select" name="producer_id" aria-label="Default select example">
                    <option>Select producer</option>
                    @foreach($producers as $producer)
                        <option value="{{$producer->id}}" {{ !empty($film) && $producer->id === $film->producer_id ? 'selected' : '' }}>{{ $producer->fullName }}</option>
                    @endforeach
                </select>
                @if ($errors->has('producer_id'))<span class="text-danger">{{ $errors->first('producer_id') }}</span>@endif
            </div>

            <div class="form-group">
                <label for="dateInput">Actors</label>
                <select class="form-select" name="actors[]" multiple aria-label="multiple select example">
                    <option>Select actors</option>
                    @foreach($actors as $actor)
                        <option value="{{$actor->id}}" {{ !empty($film) && in_array($actor->id, $film->actors->pluck('_id')->toArray()) ? 'selected' : '' }}>{{ $actor->fullName }}</option>
                    @endforeach
                </select>
                @if ($errors->has('actors'))<span class="text-danger">{{ $errors->first('actors') }}</span>@endif
            </div>
            <div class="form-group">
                @if (!empty($film))
                    <br>
                    <img src="{{ asset('/public/images/'.$film->image) }}" width="auto" height="150" alt="{{ $film->image }}" />
                    <br>
                @endif

                <label for="fileInput">Image</label>
                <input
                    type="file"
                    name="image"
                    class="form-control"
                    id="fileInput">
                @if ($errors->has('image'))<span class="text-danger">{{ $errors->first('image') }}</span>@endif
            </div>
            <br>

            <div class="form-group">
                <label for="">Coming Soon</label>
                <input type="checkbox" name="comingSoon" value="1" {{ !empty($film) && $film->comingSoon ? 'checked' : '' }} />
            </div>

            <div class="form-group">
                <label for="">Best</label>
                <input type="checkbox" name="best" value="1" {{ !empty($film) && $film->best ? 'checked' : '' }}/>
            </div>
            <br>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Store</button>
            </div>
        </form>
    </div>
@endsection
