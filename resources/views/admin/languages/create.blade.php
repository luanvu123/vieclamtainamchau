@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Language</h1>
        <form action="{{ route('languages.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Language Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Save</button>
        </form>
    </div>
@endsection
