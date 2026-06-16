<div class="field">
        <label class="field-label" for="brand">Марка</label>
        <input id="brand" type="text" name="brand" value="{{ old('brand', $car->brand) }}" required>
    </div>
    <div class="field">
        <label class="field-label" for="model">Модель</label>
        <input id="model" type="text" name="model" value="{{ old('model', $car->model) }}" required>
    </div>
    <div class="field">
        <label class="field-label" for="year">Год</label>
        <input id="year" type="number" name="year" value="{{ old('year', $car->year) }}" required>
    </div>
    <div class="field">
        <label class="field-label" for="price">Цена, ₽</label>
        <input id="price" type="number" step="0.01" name="price" value="{{ old('price', $car->price) }}" required>
    </div>
    <div class="field">
        <label class="field-label" for="mileage">Пробег, км</label>
        <input id="mileage" type="number" name="mileage" value="{{ old('mileage', $car->mileage) }}">
    </div>
    <div class="field">
        <label class="field-label" for="engine">Двигатель</label>
        <input id="engine" type="text" name="engine" value="{{ old('engine', $car->engine) }}">
    </div>
    <div class="field">
        <label class="field-label" for="transmission">КПП</label>
        <input id="transmission" type="text" name="transmission" value="{{ old('transmission', $car->transmission) }}">
    </div>
    <div class="field">
        <label class="field-label" for="color">Цвет</label>
        <input id="color" type="text" name="color" value="{{ old('color', $car->color) }}">
    </div>
    @if($car->image)
        <img class="preview-image" src="{{ $car->image }}" alt="Текущее изображение">
    @endif
    <div class="field">
        <label class="field-label" for="image">Загрузить изображение</label>
        <input id="image" type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/webp">
    </div>
    <div class="field">
        <label class="field-label" for="image_url">Или URL изображения</label>
        <input id="image_url" type="url" name="image_url" value="{{ old('image_url', str_contains((string) $car->image, '/storage/') ? '' : $car->image) }}">
    </div>
    <div class="field">
        <label class="field-label" for="description">Описание</label>
        <textarea id="description" name="description" rows="6" required>{{ old('description', $car->description) }}</textarea>
    </div>
    <label class="checkbox">
        <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $car->is_featured))>
        <span>Показывать на главной</span>
    </label>
