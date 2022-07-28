@extends('user.layout.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h3 class="box-title mt-5">Available Sessions</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-product">
                            <thead>
                                <th>Film Name</th>
                                <th>Hall Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                @forelse ($sessions as $session)
                                    <tr>
                                        <td>{{ $session->film->name }}</td>
                                        <td>{{ $session->hall->name }}</td>
                                        <td>{{ $session->start_date }}</td>
                                        <td>{{ $session->end_date }}</td>
                                        <td>
                                            <a href="{{ route('book_session', ['sessionId' => $session->id]) }}" class="btn btn-sm btn-primary">Book Now</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">There is not active sessions.</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
