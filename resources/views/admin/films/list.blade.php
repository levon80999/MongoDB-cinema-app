@extends('admin.layout.app')

@section('content')
    <div class="col py-3">
        <div class="d-flex justify-content-between">
            <h3>Films</h3>
            <a class="btn btn-primary" href="{{ route('films.create') }}">Create</a>
        </div>
        <hr>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($films as $film)
                    <tr>
                        <td>{{ $film->name }}</td>
                        <td>{{ $film->created_at }}</td>
                        <td>
                            <img src="{{ asset('/public/images/'.$film->image) }}" width="auto" height="150" alt="{{ $film->image }}" />
                        </td>
                        <td>
                            <a class="btn btn-sm" href="{{ route('films.edit', ['id' => (string)$film->id]) }}">
                                <i class="fa fa-pen"></i>
                            </a>

                            <a class="btn btn-sm" href="{{ route('films.destroy', ['id' => (string)$film->id]) }}">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="5">No Data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
