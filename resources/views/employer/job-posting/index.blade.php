@extends('layouts.manage')
@section('content')


        <div class="main-content">


            @if ($jobPostings->isNotEmpty())
                <table class="job-table" id="user-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên tin đăng</th>
                            <th>Thời hạn</th>
                            <th>Lượt xem</th>
                            <th>Lượt ứng tuyển</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobPostings as $key => $job)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{{ $job->title }}</td>
                                <td>{{ $job->closing_date }}</td>
                                <td>{{ $job->views }}</td>
                                <td>
                                    <a href="{{ route('employer.job-posting.applications', $job->id) }}"
                                        class="application-btn">
                                        CV ứng tuyển ({{ $job->applications->count() }})
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('employer.job-posting.edit', $job->id) }}" class="action-btn">Chỉnh
                                        sửa</a>
                                    <form action="{{ route('employer.job-posting.destroy', $job->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete-btn">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="text-align: center; font-size: 16px; color: gray;">Không có tin đăng nào.</p>
            @endif



        </div>
@endsection
