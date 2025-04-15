<div class="form-group">
    <label for="name">Tên</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $typeLanguagetraining->name ?? '') }}" required>
</div>

<div class="form-group">
    <label for="status">Trạng thái</label>
    <select name="status" class="form-control">
        <option value="1" {{ (old('status', $typeLanguagetraining->status ?? '') == 1) ? 'selected' : '' }}>Hiển thị</option>
        <option value="0" {{ (old('status', $typeLanguagetraining->status ?? '') == 0) ? 'selected' : '' }}>Ẩn</option>
    </select>
</div>
