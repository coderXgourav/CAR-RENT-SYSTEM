@extends($activeTemplate . 'layouts.app')
@section('app')
    @include($activeTemplate . 'partials.header')
    <main>
        @if (!request()->routeIs('home'))
            @include($activeTemplate . 'partials.breadcrumb')
        @endif
        <section class="dashboard py-120">
            <div class="container">
                <div class="dashboard__inner">
                    @include($activeTemplate . 'partials.sidebar')

                    <div class="dashboard__right">
                        <div class="dashboard-body">
                            @include($activeTemplate . 'partials.responsive_navbar')

                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include($activeTemplate . 'partials.footer')
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.showFilterBtn').on('click', function() {
                $('.responsive-filter-card').slideToggle();
            });

            Array.from(document.querySelectorAll('table')).forEach(table => {
                let heading = table.querySelectorAll('thead tr th');
                Array.from(table.querySelectorAll('tbody tr')).forEach((row) => {
                    Array.from(row.querySelectorAll('td')).forEach((colum, i) => {
                        colum.setAttribute('data-label', heading[i].innerText)
                    });
                });
            });
        })(jQuery)
    </script>
@endpush
