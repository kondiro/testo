@php
    $is_gestion_acc = str_contains(url()->current() , 'subscription-manager');
@endphp
<li class="menu module my-2">
    <a href="#GDCEPBA" data-toggle="collapse" class="dropdown-toggle"
       data-tooltip="tooltip"
       data-placement="{{ app()->getLocale() =='ar' ? 'left':'right'}}"
       title="{{ __('layout/sidebar.GDCEPBA') }}"
    >
        <div class="">
            <i class="las la-tasks"></i>
            <span>{{__('layout/sidebar.GDCEPBA_')}}</span>
        </div>
        <div>
            <i class="las la-angle-right sidemenu-right-icon"></i>
        </div>
    </a>
    <ul class="submenu list-unstyled  @if($is_gestion_acc) show @else collapse @endif" id="GDCEPBA" data-parent="#accordionExample">

        <li class="@if(url()->current() === route('profile'))) active @endif">
            <a data-active="" href="{{ route('profile') }}"> {{__('gestionAccounts/profile.page_name')}} </a>
        </li>



    </ul>
</li>
