@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Language</h1>
        <form action="{{ route('languages.update', $language->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Language Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $language->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>
@endsection
