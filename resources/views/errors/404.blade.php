<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $general->siteName($pageTitle ?? '404 | page not found') }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ getImage(getFilePath('logoIcon') . '/favicon.png') }}">
    <!-- bootstrap 4  -->
    <link rel="stylesheet" href="{{ asset('assets/global/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/main.css') }}">
</head>

<body>
    <section class="error-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="error-content text-center">
                        <div class="error-content__inner">
                            <h1 class="error-content__title">4<span class="text--base px-2">0</span>4</h2>
                                <h3 class="error-content__subtitle"><span class="icon"><i class="las la-sad-cry"></i></span>@lang('Oops! Page not found')</h3>
                                <p class="error-content__desc">@lang('page you are looking for doesn\'t exist or an other error ocurred') <br> @lang('or temporarily unavailable.')</p>
                                <a href="{{ route('home') }}" class="btn btn--gradient">@lang('Go to Home')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
