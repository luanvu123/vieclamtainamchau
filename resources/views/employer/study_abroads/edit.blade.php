@extends('layouts.manage')
@section('content')


    <div class="main-content">


        <h2>Chỉnh sửa chương trình du học</h2>

        <form action="{{ route('employer.study-abroads.update', $studyAbroad->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Tên chương trình</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $studyAbroad->name }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description">{{ $studyAbroad->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="short_detail" class="form-label">Mô tả ngắn</label>
                <input type="text" class="form-control" id="short_detail" name="short_detail"
                    value="{{ $studyAbroad->short_detail }}" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh</label>
                <input type="file" class="form-control" id="image" name="image">
                @if ($studyAbroad->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $studyAbroad->image) }}" alt="Hình ảnh" width="150">
                    </div>
                @endif
            </div>


            <div class="mb-3">
                <label for="categories" class="form-label">Ngành nghề</label>
                <select id="categories" name="categories[]" class="form-control" multiple>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ in_array($category->id, $selectedCategories) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('categories')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="countries" class="form-label">Quốc gia</label>
                <select id="countries" name="countries[]" class="form-control" multiple>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}" {{ in_array($country->id, $selectedCountries) ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
                @error('countries')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>

@endsection
