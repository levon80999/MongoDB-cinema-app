@extends('admin.layout.app')

@section('content')
    <div class="col py-3">
        <div class="d-flex justify-content-between">
            <h3>{{ empty($session) ? 'Create Session' : 'Edit Session' }}</h3>
            <a class="btn btn-light" href="{{ route('sessions.list') }}">Back to list</a>
        </div>
        <hr>

        @php ($action = empty($session) ? route('sessions.store') : route('sessions.update', ['id' => (string)$session->id]))

        <form action="{{ $action }}" method="post">
            @csrf

            <div class="form-group">
                <label for="dateInput">Film</label>
                <select class="form-select" name="film_id" aria-label="Default select example">
                    <option value="">Select Film</option>
                    @foreach($films as $film)
                        <option value="{{$film->id}}" {{ !empty($session) && $film->id === $session->film_id ? 'selected' : '' }}>{{ $film->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('film_id'))<span class="text-danger">{{ $errors->first('film_id') }}</span>@endif
            </div>

            <div class="form-group">
                <label for="dateInput">Hall</label>
                <select class="form-select" name="hall_id" aria-label="Default select example">
                    <option value="">Select Hall</option>
                    @foreach($halls as $hall)
                        <option value="{{$hall->id}}" {{ !empty($session) && $hall->id === $session->hall_id ? 'selected' : '' }}>{{ $hall->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('hall_id'))<span class="text-danger">{{ $errors->first('hall_id') }}</span>@endif
            </div>

            <div class="row">
                <div class="col">
                    <label for="startDateInput">Start Session</label>
                    <input
                        type="datetime-local"
                        name="start_date"
                        class="form-control"
                        id="startDateInput"
                        placeholder="Start Date"
                        value="{{ old('start_date') ? old('start_date') : $session->start_date ?? '' }}">
                    @if ($errors->has('start_date'))<span class="text-danger">{{ $errors->first('start_date') }}</span>@endif
                </div>

                <div class="col">
                    <label for="endDateInput">End Session</label>
                    <input
                        type="datetime-local"
                        name="end_date"
                        class="form-control"
                        id="endDateInput"
                        placeholder="End Date"
                        value="{{ old('end_date') ? old('end_date') : $session->end_date ?? '' }}">
                    @if ($errors->has('end_date'))<span class="text-danger">{{ $errors->first('end_date') }}</span>@endif
                </div>
            </div>

            <div class="form-group mt-3">
                <button class="btn btn-primary" type="submit">Store</button>
            </div>
        </form>
    </div>
@endsection
