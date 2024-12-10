@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2><i class="fas fa-user-shield"></i> Chỉnh sửa phân quyền</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}">
                <i class="fas fa-arrow-left"></i> Quay về
            </a>
        </div>
    </div>
</div>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong><i class="fas fa-exclamation-triangle"></i> Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('roles.update', $role->id) }}" method="POST">
    @csrf
    @method('PATCH')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><i class="fas fa-tag"></i> Name:</strong>
                <input type="text" name="name" value="{{ $role->name }}"
                    class="form-control" placeholder="Name">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><i class="fas fa-lock"></i> Quyền:</strong>
                <br/>
                @foreach($permission as $value)
                    <div class="form-check">
                        <input type="checkbox"
                            name="permission[]"
                            value="{{ $value->id }}"
                            class="form-check-input name"
                            @if(in_array($value->id, $rolePermissions)) checked @endif>
                        <label class="form-check-label">
                            <strong>{{ $value->name }}</strong>
                            @if(!empty($value->description))
                                <small> - {{ $value->description }}</small>
                            @endif
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Lưu
            </button>
        </div>
    </div>
</form>
@endsection
