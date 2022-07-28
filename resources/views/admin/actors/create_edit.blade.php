@extends('admin.layout.app')

@section('content')
    <div class="col py-3">
        <div class="d-flex justify-content-between">
            <h3>{{ empty($actor) ? 'Create Actor' : 'Edit Actor' }}</h3>
            <a class="btn btn-light" href="{{ route('actors.list') }}">Back to list</a>
        </div>
        <hr>

        @php ($action = empty($actor) ? route('actors.store') : route('actors.update', ['id' => (string)$actor->id]))

        <form action="{{ $action }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="fullNameInput">Full Name</label>
                <input
                    type="text"
                    name="fullName"
                    class="form-control"
                    id="fullNameInput"
                    placeholder="Name"
                    value="{{ old('fullName') ? old('fullName') : $actor->fullName ?? '' }}">
                @if ($errors->has('fullName'))<span class="text-danger">{{ $errors->first('fullName') }}</span>@endif
            </div>
            <div class="form-group">
                <label for="descriptionInput">Description</label>
                <input
                    type="text"
                    name="description"
                    class="form-control"
                    id="descriptionInput"
                    placeholder="Short description"
                    value="{{ old('description') ? old('description') : $actor->description ?? '' }}">
                @if ($errors->has('description'))<span class="text-danger">{{ $errors->first('description') }}</span>@endif
            </div>
            <div class="form-group">
                <label for="heightInput">Height</label>
                <input
                    type="number"
                    name="height"
                    class="form-control"
                    id="heightInput"
                    placeholder="height"
                    value="{{ old('height') ? old('height') : $actor->height ?? '' }}">
                @if ($errors->has('height'))<span class="text-danger">{{ $errors->first('height') }}</span>@endif
            </div>
            <div class="form-group">
                <label for="childrenInput">Children</label>
                <input
                    type="text"
                    name="children"
                    class="form-control"
                    id="childrenInput"
                    placeholder="Use a comma for input multiple names"
                    value="{{ old('children') ? old('children') : implode(',', $actor->children ?? []) ?? '' }}">
                @if ($errors->has('children'))<span class="text-danger">{{ $errors->first('children') }}</span>@endif
            </div>
            <div class="form-group">
                <label for="dateOfBirthInput">Date of birth</label>
                <input
                    type="date"
                    name="dateOfBirth"
                    class="form-control"
                    id="dateOfBirthInput"
                    placeholder="Date"
                    value="{{ old('dateOfBirth') ? old('dateOfBirth') : $actor->dateOfBirth ?? '' }}">
                @if ($errors->has('dateOfBirth'))<span class="text-danger">{{ $errors->first('dateOfBirth') }}</span>@endif
            </div>
            <div class="form-group">
                @if (!empty($actor))
                    <br>
                    <img src="{{ asset('/public/actors/images/'.$actor->image) }}" width="auto" height="150" alt="{{ $actor->image }}" />
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
                <button class="btn btn-primary" type="submit">Store</button>
            </div>
        </form>
    </div>
@endsection
