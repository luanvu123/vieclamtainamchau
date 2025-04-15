@extends('layouts.manage')

@section('content')

    <style>
        .avatar-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .avatar-modal-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>


        <div class="main-content">

            @if($validOrderDetails->count())
                <h3>Các gói "Tìm ứng viên" còn hiệu lực:</h3>
                <ul>
                    @foreach($validOrderDetails as $detail)
                        <li>
                            Gói: {{ $detail->service->name }} |
                            Số lượng còn lại: {{ $detail->number_of_active }} |
                            Hết hạn: {{ \Carbon\Carbon::parse($detail->expiring_date)->format('d/m/Y') }}
                        </li>
                    @endforeach
                </ul>
                @if ($candidates->isEmpty())
                    <p>Không có ứng viên nào công khai hồ sơ.</p>
                @else
                    <table class="table table-responsive" id="user-table">
                        <thead>
                            <tr>
                                <th scope="row">#</th>
                                <th>Avatar</th>
                                <th>Họ tên</th>
                                <th>Số ĐT</th>
                                <th>Vị trí</th>
                                <th>Kinh nghiệm</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($candidates as $key => $candidate)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>
                                        <img src="{{ $candidate->avatar_candidate ? asset('storage/avatars/' . $candidate->avatar_candidate) : asset('storage/avatar/avatar-default.jpg') }}"
                                            alt="Avatar" class="avatar-img">
                                    </td>
                                    <td>{{ $candidate->name }}</td>
                                    <td>{{ $candidate->phone }}</td>
                                    <td>{{ $candidate->desired_level }}</td>
                                    <td>{{ $candidate->years_of_experience }} năm</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#candidateModal{{ $candidate->id }}">
                                            📄
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="candidateModal{{ $candidate->id }}" tabindex="-1"
                                    aria-labelledby="candidateModalLabel{{ $candidate->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="candidateModalLabel{{ $candidate->id }}">Chi tiết
                                                    ứng viên</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <img src="{{ $candidate->avatar_candidate ? asset('storage/avatars/' . $candidate->avatar_candidate) : asset('storage/avatar/avatar-default.jpg') }}"
                                                        alt="Avatar" class="avatar-modal-img mb-3">
                                                </div>
                                                <p><strong>Họ tên:</strong> {{ $candidate->name }}</p>
                                                <p><strong>Email:</strong> {{ $candidate->email }}</p>
                                                <p><strong>Số điện thoại:</strong> {{ $candidate->phone }}</p>
                                                <p><strong>Ngày sinh:</strong>
                                                    {{ \Carbon\Carbon::parse($candidate->dob)->format('d/m/Y') }}</p>
                                                <p><strong>Địa chỉ:</strong> {{ $candidate->address }}</p>
                                                <p><strong>Kỹ năng:</strong> {{ $candidate->skill }}</p>
                                                <p><strong>Trình độ học vấn:</strong> {{ $candidate->education_level }}</p>
                                                <p><strong>Cấp bậc:</strong> {{ $candidate->level }}</p>
                                                <p><strong>Hình thức làm việc:</strong> {{ $candidate->working_form }}</p>
                                                <p><strong>LinkedIn:</strong>
                                                    @if ($candidate->linkedin)
                                                        <a href="{{ $candidate->linkedin }}" target="_blank">{{ $candidate->linkedin }}</a>
                                                    @else
                                                        Không có
                                                    @endif
                                                </p>
                                                <div class="form-group">
                                                    <label for="cv_path"><i class="fas fa-file-upload"></i> CV</label>
                                                    @if ($candidate->cv_path)
                                                        <div class="mb-3">
                                                            <!-- Hiển thị CV trực tiếp nếu có file -->
                                                            <iframe src="{{ asset('storage/cvs/' . $candidate->cv_path) }}" width="100%"
                                                                height="500px" frameborder="0">
                                                                <!-- Nếu trình duyệt không hỗ trợ iframe, có thể cung cấp một liên kết tải xuống -->
                                                                <a href="{{ asset('storage/cvs/' . $candidate->cv_path) }}" target="_blank"
                                                                    class="btn btn-primary">
                                                                    Tải xuống CV
                                                                </a>
                                                            </iframe>
                                                        </div>
                                                    @endif
                                                </div>

                                                <p><strong>Thư giới thiệu:</strong>
                                                    @if ($candidate->letter_path)
                                                        <a href="{{ asset('storage/' . $candidate->letter_path) }}" target="_blank">Tải
                                                            xuống</a>
                                                    @else
                                                        Không có
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            @else
                <p>Không có gói "Tìm ứng viên" nào còn hiệu lực.</p>
            @endif
        </div>

@endsection
