<div class="field @error('title') field-has-error @enderror">
        <label class="field-label" for="title">Заголовок</label>
        <input id="title" type="text" name="title" value="{{ old('title', $news->title) }}" required>
        @error('title')<span class="field-error-text">{{ $message }}</span>@enderror
    </div>
    <div class="field @error('excerpt') field-has-error @enderror">
        <label class="field-label" for="excerpt">Краткое описание</label>
        <input id="excerpt" type="text" name="excerpt" value="{{ old('excerpt', $news->excerpt) }}" required>
        @error('excerpt')<span class="field-error-text">{{ $message }}</span>@enderror
    </div>
    @if($news->image)
        <img class="preview-image" src="{{ $news->image }}" alt="Текущее изображение">
    @endif
    <div class="field @error('image') field-has-error @enderror">
        <label class="field-label" for="news-image">Загрузить изображение</label>
        <input id="news-image" type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/webp">
        @error('image')<span class="field-error-text">{{ $message }}</span>@enderror
    </div>
    <div class="field @error('image_url') field-has-error @enderror">
        <label class="field-label" for="news-image-url">Или URL изображения</label>
        <input id="news-image-url" type="url" name="image_url" value="{{ old('image_url', str_contains((string) $news->image, '/storage/') ? '' : $news->image) }}">
        @error('image_url')<span class="field-error-text">{{ $message }}</span>@enderror
    </div>
    <div class="field @error('published_at') field-has-error @enderror">
        <label class="field-label" for="published_at">Дата публикации</label>
        <input id="published_at" type="datetime-local" name="published_at" value="{{ old('published_at', optional($news->published_at)->format('Y-m-d\TH:i')) }}" required>
        @error('published_at')<span class="field-error-text">{{ $message }}</span>@enderror
    </div>
    <div class="field @error('content') field-has-error @enderror">
        <label class="field-label" for="content">Текст новости</label>
        <textarea id="content" name="content" rows="8" required>{{ old('content', $news->content) }}</textarea>
        @error('content')<span class="field-error-text">{{ $message }}</span>@enderror
    </div>
