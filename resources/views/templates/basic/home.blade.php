@extends($activeTemplate . 'layouts.frontend')
@section('content')

    @include($activeTemplate . 'sections.banner')
    @include($activeTemplate . 'sections.search')

    @if (@$sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif

@endsection
