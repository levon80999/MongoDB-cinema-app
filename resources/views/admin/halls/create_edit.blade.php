@extends('admin.layout.app')

@section('content')
    <div class="col py-3">
        <div class="d-flex justify-content-between">
            <h3>{{ empty($hall) ? 'Create Hall' : 'Edit Hall' }}</h3>
            <a class="btn btn-light" href="{{ route('halls.list') }}">Back to list</a>
        </div>
        <hr>

        @php ($action = empty($hall) ? route('halls.store') : route('halls.update', ['id' => (string)$hall->id]))

        <form action="{{ $action }}" method="post">
            @csrf

            <div class="form-group">
                <label for="nameInput">Name</label>
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    id="nameInput"
                    placeholder="Name"
                    value="{{ old('name') ? old('name') : $hall->name ?? '' }}">
                @if ($errors->has('name'))<span class="text-danger">{{ $errors->first('name') }}</span>@endif
            </div>

            <div class="row mt-2">
                <div class="col">
                    <label for="colInput">Columns</label>
                    <input
                        type="number"
                        name="col"
                        class="form-control"
                        id="colInput"
                        placeholder="Columns"
                        value="{{ old('col') ? old('col') : $hall->col ?? '' }}">
                    @if ($errors->has('col'))<span class="text-danger">{{ $errors->first('col') }}</span>@endif
                </div>
                <div class="col">
                    <label for="rowInput">Rows</label>
                    <input
                        type="number"
                        name="row"
                        class="form-control"
                        id="rowInput"
                        placeholder="Rows"
                        value="{{ old('row') ? old('row') : $hall->row ?? '' }}">
                    @if ($errors->has('row'))<span class="text-danger">{{ $errors->first('row') }}</span>@endif
                </div>
                <div class="col">
                    <label for=""></label>
                    <button class="btn btn-primary form-control" id="generateMatrix">Generate Matrix</button>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <table class="table table-bordered mt-3 text-center">
                        <tbody id="seatContainer">
                            @if (!empty($hall))
                                @php($disabledSeats = $hall->disabledSeats)
                                @for($i = 1; $i <= $hall->row; $i++)
                                    <tr>
                                        @for($j = 1; $j <= $hall->col; $j++)
                                            <td>
                                                <input type="checkbox" value="1" name="seats[{{ $i }}][{{ $j }}]" {{ isset($disabledSeats[$i]) && in_array($j, $disabledSeats[$i]) ? '' : 'checked' }}>
                                            </td>
                                        @endfor
                                    </tr>
                                @endfor
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="form-group mt-3">
                <button class="btn btn-primary" type="submit">Store</button>
            </div>

        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $('#generateMatrix').on('click', function (e) {
            e.preventDefault()

            const seatContainer = $('#seatContainer');
            seatContainer.html('')
            const col = $('#colInput').val();
            const row = $('#rowInput').val();

            for (let i = 1; i <= row; i++) {
                let html = '';

                html += '<tr>';
                    for (let j = 1; j <= col; j++) {
                        html += '<td>';
                        html += '<input type="checkbox" value="1" name="seats['+i+']['+j+']" checked/>';
                        html += '</td>';
                    }
                html += '</tr>';

                seatContainer.append(html)
            }
        });
    </script>
@endsection
