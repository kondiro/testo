@props(['prefix' => [],  'urls' => [] ])
<li>
    <a href="#{{$prefix[0]}}-collapse" data-toggle="collapse" aria-expanded="false"
       class="dropdown-toggle @if(str_contains(url()->current() ,'/'. $prefix[0])) collapse  @endif   ">
        {{$prefix[1]}}
        <i class="las la-angle-right sidemenu-right-icon"></i> </a>
    <ul class="collapse list-unstyled sub-submenu @if(str_contains(url()->current() , '/'. $prefix[0])) show @else collapse  @endif  "
        id="{{$prefix[0]}}-collapse" data-parent="#pages">

        @if(is_array($urls) && count($urls))
            @foreach($urls as $url)
                <li class="@if(url()->current() == $url['route'])) active   @endif {{app()->getLocale() =='ar' ? 'left':'right'}}">
                    <a href="{{  $url['route']}}"> {{ $url['name']}} </a>
                </li>
            @endforeach

        @endif


    </ul>
</li>
