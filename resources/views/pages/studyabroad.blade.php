@extends('layout')

@section('content')

<style>
    /* Style cho bộ lọc */
    .filter-form {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 20px;
    }
.study-programs {
    text-align: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* Căn giữa danh sách */
.study-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
    justify-content: center;
    margin-top: 20px;
}

/* Đồng bộ kích thước của thẻ study-card */
.study-card {
    position: relative;
    background: #fff;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 350px; /* Đảm bảo chiều cao đồng nhất */
}

/* Hover */
.study-card:hover {
    transform: translateY(-5px);
}

/* Ảnh tự động co dãn */
.study-card img {
    width: 100%;
    height: 180px; /* Đảm bảo kích thước ảnh đồng nhất */
    object-fit: cover;
    border-radius: 8px;
}

/* Định dạng số thứ tự */
.study-number {
    position: absolute;
    top: 10px;
    left: 10px;
    background: #ff5722;
    color: white;
    font-size: 14px;
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 50%;
}

/* Nội dung của card */
.card-content {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    text-align: left;
    padding: 10px 0;
}

.card-content h3 {
    font-size: 18px;
    margin: 10px 0;
}

.card-content p {
    font-size: 14px;
    color: #666;
}

/* Căn giữa phân trang */
.pagination-container {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

/* Không có chương trình nào */
.no-programs {
    font-size: 18px;
    color: #666;
    margin-top: 20px;
}

    .filter-form select {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .filter-form button {
        padding: 8px 15px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .filter-form button:hover {
        background-color: #0056b3;
    }
</style>

<section class="study-programs">
    <h1>Du học nghề</h1>

    {{-- Bộ lọc --}}
   <form method="GET" action="{{ route('site.study-abroad') }}">
    <div style="display: flex; gap: 10px; justify-content: center; margin-bottom: 20px;">
        <!-- Lọc theo danh mục -->
        <select name="category_id" onchange="this.form.submit()">
            <option value="">Chọn ngành nghề</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <!-- Lọc theo quốc gia -->
        <select name="country_id" onchange="this.form.submit()">
            <option value="">Chọn quốc gia</option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}" {{ request('country_id') == $country->id ? 'selected' : '' }}>
                    {{ $country->name }}
                </option>
            @endforeach
        </select>

        <button type="submit">Lọc</button>
    </div>
</form>


    {{-- Danh sách chương trình --}}
    @if ($studyAbroads->count() > 0)
        <div class="study-grid">
            @foreach ($studyAbroads as $index => $study)
                <a href="{{ route('study-abroad.show', $study->slug) }}" class="study-card-link">
                    <div class="study-card">
                        <span class="study-number">{{ $studyAbroads->firstItem() + $index }}</span>
                        <img src="{{ asset('storage/' . $study->image) }}" alt="{{ $study->name }}"
                            onerror="this.src='{{ asset('frontend/img/default-image.png') }}'">
                        <div class="card-content">
                            <h3>{{ Str::limit($study->name, 40) }}</h3>
                            <p>{{ $study->short_detail }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Căn giữa phân trang --}}
        <div class="pagination-container">
            {{ $studyAbroads->appends(request()->query())->links() }}
        </div>
    @else
        <p class="no-programs">Hiện tại không có chương trình du học nào.</p>
    @endif
</section>

@endsection

