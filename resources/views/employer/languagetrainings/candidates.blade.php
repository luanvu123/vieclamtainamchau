@extends('layouts.manage')

@section('content')
    <div class="main-content">
        <h2>Danh sách ứng viên đăng ký: {{ $training->name }}</h2>
        <a href="{{ route('employer.languagetrainings.index') }}" class="btn btn-secondary mb-3">Quay lại</a>

        <table class="table table-bordered" id="user-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>SDT</th>
                    <th>Ghi chú</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($training->candidateRegistrations as $key=> $registration)
                    <tr>
                        <td>{{$key }}</td>
                        <td>{{ $registration->name ?? $registration->candidate->name ?? '---' }}</td>
                        <td>{{ $registration->email ?? '---' }}</td>
                        <td>{{ $registration->phone ?? '---' }}</td>
                      <td>
    @if($registration->note)
        {{ Str::limit($registration->note, 10) }}
        <i class="fas fa-exclamation-circle text-warning"
           data-toggle="tooltip"
           data-placement="top"
           title="{{ $registration->note }}"></i>
    @else
        ---
    @endif
</td>

                         <td>
                    <form action="{{ route('employer.languagetrainings.candidate.destroy', $registration->id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xóa đăng ký này?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Xóa</button>
                    </form>
                </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Chưa có ứng viên đăng ký</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

@endsection
