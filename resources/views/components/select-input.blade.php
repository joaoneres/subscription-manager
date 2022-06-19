<div class="col-md-{{ $col ?? '12' }} mb-{{ $mb ?? '0' }}">
    @if ($label)
        <label for="{{ $field }}" class="text-md-end">{{ $label }}</label>
    @endif

    <select @if($disabled) disabled @endif required="{{ $required ?? true }}" name="{{ $field }}"
        class="form-control @error('{{ $field }}') is-invalid @enderror" autofocus>
        <option value="">{{ __('Select...') }}</option>

        @foreach ($options as $key => $option)
            <option value="{{ $key }}" @if ($key == $selected) selected @endif>{{ $option }}
            </option>
        @endforeach
    </select>

    @error($field)
        <x-single-error :message="$message" />
    @enderror
</div>
