@php

    $parametrageTables = [
                'regions',
                'villes',
                'barreaux',
                'specialites',
                'filieres',
                'juridictions',
                'tribunaux',
                'chambres',
                'typeemployerjustices',
                'gradetypes',
                'employerjustices',
                'typeintervenants',
                'gradetypeintervenants',
                'intervenants',
                'avocats',
                'bureaux',
                'officeaccounts',
                'admins',
                'cabinets',
            ];
     $isSettings = \App\classes\Helpers::contains(url()->current(),$parametrageTables);


@endphp

<li class="menu module my-2">
    <a href="#P" data-toggle="collapse" class="dropdown-toggle @if($isSettings) collapse  @endif  "
       data-tooltip="tooltip"
       data-placement="{{ app()->getLocale() =='ar' ? 'left':'right'}}"
       title="{{ __('layout/sidebar.P') }}"
    >
        <div class="">
            <i class="las la-cog"></i>
            <span>{{__('layout/sidebar.P')}}</span>
        </div>
        <div>
            <i class="las la-angle-right sidemenu-right-icon"></i>
        </div>
    </a>
    <ul class="submenu list-unstyled @if($isSettings) show @else collapse  @endif" id="P" data-parent="#accordionExample">
        @foreach(\App\classes\Helpers::SideBarSettingModelContent() as $moduleContent )
            <x-inc.parametrage-menu-item :prefix="$moduleContent['prefix']" :urls="$moduleContent['urls']" />
        @endforeach
    </ul>
</li>
