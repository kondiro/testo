<div class='form-group row'>
    <label class="col-sm-3 col-12 col-form-label"
        for={{ $name }}
            class='form-label'>
        {{ $label }}
        @if($required || $attributes->has('required'))
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="col-sm-9 col-12">
          <textarea
              {{ $required ? 'required'  : ''}}
              {{ $readonly ? 'readonly'  : ''}}
              {{$attributes->merge(['class' => 'form-control'])}}
              placeholder="{{ $label }}"

              id="{{ $name }}"
              name="{{ $name }}">{{$value}}</textarea>

        <x-alerts.error-message>
            @error($name)
            {{$message}}
            @enderror
        </x-alerts.error-message>
    </div>

</div>





