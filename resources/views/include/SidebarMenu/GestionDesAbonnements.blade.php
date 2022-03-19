@php

    $parametrageTables = ['abonnements'];
     $isAbonnements = \App\classes\Helpers::contains(url()->current(),$parametrageTables);


@endphp
<li class="menu module my-2">
    <a href="#GDA" data-toggle="collapse" class="dropdown-toggle  @if($isAbonnements) collapse  @endif "
       data-tooltip="tooltip"
       data-placement="{{ app()->getLocale() =='ar' ? 'left':'right'}}"
       title="{{ __('layout/sidebar.GDA') }}">
        <div class="">
            <i class="las la-money-check"></i>
            <span>{{__('layout/sidebar.GDA_')}}</span>
        </div>
        <div>
            <i class="las la-angle-right sidemenu-right-icon"></i>
        </div>
    </a>
    <ul class="submenu list-unstyled @if($isAbonnements) show @else collapse  @endif" id="GDA" data-parent="#accordionExample">
        @foreach(\App\classes\Helpers::SideBarGestionAbonnements() as $moduleContent )
            <x-inc.parametrage-menu-item :prefix="$moduleContent['prefix']" :urls="$moduleContent['urls']" />
        @endforeach
    </ul>
</li>
