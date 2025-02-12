@extends('layout')

@section('content')
    <div class="language-training-index">
        <h1>Đơn vị đào tạo ngôn ngữ</h1>

        @if ($languageTrainings->count() > 0)
            <div class="training-grid">
                @foreach ($languageTrainings as $training)
                    <div class="training-card">
                        <h2>{{ $training->name }}</h2>
                        <p>{!! Str::limit($training->description, 150) !!}</p>
                        <a href="{{ route('site.language-training.detail', $training->slug) }}" class="read-more">Xem chi
                            tiết</a>
                    </div>
                @endforeach
            </div>

            <div class="pagination">
                {{ $languageTrainings->links() }}
            </div>
        @else
            <p>Không có đơn vị đào tạo nào.</p>
        @endif
    </div>

    <style>
        .language-training-index {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .training-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .training-card {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .training-card:hover {
            transform: translateY(-5px);
        }

        .training-card h2 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .read-more {
            display: inline-block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }

        .pagination {
            margin-top: 30px;
            display: flex;
            justify-content: center;
        }
    </style>
@endsection
