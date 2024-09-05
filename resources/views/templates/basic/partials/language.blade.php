@if (gs('multi_language'))
    @php
        $languages = App\Models\Language::all();
        $language = $languages->where('code', '!=', session('lang'));
        $activeLanguage = $languages->where('code', session('lang'))->first();
    @endphp
    <div class="language__icon">
        <i class="fas fa-globe"></i>
    </div>
    <div class="language__wrapper" data-bs-toggle="dropdown" aria-expanded="false">
        <p class="language__text">{{ __(@$activeLanguage->name) }}</p>
        <span class="language__arrow"><i class="fas fa-chevron-down"></i></span>
    </div>
    <div class="dropdown-menu">
        <ul class="language-list">
            @foreach ($language as $item)
                <li class="language-list__item langSel" data-lang_code="{{ $item->code }}">
                    <p class="language_text">{{ __(@$item->name) }}</p>
                </li>
            @endforeach
        </ul>
    </div>
@endif
