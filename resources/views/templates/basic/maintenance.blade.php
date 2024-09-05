@extends($activeTemplate . 'layouts.app')
@section('app')
    <section class="maintanance-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="maintanance-icon mx-auto mb-4">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    @php echo $maintenance->data_values->description @endphp
                </div>
            </div>
        </div>
    </section>
@endsection
@push('style')
    <style>
        .maintanance-page {
            display: grid;
            place-content: center;
            width: 100vw;
            height: 100vh;
        }

        .maintanance-icon {
            width: 60px;
            height: 60px;
            display: grid;
            place-items: center;
            aspect-ratio: 1;
            border-radius: 50%;
            background: #fff;
            font-size: 26px;
            color: hsl(var(--danger));
        }
    </style>
@endpush
