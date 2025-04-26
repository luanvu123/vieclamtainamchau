@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Languages</h1>
        <a href="{{ route('languages.create') }}" class="btn btn-primary">Add New Language</a>

        <table class="table mt-3" id="user-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($languages as $language)
                    <tr>
                        <td>{{$language->id}}</td>
                        <td>{{ $language->name }}</td>
                        <td>
                            <a href="{{ route('languages.edit', $language->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('languages.destroy', $language->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

