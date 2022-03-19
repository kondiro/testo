<div class="form-group row">
    <label class="col-12 col-sm-3 col-form-label" for="{{ $name }}">
        {{ $label }}
        @if($required || $attributes->has('required'))
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="col-12 col-sm-9">
        <div class="row flex-column">
            <div class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div class="form-group row m-0">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div
                                    class="attached-files @if( !empty($value)  !== null && $isImage() !== null) d-block @endif">
                                    <input type="hidden" value="{{ $orgValue }}" name="{{ $generateNameForInputFileTextbook() }}">
                                    <img class="image-preview @if($isImage() == false || $isImage == null) d-none @endif" width="320" alt=""
                                         src="{{  old($generateNameForInputFileImgPreview()) ?? $value }}">

                                    <span class="file-icon @if($isImage() == true || $isImage() == null) d-none @endif">
                                         <i style="font-size: 8rem" class="las la-file-alt"></i>
                                    </span>
                                        <span style="    overflow-wrap: break-word;" class="file-name">
                                         {{ $file_name }}
                                    </span>

                                    @if(!$readonly)
                                        <span title="Remove Attachment" class="delete-label bs-tooltip">
                                          <i class="las la-times"></i>
                                        </span>
                                    @endif


                                </div>
                                @if(!$readonly)
                                    <label for="{{ $name }}" class="custom-file-upload mb-0">
                                        <a title="Attach a file" class="mr-2 pointer text-primary">
                                            <i class="las la-paperclip font-20"></i>
                                            <span class="font-17">{{ __('globals.choisir') }}</span>
                                        </a>
                                    </label>
                                @endif
                                <input
                                    is-required="{{ $required }}"
                                    id="{{ $name }}"
                                    name="{{ $name }}"
                                    value="{{ $value }}"
                                    class="file-upload"
                                    type="file" accept="{{$getType()}}"
                                    style="display:none;">
                            </div>
                        </div>
                    </div>
                </div>
                <x-alerts.error-message>
                    @error($name)
                    {{$message}}
                    @enderror
                </x-alerts.error-message>
            </div>
        </div>
    </div>
</div>





