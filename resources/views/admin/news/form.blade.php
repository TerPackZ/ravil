<div class="stack-form">
    <input type="text" name="title" placeholder="Заголовок" value="{{ old('title', $news->title) }}" required>
    <input type="text" name="excerpt" placeholder="Краткое описание" value="{{ old('excerpt', $news->excerpt) }}" required>
    @if($news->image)
        <img class="preview-image" src="{{ $news->image }}" alt="Текущее изображение">
    @endif
    <label>Загрузить изображение</label>
    <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/webp">
    <input type="url" name="image_url" placeholder="Или URL изображения" value="{{ old('image_url', str_contains((string) $news->image, '/storage/') ? '' : $news->image) }}">
    <input type="datetime-local" name="published_at" value="{{ old('published_at', optional($news->published_at)->format('Y-m-d\TH:i')) }}" required>
    <textarea name="content" rows="8" placeholder="Текст новости" required>{{ old('content', $news->content) }}</textarea>
</div>
