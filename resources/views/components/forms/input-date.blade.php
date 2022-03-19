<div class="form-group row">
    <label class="col-3 col-form-label" for="{{ $id() }}">
        {{ $label }}
        @if($required || $attributes->has('required'))
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="col-9">
        <input
            id="{{ $id() }}"
            {{ $required ? 'required'  : '' }}
            {{ $readonly ? 'readonly'  : '' }}
            {{$attributes->merge(['class' => 'form-control flatpickr flatpickr-input active'])}}
                name="{{ $name }}"
            type="text"
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

@push('custom-scripts')
    <script>
        (function ($) {
            "use strict";
            @switch($pickerType)
                @case('d')
                $("#{{ $id()}}").flatpickr()
                @break

                @case('dt')
                $("#{{ $id()}}").flatpickr({
                    enableTime: true,
                    enableSeconds:true,
                    dateFormat: "Y-m-d H:i:S",
                })
                @break

                @case('uf')
                $("#{{ $id()}}").flatpickr({
                    altInput: true,
                    altFormat: "F j, Y",
                    dateFormat: "Y-m-d",
                })
                @break
                @case('t')
                $("#{{ $id()}}").flatpickr({
                    enableTime: true,
                    noCalendar: true,
                    enableSeconds:true,
                    dateFormat: "H:i:S",
                    time_24hr: true
                })
                @break
            @endswitch
        })(jQuery);

    </script>
@endpush
