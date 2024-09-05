@php
    $faqContent = getContent('faq.content', true);
    $faqElement = collect(getContent('faq.element', orderById: true))->chunk(3);
@endphp

<section class="faq py-120">
    <div class="container">
        <div class="section-heading">
            <p class="section-heading__name">{{ __(@$faqContent->data_values->heading) }}</p>
            <h3 class="section-heading__title">{{ __(@$faqContent->data_values->subheading) }}</h3>
        </div>
        <div class="faq-wrapper">
            <div class="accordion faq--accordion" id="accordionExample">
                <div class="row g-3">
                    <div class="col-lg-6">
                        @foreach (@$faqElement[0] as $faq)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button @if (!$loop->first) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" @if ($loop->first) aria-expanded="true" @else aria-expanded="false" @endif aria-controls="collapse{{ $faq->id }}">
                                        {{ __(@$faq->data_values->question) }}
                                        <span class="accordion-icon"><i class="las la-angle-down"></i></span>
                                    </button>
                                </h2>
                                <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse @if ($loop->first) show @endif" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>{{ __(@$faq->data_values->answer) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-lg-6">
                        @foreach (@$faqElement[1] as $faq)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapse{{ $faq->id }}">
                                        {{ __(@$faq->data_values->question) }}
                                        <span class="accordion-icon"><i class="las la-angle-down"></i></span>
                                    </button>
                                </h2>
                                <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>{{ __(@$faq->data_values->answer) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
