@extends('user.layout.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="box-title mt-5">Book Available Seats Now</h2>
                <div class="form-group">
                    <div class="row">
                        <form action="{{ route('book') }}" method="post">
                            @csrf
                            <table class="table table-bordered mt-3 text-center">
                                <tbody id="seatContainer">
                                    @php($hall = $session->hall)
                                    @php($disabledSeats = $hall->disabledSeats)
                                    @php($booked = $session->books)
                                    @for($i = 1; $i <= $hall->row; $i++)
                                        <tr>
                                            @for($j = 1; $j <= $hall->col; $j++)
                                                <td>
                                                    <input type="checkbox" value="1" name="seats[{{ $i }}][{{ $j }}]"
                                                        {{ isset($disabledSeats[$i]) && in_array($j, $disabledSeats[$i]) ? 'disabled' : '' }}
                                                        {{ isset($booked[$i]) && array_key_exists($j, $booked[$i]) ? 'disabled checked' : '' }}
                                                    >
                                                    {{ $i.'.'.$j }}
                                                </td>
                                            @endfor
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                            <input type="hidden" value="{{ $session->id }}" name="sessionId" />
                            <button type="submit" class="btn btn-success">Book now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
