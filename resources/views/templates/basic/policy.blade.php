@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="py-120">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        @php
                            echo $policy->data_values->details;
                        @endphp
                    </p>
                </div>
            </div>
    </section>
@endsection
