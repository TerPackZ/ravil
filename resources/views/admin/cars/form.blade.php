<div class="stack-form">
    <input type="text" name="brand" placeholder="Марка" value="{{ old('brand', $car->brand) }}" required>
    <input type="text" name="model" placeholder="Модель" value="{{ old('model', $car->model) }}" required>
    <input type="number" name="year" placeholder="Год" value="{{ old('year', $car->year) }}" required>
    <input type="number" step="0.01" name="price" placeholder="Цена" value="{{ old('price', $car->price) }}" required>
    <input type="number" name="mileage" placeholder="Пробег" value="{{ old('mileage', $car->mileage) }}">
    <input type="text" name="engine" placeholder="Двигатель" value="{{ old('engine', $car->engine) }}">
    <input type="text" name="transmission" placeholder="КПП" value="{{ old('transmission', $car->transmission) }}">
    <input type="text" name="color" placeholder="Цвет" value="{{ old('color', $car->color) }}">
    @if($car->image)
        <img class="preview-image" src="{{ $car->image }}" alt="Текущее изображение">
    @endif
    <label>Загрузить изображение</label>
    <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/webp">
    <input type="url" name="image_url" placeholder="Или URL изображения" value="{{ old('image_url', str_contains((string) $car->image, '/storage/') ? '' : $car->image) }}">
    <textarea name="description" rows="6" placeholder="Описание" required>{{ old('description', $car->description) }}</textarea>
    <label class="checkbox">
        <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $car->is_featured))>
        <span>Показывать на главной</span>
    </label>
</div>
