<form action="{{ $action }}" method="POST">
    @csrf
    @method($method)

    <div class="form-group">
        <label for="posts[slug]">URL名（スラッグ）</label>
        <input type="text" name="posts[slug]" class="form-control @error('posts.slug') is-invalid @enderror"
            value="{{ old('posts.slug', (isset($post) ? $post->slug : '')) }}">
        @error('posts.slug')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="posts[title]">タイトル</label>
        <input type="text" name="posts[title]" class="form-control @error('posts.title') is-invalid @enderror"
            value="{{ old('posts.title', (isset($post) ? $post->title : '')) }}" required>
        @error('posts.title')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="posts[content]">本文</label>
        <textarea rows="20" name="posts[content]" class="form-control @error('posts.content') is-invalid @enderror"
            required>{{ old('posts.content', (isset($post) ? $post->content : '')) }}</textarea>
        @error('posts.content')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="posts[parent]">親記事</label>
        <select name="posts[parent]" class="custom-select @error('posts.parent') is-invalid @enderror">
            <option value="0">親なし</option>
            @if (isset($posts))
            @foreach($posts as $p)
            <option value="{{ $p->id }}" @if ((int)old('posts.parent', isset($post) ? $post->parent :
                '')===$p->id) selected @endif>
                {{ $p->id }}
            </option>
            @endforeach
            @endif
        </select>
        @error('posts.parent')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="category_posts[category_id]">カテゴリ</label>
        <select name="category_posts[category_id]"
            class="custom-select @error('category_posts.category_id') is-invalid @enderror">
            @if (isset($categories))
            @foreach($categories as $category)
            <option value="{{ $category->id }}" @if ((int)old('category_posts.category_id', isset($post->category_post)
                ? $post->category_post->id : '')===$category->id) selected @endif>
                {{ $category->name }}
            </option>
            @endforeach
            @endif
        </select>
        @error('category_posts.category_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="w-full button button-primary">登録する</button>
</form>
