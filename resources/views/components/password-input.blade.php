<div class="col-md-{{ $col ?? '12' }} mb-{{ $mb ?? '0' }}">
    <label for="{{ $field }}" class="text-md-end">{{ $label }}</label>

    <input id="{{ $field }}" type="password" class="form-control @error($field) is-invalid @enderror"
        name="{{ $field }}" value="{{ $default ?? old($field) }}" required="{{ $required ?? true }}"
        @if ($readonly) readonly @endif autocomplete autofocus>

    @error($field)
        <x-single-error :message="$message" />
    @enderror
</div>
