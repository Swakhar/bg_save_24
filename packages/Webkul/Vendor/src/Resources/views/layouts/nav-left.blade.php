<div id="menu_List" class="dt mobile_menu_list hide">
    <div class="top_info">
        <img id="menu_close" class="dt_cl img_close"
             src="{{ asset('vendor/webkul/admin/assets/css/icons/close.png') }}" alt="">
    </div>
    <ul class="dt">
        @foreach ($menu->items as $menuItem)
            <li class="dt mobile_menu_item {{ $menu->getActive($menuItem) }}">
                <a class="dt" href="{{ count($menuItem['children']) ? current($menuItem['children'])['url'] : $menuItem['url'] }}">
                    <span class="dt icon {{ $menuItem['icon-class'] }}"></span>
                </a>
                <a class="absolute_a_mobile_menu" href="{{ count($menuItem['children']) ? current($menuItem['children'])['url'] : $menuItem['url'] }}">
                    <span class="dt">{{ trans($menuItem['name']) }}</span>
                </a>
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