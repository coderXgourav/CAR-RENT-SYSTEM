@extends($activeTemplate . 'layouts.app')
@section('app')
    @include($activeTemplate . 'partials.header')

    <main>

        @if (!request()->routeIs('home'))
            @include($activeTemplate . 'partials.breadcrumb')
        @endif

        @yield('content')
    </main>

    @include($activeTemplate . 'partials.footer')
@endsection
