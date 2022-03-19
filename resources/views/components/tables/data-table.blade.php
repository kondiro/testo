@push('plugin-styles')
    {!! Html::style('plugins/table/datatable/datatables.css') !!}
    {!! Html::style('plugins/table/datatable/dt-global_style.css') !!}
    <style>
        #{{$id}}_filter label {
            float: left;
        }
    </style>
@endpush
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <h4 class="table-header">{{__($title)}}</h4>
                <div class="table-responsive mb-4">
                    <table id="{{$id}}" class="table table-hover" style="width: 100%;">
                        <thead>
                        <tr>
                            <th class="no-content  pr-1">
                                <input id='check_all_{{$id}}'
                                       class='chkAll '
                                       type='checkbox'>
                            </th>
                            @foreach($datatableColumns as $column => $value)
                                <th> {{ $value[1] }} </th>
                            @endforeach
                            @if(!empty($editRoute) || !empty($deleteRoute))
                                <th class="no-content">
                                    {{ __('globals.actions') }}
                                </th>
                            @endif
                        </tr>
                        </thead>

                        <tbody>

                        @if(isset($dataCollection))
                            @foreach($dataCollection as $model)
                                <tr>
                                    <td style="padding-right: 30px;">
                                        <input class="chGrid" type="checkbox"
                                               value="{{ empty($primaryKey)  ?  $getPrimaryKey($model)  : $model->{$primaryKey} }}">
                                    </td>
                                    @foreach($datatableColumns as $column => $value)
                                        @switch($value[0])
                                            @case('text')
                                            <td>
                                                {{ $model->{$column} ?? __('globals.vide') }}
                                            </td>
                                            @break
                                            @case('img')
                                            <td>

                                                @if(isset($model->{$column}))
                                                    @if(str_contains($model->{$column} , 'http'))
                                                        <img src="{{ $model->{$column} }}" width="54"
                                                             height="54"
                                                             class="rounded-circle" alt="">

                                                    @else
                                                        <img src="{{asset('storage/app/' .  $model->{$column})}}"
                                                             width="54"
                                                             height="54"
                                                             class="rounded-circle" alt="">
                                                    @endif
                                                @else
                                                    {{ __('globals.vide') }}
                                                @endif

                                            </td>
                                            @break
                                            @break

                                            @case('choix')
                                            <td>
                                                @foreach($value[2] as $key => $val)
                                                    @if($model[$column] == $key)
                                                        {{ $val }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            @break

                                        @endswitch
                                        @if($value[0] === 'text')
                                        @elseif($value[0] === 'img')

                                        @endif
                                    @endforeach
                                    @if(!empty($editRoute) || !empty($deleteRoute))
                                        <td class="text-center">
                                            <div class="dropdown custom-dropdown">
                                                <a class="dropdown-toggle font-20 text-primary" href="#" role="button"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="las la-cog"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1"
                                                     style="will-change: transform;">

                                                    @if(!empty($editRoute))
                                                        <a href='{{ empty($primaryKey)  ?  $generateActionUrlIfNoPk($editRoute , $model )  : route($editRoute ,$model->{$primaryKey} )  }}'
                                                           class='dropdown-item'>
                                                            {{ __('globals.modifier') }}
                                                        </a>
                                                    @endif
                                                    @if(!empty($deleteRoute))
                                                        <a href='{{ empty($primaryKey)  ?   $generateActionUrlIfNoPk($deleteRoute , $model ) : route($deleteRoute , $model->{$primaryKey} )  }}'
                                                           class='delete-record dropdown-item'>
                                                            {{ __('globals.supprime') }}
                                                        </a>
                                                    @endif
                                                    @foreach($moreRoutes as $item => $val)
                                                        @if(!empty( $model->{$val[0]}))
                                                            <a href='{{ route($val[1]  , base64_encode( $model[$val[0]]) )  }}'
                                                               class='dropdown-item'>
                                                                {{ $item }}
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </td>
                                    @endif


                                </tr>
                            @endforeach
                        @endif

                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


@push('plugin-scripts')
    {!! Html::script('plugins/table/datatable/datatables.js') !!}
    <!--  The following JS library files are loaded to use Copy CSV Excel Print Options-->
    {!! Html::script('plugins/table/datatable/button-ext/dataTables.buttons.min.js') !!}
    {!! Html::script('plugins/table/datatable/button-ext/jszip.min.js') !!}
    {!! Html::script('plugins/table/datatable/button-ext/buttons.html5.min.js') !!}
    {!! Html::script('plugins/table/datatable/button-ext/buttons.print.min.js') !!}
    <!-- The following JS library files are loaded to use PDF Options-->
    {!! Html::script('plugins/table/datatable/button-ext/pdfmake.min.js') !!}
    {!! Html::script('plugins/table/datatable/button-ext/vfs_fonts.js') !!}
@endpush

@push('custom-scripts')
    <script>
        $("#check_all_{{$id}}").click(function () {
            $(".chGrid").prop("checked", $(this).prop("checked"));
        });

        const {{ $id }} = $('#{{ $id }}').DataTable({
            "language": {
                'url':
                    @if(app()->getLocale() == 'ar') 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json'
                @else 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/fr_fr.json' @endif,
                "paginate": {
                    "previous": "<i class='las la-angle-left'></i>",
                    "next": "<i class='las la-angle-right'></i>"
                }
            },
            "lengthMenu": [5, 10, 15, 20],
            "pageLength": 5,
            "columnDefs": [
                {"orderable": false, "targets": 0}
            ]
        });
    </script>
@endpush


