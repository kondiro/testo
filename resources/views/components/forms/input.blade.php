<div class="form-group row">
    <label class="col-12 col-sm-3 col-form-label"
           for={{ $name }}>
        {{ $label }}
        @if($required || $attributes->has('required'))
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="col-12 col-sm-9">
        <input
            {{ $required ? 'required'  : '' }}
            {{ $readonly ? 'readonly'  : '' }}
            {{$attributes->merge(['class' => 'form-control '])}}
            type='{{ $type }}'
            id='{{ $name }}'
            name='{{ $name }}'
            placeholder="{{ $label }}"

            value="{{ $value }}"
            {!! $attributes !!}>

        <x-alerts.error-message>
            @error($name)
            {{$message}}
            @enderror
        </x-alerts.error-message>
    </div>
</div>

