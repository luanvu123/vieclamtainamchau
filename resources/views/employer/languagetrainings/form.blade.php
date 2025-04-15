@php
    $editing = isset($languagetraining);
@endphp

<div class="mb-3">
    <label for="name" class="form-label">Tên khóa học</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $languagetraining->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="type_language_training_id" class="form-label">Loại đào tạo</label>
    <select name="type_language_training_id" class="form-control" required>
        <option value="">-- Chọn --</option>
        @foreach($types as $type)
            <option value="{{ $type->id }}" {{ (old('type_language_training_id', $languagetraining->type_language_training_id ?? '') == $type->id) ? 'selected' : '' }}>
                {{ $type->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Ngày bắt đầu</label>
    <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $languagetraining->start_date ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Ngày kết thúc</label>
    <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $languagetraining->end_date ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Mô tả</label>
    <textarea name="description" class="form-control">{{ old('description', $languagetraining->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Hình ảnh</label>
    <input type="file" name="image" class="form-control">
    @if($editing && $languagetraining->image)
        <img src="{{ asset('storage/' . $languagetraining->image) }}" alt="Ảnh" class="img-thumbnail mt-2" width="150">
    @endif
</div>

<div class="mb-3 form-check">
    <input type="checkbox" name="status" class="form-check-input" {{ old('status', $languagetraining->status ?? true) ? 'checked' : '' }}>
    <label class="form-check-label">Hiển thị</label>
</div>
