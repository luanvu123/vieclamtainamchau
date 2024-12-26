@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h2>Thống kê truy cập</h2>
                        <p>Trang chủ: {{ $totalVisitors }}</p>

                        <h2>Đang online</h2>
                        <p> {{ $onlineVisitors }}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
