@extends('admin.layout.app')

@section('content')
    <div class="col py-3">
        <div class="d-flex justify-content-between">
            <h3>Producers</h3>
            <a class="btn btn-primary" href="{{ route('producers.create') }}">Create</a>
        </div>
        <hr>

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Full Name</th>
                <th scope="col">Date / Place Of Birth</th>
                <th scope="col">Height</th>
                <th scope="col">Children</th>
                <th scope="col">Parents</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($producers as $producer)
                <tr>
                    <td>{{ $producer->fullName }}</td>
                    <td>{{ $producer->dateOfBirth . ' / ' . $producer->placeOfBirth}}</td>
                    <td>{{ $producer->height }}</td>
                    <td>{!! implode('<br>', $producer->children) !!}</td>
                    <td>{!! implode('<br>', $producer->parents) !!}</td>
                    <td>
                        <img src="{{ asset('/public/producers/images/'.$producer->image) }}" width="auto" height="150" alt="{{ $producer->image }}" />
                    </td>
                    <td>
                        <a class="btn btn-sm" href="{{ route('producers.edit', ['id' => (string)$producer->id]) }}">
                            <i class="fa fa-pen"></i>
                        </a>

                        <a class="btn btn-sm" href="{{ route('producers.destroy', ['id' => (string)$producer->id]) }}">
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
