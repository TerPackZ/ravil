<div class="field @error('brand') field-has-error @enderror">
        <label class="field-label" for="brand">Марка</label>
        <input id="brand" type="text" name="brand" value="{{ old('brand', $car->brand) }}" required>
        @error('brand')<span class="field-error-text">{{ $message }}</span>@enderror
    </div>
    <div class="field @error('model') field-has-error @enderror">
        <label class="field-label" for="model">Модель</label>
        <input id="model" type="text" name="model" value="{{ old('model', $car->model) }}" required>
        @error('model')<span class="field-error-text">{{ $message }}</span>@enderror
    </div>
    <div class="field @error('year') field-has-error @enderror">
        <label class="field-label" for="year">Год</label>
        <input id="year" type="number" name="year" value="{{ old('year', $car->year) }}" required>
        @error('year')<span class="field-error-text">{{ $message }}</span>@enderror
    </div>
    <div class="field @error('price') field-has-error @enderror">
        <label class="field-label" for="price">Цена, ₽</label>
        <input id="price" type="number" step="0.01" name="price" value="{{ old('price', $car->price) }}" required>
        @error('price')<span class="field-error-text">{{ $message }}</span>@enderror
    </div>
    <div class="field @error('mileage') field-has-error @enderror">
        <label class="field-label" for="mileage">Пробег, км</label>
        <input id="mileage" type="number" name="mileage" value="{{ old('mileage', $car->mileage) }}">
        @error('mileage')<span class="field-error-text">{{ $message }}</span>@enderror
    </div>
    <div class="field @error('engine') field-has-error @enderror">
        <label class="field-label" for="engine">Двигатель</label>
        <input id="engine" type="text" name="engine" value="{{ old('engine', $car->engine) }}">
        @error('engine')<span class="field-error-text">{{ $message }}</span>@enderror
    </div>
    <div class="field @error('transmission') field-has-error @enderror">
        <label class="field-label" for="transmission">КПП</label>
        <input id="transmission" type="text" name="transmission" value="{{ old('transmission', $car->transmission) }}">
        @error('transmission')<span class="field-error-text">{{ $message }}</span>@enderror
    </div>
    <div class="field @error('color') field-has-error @enderror">
        <label class="field-label" for="color">Цвет</label>
        <input id="color" type="text" name="color" value="{{ old('color', $car->color) }}">
        @error('color')<span class="field-error-text">{{ $message }}</span>@enderror
    </div>
    @if($car->image)
        <img class="preview-image" src="{{ $car->image }}" alt="Текущее изображение">
    @endif
    <div class="field @error('image') field-has-error @enderror">
        <label class="field-label" for="image">Загрузить изображение</label>
        <input id="image" type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/webp">
        @error('image')<span class="field-error-text">{{ $message }}</span>@enderror
    </div>
    <div class="field @error('image_url') field-has-error @enderror">
        <label class="field-label" for="image_url">Или URL изображения</label>
        <input id="image_url" type="url" name="image_url" value="{{ old('image_url', str_contains((string) $car->image, '/storage/') ? '' : $car->image) }}">
        @error('image_url')<span class="field-error-text">{{ $message }}</span>@enderror
    </div>
    <div class="field @error('description') field-has-error @enderror">
        <label class="field-label" for="description">Описание</label>
        <textarea id="description" name="description" rows="6" required>{{ old('description', $car->description) }}</textarea>
        @error('description')<span class="field-error-text">{{ $message }}</span>@enderror
    </div>
    <label class="checkbox">
        <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $car->is_featured))>
        <span>Показывать на главной</span>
    </label>
