<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="statbox widget ">
                <div class="widget-header pt-3">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4> {{ $title }}</h4>
                        </div>
                    </div>
                </div>
                <form enctype="multipart/form-data" action="{{ $action }}" method="{{ $method }}"
                      {!! $attributes->except('class') !!}
                      @if($withValidation) novalidate {!! $attributes->merge(['class' => 'needs-validation']) !!}
                @else {!! $attributes->merge(['class' => '']) !!} @endif >
                    @if(in_array(Str::upper($method), ['PUT', 'PATCH', 'DELETE' , 'POST']) )
                        @csrf
                    @endif
                    <div class="widget-content widget-content-area">
                        {{ $slot }}
                    </div>
                    <div class="widget-footer p-3 text-right">
                        <button type="submit" class="btn btn-primary mr-2">{{ __('globals.enregistrer') }}</button>
                        <button type="reset" class="btn btn-outline-primary">{{ __('globals.annuler') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

