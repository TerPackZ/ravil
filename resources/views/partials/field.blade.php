@php
    $id = $id ?? $name;
    $type = $type ?? 'text';
@endphp

<div class="field @error($name) field-has-error @enderror">
    @if(!empty($label))
        <label class="field-label" for="{{ $id }}">{{ $label }}</label>
    @endif

    @if(($type ?? 'text') === 'textarea')
        <textarea id="{{ $id }}" name="{{ $name }}" rows="{{ $rows ?? 4 }}" @if(!empty($required)) required @endif @if(!empty($placeholder)) placeholder="{{ $placeholder }}" @endif>{{ $value ?? old($name) }}</textarea>
    @elseif(($type ?? 'text') === 'select')
        <select id="{{ $id }}" name="{{ $name }}" @if(!empty($required)) required @endif>
            {{ $slot }}
        </select>
    @else
        <input
            id="{{ $id }}"
            type="{{ $type }}"
            name="{{ $name }}"
            value="{{ $value ?? old($name) }}"
            @if(!empty($required)) required @endif
            @if(!empty($placeholder)) placeholder="{{ $placeholder }}" @endif
            @if(!empty($autocomplete)) autocomplete="{{ $autocomplete }}" @endif
            @if(!empty($min)) min="{{ $min }}" @endif
        >
    @endif

    @error($name)
        <span class="field-error-text">{{ $message }}</span>
    @enderror
</div>
