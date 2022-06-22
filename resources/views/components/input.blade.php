<div class="col-md-{{ $col ?? '12' }} mb-{{ $mb ?? '0' }}">
    <label for="{{ $field }}" class="text-md-end">{{ $label }}</label>

    <input id="{{ $field }}" type="{{ $type }}" class="form-control @error($field) is-invalid @enderror"
        name="{{ $field }}" value="{{ $default ?? old($field) }}" @if($required) required @endif
        @if ($readonly) readonly @endif @if ($type === 'number') step="{{ $step }}" @endif autocomplete
        autofocus>

    @error($field)
        <x-single-error :message="$message" />
    @enderror
</div>
