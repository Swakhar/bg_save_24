<div v-if="isMobile()">
    <div class="full-width">
        <div class="half-portion">
            <div class="mobile_view_header">
                <a
                        :class="`left ${addClass}`"
                        href="{{ route('shop.home.index') }}">

                    @if ($logo = core()->getCurrentChannel()->logo)
                        <img class="logo"  src="{{ $relative_path . '/uploads/' . $logo }}" />
                        <span class="logo-slogan"> | Check Buy Save</span>
                    @else
                        <img class="logo" src="{{ asset('themes/velocity/assets/images/logo-text.png') }}" />
                    @endif
                    <i id="top_ham_bargur" class="hide rango-view-list text-down-4 align-vertical-top fs18 sidebar_hide"></i>
                </a>
            </div>
        </div>
        <div class="half-portion-right">
            <a href="/customer/login" style="float: right;
color: black;
font-size: 15px;">Login</a>
        </div>

        <div class="full">
            <input type="text" class="input-top-heade-mobile" placeholder="Search here..">
        </div>
    </div>

</div>


@push('scripts')
    <script type="text/javascript">
        (() => {
            document.addEventListener('scroll', e => {
                scrollPosition = Math.round(window.scrollY);

                if (scrollPosition > 50){
                    document.querySelector('header').classList.add('header-shadow');
                } else {
                    document.querySelector('header').classList.remove('header-shadow');
                }
            });
        })()
    </script>
@endpush
