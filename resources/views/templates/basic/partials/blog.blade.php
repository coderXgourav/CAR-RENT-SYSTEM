@foreach (@$blogs as $blog)
    <div class="col-md-6">
        <a href="{{ route('blog.details', [slug(@$blog->data_values->title), $blog->id]) }}" class="blog-item">
            <div class="blog-item__wrapper">
                <div class="blog-item__thumb">
                    <img src="{{ getImage('assets/images/frontend/blog/thumb_' . @$blog->data_values->image, '485x245') }}" class="fit-image" alt="@lang('image')" />
                </div>
                <div class="blog-item__content">
                    <h5 class="blog-item__title border-effect">{{ __(@$blog->data_values->title) }}</h5>
                    <p class="blog-item__desc">
                        @php
                            echo strLimit(strip_tags(@$blog->data_values->description), 60);
                        @endphp
                    </p>
                    <div class="blog-auth">
                        <div class="blog-auth__content">
                            <ul class="blog-publish">
                                <li class="blog-publish__date">{{ showDateTime(@$blog->created_at, 'd M Y') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endforeach
