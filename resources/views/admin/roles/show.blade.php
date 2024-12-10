@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Xem phân quyền</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Quay lại</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Tên:</strong>
            {{ $role->name }}
        </div>
    </div>
  <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <strong>Quyền:</strong>
        @if(!empty($rolePermissions))
            @foreach($rolePermissions as $v)
                <div>
                    <span class="badge bg-grd-danger">{{ $v->name }}</span>
                    @if(!empty($v->description))
                        <small class="text-muted"> - {{ $v->description }}</small>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
</div>

</div>
@endsection
