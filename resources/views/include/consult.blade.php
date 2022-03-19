@push('plugin-styles')
    {!! Html::style('assets/css/loader.css') !!}
    {!! Html::style('plugins/sweetalerts/sweetalert2.min.css') !!}
    {!! Html::style('plugins/sweetalerts/sweetalert.css') !!}
    {!! Html::style('assets/css/basic-ui/custom_sweetalert.css') !!}
@endpush
@push('plugin-scripts')
    {!! Html::script('assets/js/loader.js') !!}
    {!! Html::script('plugins/sweetalerts/sweetalert2.min.js') !!}
@endpush
@push('custom-scripts')
    <script>
        $('.delete-record').on('click', function (e) {
            e.preventDefault();
            window.url = $(this).attr('href');
            swal({
                title: "{{ __('globals.Es-tu sûr?') }}",
                text: "{{ __('globals.Vous ne pourrez pas revenir en arrière!') }}",
                type: 'warning',
                cancelButtonText: "{{ __('globals.annuler') }}",
                showCancelButton: true,
                confirmButtonText: '{{ __('globals.confirmer') }}',
                padding: '2em'
            }).then(function (result) {
                if (result.value) {
                    window.location.href = window.url;
                }
            });
        });

        @if(session()->has('message'))
        @php


                $return_value = match ( session()->get('message')[1] ?? -1) {
                    0 => __('globals.ajouté a été avec succès'),
                    1 => __('globals.mis a jour a été  avec succés'),
                    2 => __('globals.supprimé a été avec succès'),
                    -1 => ''
                };
        @endphp
        swal({
            title: "{{ session()->get('message')[0] == 1 ? __('globals.complété') :  __('globals.Erreur')}}",
            text: "{{ session()->get('message')[0] == 1 ?  $return_value: __("globals.quelque chose s'est mal passé essaie encore") }}",
            type: "{{ session()->get('message')[0] == 1 ? 'success' :  'error'}}",
            confirmButtonText: '{{ __('globals.ok') }}',
            padding: '2em'
        });
        @endif

    </script>
@endpush
