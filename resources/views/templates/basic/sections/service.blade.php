@php
    $serviceContent = getContent('service.content', true);
    $serviceElement = getContent('service.element', orderById: true);
@endphp
<section class="choose-us py-120 bg-img" data-background-image="{{ getImage('assets/images/frontend/service/' . @$serviceContent->data_values->background_image, '1905x995') }}">
    <div class="container">
        <div class="section-heading">
            <p class="section-heading__name name-base">{{ __(@$serviceContent->data_values->heading) }}</p>
            <h3 class="section-heading__title text-white">{{ __(@$serviceContent->data_values->subheading) }}</h3>
        </div>
        <div class="choose-us-tabs">
            <ul class="nav nav-tabs style-two" role="tablist">
                @foreach (@$serviceElement as $service)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if ($loop->first) active @endif" data-bs-toggle="tab" data-bs-target="#tab{{ @$service->id }}" type="button" role="tab" aria-selected="true">
                            <span class="icon">
                                @php
                                    echo @$service->data_values->icon;
                                @endphp
                            </span>
                            <span class="title">{{ __(@$service->data_values->title) }}</span>
                        </button>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content">
                @foreach (@$serviceElement as $service)
                    <div class="tab-pane @if ($loop->first) show active @endif" id="tab{{ @$service->id }}">
                        <div class="row g-4 g-xl-5">
                            <div class="col-lg-6">
                                <div class="choose-thumb">
                                    <img class="fit-image" src="{{ getImage('assets/images/frontend/service/' . @$service->data_values->image, '625x370') }}" alt="@lang('image')" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="choose-content">
                                    <h3 class="choose-content__title">{{ __(ucwords(@$service->data_values->title)) }}</h3>
                                    <p>
                                        @php
                                            echo @$service->data_values->description;
                                        @endphp
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
