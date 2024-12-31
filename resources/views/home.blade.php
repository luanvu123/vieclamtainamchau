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
                        <p>{{ $onlineVisitors }}</p>

                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                        <div class="chart-container" style="width: 80%; margin: auto;">
                            <canvas id="employerChart"></canvas>
                        </div>

                        <script>
                            const labels = {!! json_encode($employerChartData->keys()) !!};
                            const employerData = {!! json_encode($employerChartData->values()) !!};
                            const candidateData = {!! json_encode($candidateChartData->values()) !!};

                            const ctx = document.getElementById('employerChart').getContext('2d');
                            new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: labels,
                                    datasets: [
                                        {
                                            label: 'Số lượng nhà tuyển dụng',
                                            data: employerData,
                                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                            borderColor: 'rgba(75, 192, 192, 1)',
                                            borderWidth: 1
                                        },
                                        {
                                            label: 'Số lượng ứng viên',
                                            data: candidateData,
                                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                            borderColor: 'rgba(153, 102, 255, 1)',
                                            borderWidth: 1
                                        }
                                    ]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    },
                                    responsive: true,
                                    maintainAspectRatio: false,
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

