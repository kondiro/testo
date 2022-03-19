@push('plugin-styles')
    {!! Html::style('assets/css/forms/radio-theme.css') !!}
    {!! Html::style('assets/css/forms/checkbox-theme.css') !!}
    {!! Html::style('assets/css/forms/form-widgets.css') !!}
    {!! Html::style('plugins/flatpickr/flatpickr.css') !!}
    {!! Html::style('plugins/flatpickr/custom-flatpickr.css') !!}
    {!! Html::style('plugins/select2/select2.min.css') !!}
    {!! Html::style('assets/css/forms/form-widgets.css') !!}
    {!! Html::style('assets/css/forms/file-upload.css') !!}
    <style>
        .select2-container .select2-selection--single .select2-selection__rendered {
            padding: 0.6rem 1.8rem;
        }
    </style>
@endpush
@push('plugin-scripts')
    {!! Html::script('plugins/select2/select2.min.js') !!}
    {!! Html::script('assets/js/forms/custom-select2.js') !!}
    {!! Html::script('plugins/flatpickr/flatpickr.js') !!}
    {!! Html::script('plugins/flatpickr/custom-flatpickr.js') !!}
@endpush
@push('custom-scripts')
    <script>
        // if this doesn't  contain any file upload  please comment all js bellow
        (function ($) {
            "use strict";
            $(document).ready(function () {
                $('.options').each(function () {
                    let $this = $(this);
                    let childs = $this.find('input[type="checkbox"]');
                    let min = $this.attr('minimum-selection');
                    $.map(childs, function (val, i) {
                        $(val).on('change', function () {
                            let childCheckedCount = $this.find('input[type="checkbox"]:checked').length;
                            if (childCheckedCount >= min) {
                                $.map(childs, function (val, i) {
                                    $(val).prop('required', false)
                                });
                            } else {
                                $.map(childs, function (val, i) {
                                    $(val).prop('required', true)
                                });
                            }
                        })
                    });
                });
                @if($fileUpload)
                $('.file-upload').on('change', function (e) {
                    let $this = $(this);
                    let attachedFileEl = $this.siblings('.attached-files');
                    let imgPreviewEl = attachedFileEl.find('img');
                    let fileIconEl = attachedFileEl.find('.file-icon');
                    let fileNameEl = attachedFileEl.find('.file-name');


                    fileNameEl.text($this.get(0).files[0].name)
                    attachedFileEl.removeClass("d-none").addClass("d-block");

                    let blobUrl = URL.createObjectURL(e.target.files.item(0));
                    if (isImage(fileExt($this.val()))) {
                        fileIconEl.addClass('d-none');
                        imgPreviewEl.removeClass('d-none').attr('src', blobUrl);
                    }else {
                        imgPreviewEl.addClass('d-none');
                        fileIconEl.removeClass('d-none');
                    }
                });

                function fileExt(fileName) {
                    return fileName.split('.').pop().toLowerCase();
                }

                function isImage($fileExt) {
                    return ['png', 'jpg', 'jpeg'].includes($fileExt);
                }


                $('.attached-files').on('click', '.delete-label', function (event) {
                    let attachedFileEl = $(this).closest('.attached-files');
                    attachedFileEl.find('input[type="hidden"]').val('');
                    attachedFileEl
                        .removeClass("d-block")
                        .addClass("d-none")
                        .children('img')
                        .attr('src', '');

                });
                @endif
                const forms = document.getElementsByClassName('needs-validation');
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                $('select[required]').on('change', function () {
                    validateSelect($(this));
                });

                function validateSelect(element) {
                    let selectSelection = element.siblings('.select2')
                        .find('.select2-selection__rendered');
                    if (element.val()) {
                        selectSelection
                            .css({
                                border: '1px solid #bfc9d4'
                            });
                        return true;
                    } else {
                        selectSelection
                            .css({
                                border: '1px red solid'
                            });
                        return false;

                    }
                }




                let flatpickrEls = $('.flatpickr');

                flatpickrEls.on('change' , function (){
                   let $this = $(this);
                    $this.on('change' , )
                   if($this.prop('required') && $this.val() === ''){
                       $this.css({
                           border: '1px red solid'
                       });
                   }else {
                       $this.css({
                           border: '1px solid #bfc9d4'
                       });
                   }
                });

                // Loop over them and prevent submission
                Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                            @if($fileUpload){
                            $('.file-upload').each(function () {
                                if ($(this).attr('is-required') == 1) {
                                    let parent = $(this)
                                        .closest('.layout-spacing');
                                    if ($(this).val() === '' && parent.find('img').attr('src') === '') {
                                        parent
                                            .find('.invalid-feedback')
                                            .text("{{ __('validation.required', ['attribute' => '']) }}");
                                        event.preventDefault();
                                        event.stopPropagation();
                                    } else {
                                        parent
                                            .find('.invalid-feedback')
                                            .remove();
                                    }
                                }
                            });
                        }
                        @endif

                        $($('.options')).each(function () {
                            let $this = $(this);
                            let childs = $this.find('input[type="checkbox"]')
                            let childCheckedCount = $this.find('input[type="checkbox"]:checked').length;
                            let min = $this.attr('minimum-selection');
                            if (childCheckedCount >= min) {
                                $.map(childs, function (val, i) {
                                    $(val).prop('required', false)
                                });
                            } else {
                                $.map(childs, function (val, i) {
                                    $(val).prop('required', true)
                                });
                                event.stopPropagation()
                                event.preventDefault();
                            }
                        });
                        $('select[required]').each(function () {
                           if(!validateSelect($(this))){
                               event.preventDefault();
                               event.stopPropagation();
                           }
                        });







                        flatpickrEls.each(function (){
                            let $this = $(this);
                            if($this.prop('required') && $this.val() === ''){
                                $this.css({
                                    border: '1px red solid'
                                });
                            }else {
                                $this.css({
                                    border: '1px solid #bfc9d4'
                                });
                            }
                        });





                        form.classList.add('was-validated');
                    }, false);
                });
            });
        })(jQuery);
    </script>
@endpush
