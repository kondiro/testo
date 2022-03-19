@push('plugin-styles')
    <style>
        .breadcrumb-item {
            display: block !important;
        }

        .breadcrumb-item:before {
            display: inline-block !important;
        }
    </style>
@endpush
<div class="sub-header-container ">
    <header class="header navbar navbar-expand-sm " style="box-shadow: 0px 0px 20px 0px rgb(0 0 0 / 10%);">
        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
            <i class="las la-bars"></i>
        </a>
        <ul class="navbar-nav flex-row">
            <li>
                <div class="page-header">
                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item ">
                                <a href="{{ url('/') }}">{{ __('globals.tableau de bord') }}</a>
                            </li>
                            @if(count($breadCrumb))
                                @foreach($breadCrumb as $item => $val)
                                    <li class="breadcrumb-item @if($loop->last) active @endif " aria-current="page">
                                        @if($loop->last)
                                            <span>{{$item}}</span>
                                        @else
                                            <a href="{{ $val ?? "#" }}">{{ $item }}</a>
                                        @endif
                                    </li>
                                @endforeach
                            @endif
                        </ol>
                    </nav>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav d-flex align-center ml-auto right-side-filter">
            <li class="nav-item more-dropdown">
                <a href="{{url()->current() }}" data-original-title="{{__('Reload Data')}}" data-placement="bottom"
                   class="btn btn-primary dash-btn btn-sm ml-2 bs-tooltip">
                    <i class="las la-sync"></i>
                </a>
            </li>
            @if(count($links))
                <li class="nav-item custom-dropdown-icon">
                    <a href="#" data-original-title="Filter" data-placement="bottom"
                       id="customDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       class="btn btn-primary dash-btn btn-sm ml-2 bs-tooltip">
                        <i class="las la-angle-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="customDropdown">
                        @foreach($links as $item => $val)
                            <a class="dropdown-item d-flex align-items-center" data-value="Filter 1"
                               href="{{ $val[1] }}" id="{{ $val[0] == 'delete-all' ? 'delete-selected-rows' : '' }}">
                                <span>
                                     @switch($val[0])
                                        @case('add')
                                        <i class="las la-plus-circle"></i>
                                        @break
                                        @case('delete-all' || 'delete')
                                        <i class="las la-trash"></i>
                                        @break
                                        @case('update')
                                        <i class="las la-edit"></i>
                                        @break
                                    @endswitch
                                </span>
                                <span class="mx-2">
                            {{$item}}
                             </span>
                            </a>
                        @endforeach
                    </div>
                </li>
            @endif

        </ul>
    </header>
</div>

@push('custom-scripts')
    <script>
        $('#delete-selected-rows').on('click', function (e) {
            e.preventDefault();
            window.ids = [];
            window.token = $("meta[name=_token]").attr('content');
            window.href = $(this).prop("href");
            $("input[class='chGrid']:checked").each(function () {
                    window.ids.push($(this).prop("value"));
                }
            );

            if (window.ids.length) {
                swal({
                    title: "{{ __('globals.Es-tu sûr?') }}",
                    text: "{{ __('globals.Vous ne pourrez pas revenir en arrière!') }}",
                    type: 'warning',
                    cancelButtonText: "{{ __('globals.annuler') }}",
                    showCancelButton: true,
                    confirmButtonText: '{{ __('globals.confirmer') }}',
                    padding: '2em'
                })
                    .then(function (result) {
                        if (result.value) {
                            $.ajax({
                                url: window.href,
                                type: 'post',
                                data: {
                                    'ids': window.ids,
                                    '_token': window.token
                                },
                                success: function () {
                                    delete (window.token);
                                    delete (window.href);
                                    delete (window.ids);
                                    location.reload();
                                },
                            });
                        }
                    });
            }
        });
    </script>
@endpush


