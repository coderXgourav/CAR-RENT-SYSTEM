@php
    $supportContent = getContent('support.content', true);
@endphp
<section class="support-section py-120 bg-img bg-fixed" data-background-image="{{ getImage('assets/images/frontend/support/' . @$supportContent->data_values->image, '1920x1080') }}">
    <div class="container">
        <div class="row gy-4 justify-content-center align-items-center">
            <div class="col-lg-12">
                <div class="support-section-content text-center">
                    <h2 class="support-section__title mx-auto">{{ __(@$supportContent->data_values->heading) }}</h2>
                    <p class="support-section__desc">{{ __(@$supportContent->data_values->subheading) }}</p>
                    <div class="support-bnt-group d-flex flex-wrap gap-3 justify-content-center">
                        <a href="{{ url(@$supportContent->data_values->button_one_link) }}" class="btn btn--gradient">{{ __(@$supportContent->data_values->button_one_name) }}

                        </a>
                        <a href="{{ url(@$supportContent->data_values->button_two_link) }}" class="btn btn-outline--base">{{ __(@$supportContent->data_values->button_two_name) }}

                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
