<div class='form-group row'>
    <label class="col-3 col-form-label"
           class='form-label'>
        {{ $label }}
        @if($required || $attributes->has('required'))
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="col-9">
        <div class="layout-spacing pb-0 mx-3">
            <div class="row mr-1 options" minimum-selection="{{ $min }}" >
                {{ $slot }}
            </div>
            <x-alerts.error-message>
                @error($name)
                {{ $message }}
                @enderror
            </x-alerts.error-message>
        </div>
    </div>
</div>


@push('custom-scripts')
    <script>
        // if this doesn't  contain any file upload  please comment all js bellow
        (function ($) {
            "use strict";
            $(document).ready(function () {
                @if($required)
                $('input[name="{{$name}}"] , input[type="checkbox"]').attr('required', true);
                @endif
            });
        })(jQuery);
    </script>

@endpush




