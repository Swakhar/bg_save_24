<div id="menu_List" class="dt mobile_menu_list hide">
    <div class="top_info">
        <img id="menu_close" class="dt_cl img_close"
             src="{{ asset('vendor/webkul/admin/assets/css/icons/close.png') }}" alt="">
    </div>
    <ul class="dt">
        {{--{!! json_encode($menu->items, true) !!}--}}
        @foreach ($menu->items as $menuItem)
            <li class="dt mobile_menu_item {{ $menu->getActive($menuItem) }}">
                <a class="dt" href="{{ count($menuItem['children']) ? current($menuItem['children'])['url'] : $menuItem['url'] }}">
                    <span class="dt icon {{ $menuItem['icon-class'] }}"></span>
                </a>
                <a class="absolute_a_mobile_menu" href="{{ count($menuItem['children']) ? current($menuItem['children'])['url'] : $menuItem['url'] }}">
                    <span f="{{ count($menuItem['children']) }}" class="dt">{{ trans($menuItem['name']) }}</span>
                </a>
                @if (count($menuItem['children']))
                    <ul class="mobile_menu_sub_menu">
                        @foreach ($menuItem['children'] as $child_menu_name => $child_menu_data)
                            <li><a href="{{ $child_menu_data['url'] }}">{{ trans($child_menu_data['name']) }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</div>

<div class="navbar-left">
    <ul class="menubar">
        @foreach ($menu->items as $menuItem)
            <li class="menu-item {{ $menu->getActive($menuItem) }}">
                <a href="{{ count($menuItem['children']) ? current($menuItem['children'])['url'] : $menuItem['url'] }}">
                    <span class="icon {{ $menuItem['icon-class'] }}"></span>
                    
                    <span>{{ trans($menuItem['name']) }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</div>