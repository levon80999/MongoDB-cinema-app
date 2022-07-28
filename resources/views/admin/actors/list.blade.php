@extends('admin.layout.app')

@section('content')
    <div class="col py-3">
        <div class="d-flex justify-content-between">
            <h3>Actors</h3>
            <a class="btn btn-primary" href="{{ route('actors.create') }}">Create</a>
        </div>
        <hr>

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Full Name</th>
                <th scope="col">Date Of Birth</th>
                <th scope="col">Height</th>
                <th scope="col">Children</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($actors as $actor)
                <tr>
                    <td>{{ $actor->fullName }}</td>
                    <td>{{ $actor->dateOfBirth }}</td>
                    <td>{{ $actor->height }}</td>
                    <td>{!! $actor->children ? implode('<br>', $actor->children) : '' !!}</td>
                    <td>
                        <img src="{{ asset('/public/actors/images/'.$actor->image) }}" width="auto" height="150" alt="{{ $actor->image }}" />
                    </td>
                    <td>
                        <a class="btn btn-sm" href="{{ route('actors.edit', ['id' => (string)$actor->id]) }}">
                            <i class="fa fa-pen"></i>
                        </a>

                        <a class="btn btn-sm" href="{{ route('actors.destroy', ['id' => (string)$actor->id]) }}">
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
