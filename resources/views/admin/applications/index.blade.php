@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Danh sách đơn ứng tuyển</h2>

        <table class="table table-bordered" id="user-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Ứng viên</th>
                    <th>CV</th>
                    <th>Giới thiệu</th>
                    <th>Phê duyệt</th>
                    <th>CV che thông tin</th>
                    <th>CV nộp lại</th>
                    <th>Ngày nộp</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $key => $application)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
    {{ $application->candidate->name ?? 'N/A' }}
    @if($application->approve_application === 'Chờ duyệt' && $application->created_at >= now()->subHours(24))
        <span class="badge badge-success">New</span>
    @endif
</td>

                        <td>
                            @if($application->cv_path)
                                <a href="{{ asset('storage/' . $application->cv_path) }}" target="_blank">Xem CV</a>
                            @endif
                        </td>
                        <td>
                            <div class="introduction-text" title="{{ $application->introduction }}">
                                {{ \Illuminate\Support\Str::limit($application->introduction, 100) }}
                            </div>
                        </td>
                        <td>{{ $application->approve_application }}</td>
                        <td>
                            @if($application->cv_path_hidden_info)
                                <a href="{{ asset('storage/' . $application->cv_path_hidden_info) }}" target="_blank"
                                    class="btn btn-sm btn-info">Xem</a>
                                <form action="{{ route('application-manage.delete-hidden-cv', $application->id) }}" method="POST"
                                    style="display:inline-block"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa CV che thông tin?');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                </form>
                            @else
                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                    data-target="#addHiddenCvModal{{ $application->id }}">
                                    Thêm CV che thông tin
                                </button>
                            @endif
                        </td>
                        <td>
                            @if($application->cv_path_resubmit)
                                <a href="{{ asset('storage/' . $application->cv_path_resubmit) }}" target="_blank">Xem lại CV</a>
                                <button type="button" class="btn btn-sm btn-success mt-1" data-toggle="modal"
                                    data-target="#updateCvPathModal{{ $application->id }}">
                                    Cập nhật vào cv_path
                                </button>
                            @endif
                        </td>
                        <td>{{ $application->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('application-manage.edit', $application->id) }}"
                                class="btn btn-sm btn-warning">Sửa</a>

                            <form action="{{ route('application-manage.destroy', $application->id) }}" method="POST"
                                style="display:inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn này?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal thêm CV che thông tin -->
                    <div class="modal fade" id="addHiddenCvModal{{ $application->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="addHiddenCvModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addHiddenCvModalLabel">Thêm CV che thông tin</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('application-manage.add-hidden-cv', $application->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="cv_hidden">Chọn CV che thông tin</label>
                                            <input type="file" class="form-control-file" id="cv_hidden" name="cv_hidden"
                                                required>
                                            <small class="form-text text-muted">Chọn file CV đã che thông tin cá nhân của ứng
                                                viên.</small>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal cập nhật CV path -->
                    @if($application->cv_path_resubmit)
                        <div class="modal fade" id="updateCvPathModal{{ $application->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="updateCvPathModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateCvPathModalLabel">Cập nhật CV Path</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Bạn có chắc chắn muốn cập nhật CV path bằng CV nộp lại không?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        <form action="{{ route('application-manage.update-cv-path', $application->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Xác nhận</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <style>
        .introduction-text {
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: help;
        }

        .introduction-text:hover {
            position: relative;
        }

        .introduction-text:hover::after {
            content: attr(title);
            position: absolute;
            left: 0;
            top: 100%;
            white-space: pre-wrap;
            background: #f8f9fa;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            z-index: 1000;
            max-width: 400px;
            max-height: 200px;
            overflow-y: auto;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection
