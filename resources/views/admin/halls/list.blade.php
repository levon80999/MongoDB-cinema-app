@extends('admin.layout.app')

@section('content')
    <div class="col py-3">
        <div class="d-flex justify-content-between">
            <h3>Halls</h3>
            <a class="btn btn-primary" href="{{ route('halls.create') }}">Create</a>
        </div>
        <hr>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Size</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($halls as $hall)
                    <tr>
                        <td>{{ $hall->name }}</td>
                        <td>{{ $hall->col }} x {{ $hall->row }}</td>
                        <td>
                            <a class="btn btn-sm" href="{{ route('halls.edit', ['id' => (string)$hall->id]) }}">
                                <i class="fa fa-pen"></i>
                            </a>

                            <a class="btn btn-sm" href="{{ route('halls.destroy', ['id' => (string)$hall->id]) }}">
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
