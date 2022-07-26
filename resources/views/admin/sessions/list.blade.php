@extends('admin.layout.app')

@section('content')
    <div class="col py-3">
        <div class="d-flex justify-content-between">
            <h3>Sessions</h3>
            <a class="btn btn-primary" href="{{ route('sessions.create') }}">Create</a>
        </div>
        <hr>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Film</th>
                    <th scope="col">Hall</th>
                    <th scope="col">Time</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sessions as $session)
                    <tr>
                        <td>{{ $session->film->name }}</td>
                        <td>{{ $session->hall->name }}</td>
                        <td>{{ $session->start_date }} - {{ $session->end_date }}</td>
                        <td>
                            <a class="btn btn-sm" href="{{ route('sessions.edit', ['id' => (string)$session->id]) }}">
                                <i class="fa fa-pen"></i>
                            </a>

                            <a class="btn btn-sm" href="{{ route('sessions.destroy', ['id' => (string)$session->id]) }}">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="3">No Data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
