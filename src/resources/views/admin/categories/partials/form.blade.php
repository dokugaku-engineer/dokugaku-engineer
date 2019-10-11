<form action="{{ $action }}" method="POST">
    @csrf
    @method($method)

    <div class="form-group">
        <label for="name">カテゴリー名</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', (isset($category) ? $category->name : '')) }}" required>
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="slug">URL名（スラッグ）</label>
        <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
            value="{{ old('slug', (isset($category) ? $category->slug : '')) }}" required>
        @error('slug')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="parent">親カテゴリ</label>
        <select name="parent" class="custom-select @error('parent') is-invalid @enderror">
            <option value="0">親なし</option>
            @foreach($categories as $c)

            <option value="{{ $c->id }}" @if (old('parent', isset($category) ? (string)$category->parent :
                '')===(string)$c->id) selected @endif>
                {{ $c->name }}
            </option>
            @endforeach
        </select>
        @error('parent')
        <div class="invalid-feedback">{{ $errors->first('parent') }}</div>
        @enderror
    </div>

    <button type="submit" class="w-full button button-primary">登録する</button>
</form>
