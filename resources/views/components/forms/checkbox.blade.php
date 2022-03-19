<div class="form-group {{ $multi ? 'col-12 col-sm-2'  : 'col-12'}} {{ app()->getLocale() == 'ar' ? 'mr-2' : 'ml-2'}}" >
    <div class="form-check pl-0">
        <div class="custom-control custom-checkbox checkbox-success">
            <input
                type="checkbox"
                class="custom-control-input"

                value="{{ $value }}"

                {!! $attributes->except('class') !!}

                {!! $attributes->merge(['class' => 'form-check-input ']) !!}

                id="{{ $attributes->has('id') ?: $id() }}"

                name="{{ $name }}{{ $multi ? '[]' : ''}}"


                @if($checked)
                 checked="checked"
                @endif

            >
            <label class="custom-control-label"
                   for={{ $attributes->has('id') ?: $id() }}>
                {{ $label }}

            </label>
            @if($showError)
                <x-alerts.error-message>
                    @error($name)
                    {{$message}}
                    @enderror
                </x-alerts.error-message>
            @endif

        </div>
    </div>
</div>
