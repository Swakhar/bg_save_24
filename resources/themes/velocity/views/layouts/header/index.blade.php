<header class="sticky-header" v-if="!isMobile()">
    <div class="col-md-12" style="margin-top: 3px;">
        <div class="col-md-3" style="    max-width: 21%;">
            <logo-component></logo-component>
        </div>
        <div class="col-md-9" style="    max-width: 79%;">
            <searchbar-component></searchbar-component>
        </div>
    </div>
</header>

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
