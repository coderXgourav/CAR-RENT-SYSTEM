@php
    $blogContent = getContent('blog.content', true);
    $blogs = getContent('blog.element', false, 4, true);
@endphp

<section class="blog py-120">
    <div class="container">
        <div class="section-heading">
            <p class="section-heading__name">{{ __(@$blogContent->data_values->heading) }}</p>
            <h2 class="section-heading__title">{{ __(@$blogContent->data_values->subheading) }}</h2>
        </div>
        <div class="blog-slider">
            @include($activeTemplate . 'partials.blog')
        </div>
    </div>
</section>
