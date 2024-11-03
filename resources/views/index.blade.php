@extends("master")

@section("title", "Home")

@section("content")
<section class="home" id="home">
	<canvas class="line-background"></canvas>
    <div class="container">
	    <h2 class="home__title">@lang('home.home_title')</h1>

        <div class="home__buttons">
            <a class="button--install" href="/install/linux">
                <img src={{ Vite::image('linux.png') }} alt="Linux">
                @lang('home.install_linux')
            </a>

            <a class="button--install" href="/install/windows">
                <img src={{ Vite::image('windows_10.png') }} alt="Windows">
                @lang('home.install_windows')
            </a>
        </div>
    </div>
</section>

<section class="about" id="about">
    <h2 class="about__title">@lang('home.about_title')</h2>

    <div class="container">
        <div class="about__row">
            <div class="about__col">
                <p class="about__description">
                    @lang('home.about_description_1')
                </p>
                <p class="about__description">
                    @lang('home.about_description_2')
                </p>
                <p class="about__description">
                    @lang('home.about_description_3')
                </p>
            </div>
            <div class="about__screenshots">
                <div class="carousel">
                    <div class="carousel__items">
                        <img class="screenshot" src={{ Vite::image('screenshot_editor.png') }} alt="Weetee Editor">
                        <img class="screenshot" src={{ Vite::image('screenshot_results.png') }} alt="Weetee Testing Results">
                        <img class="screenshot" src={{ Vite::image('screenshot_remote.png') }} alt="Weetee Remote File Sync">
                    </div>
                    <div class="carousel__pagination">
                        <button class="carousel__prev">
                            <img src={{ Vite::image('previous.svg') }} alt="Previous">
                        </button>
                        <button class="carousel__next">
                            <img src={{ Vite::image('next.svg') }} alt="Next">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="faq" id="faq">
	<canvas class="sine-background"></canvas>
    <div class="container">
        <h2 class="faq__title">@lang('home.faq_title')</h2>
        <ul class="faq__questions">
            <li class="faq__element">
                <p class="faq__question">@lang('home.faq_q_install')</p>
                <p class="faq__answer">@lang('home.faq_a_install')</p>
            </li>
            <li class="faq__element">
                <p class="faq__question">@lang('home.faq_q_usage')</p>
                <p class="faq__answer">@lang('home.faq_a_usage')</p>
            </li>
            <li class="faq__element">
                <p class="faq__question">@lang('home.faq_q_postman')</p>
                <p class="faq__answer">@lang('home.faq_a_postman_1')</p>
                <p class="faq__answer">@lang('home.faq_a_postman_2')</p>
                <p class="faq__answer">@lang('home.faq_a_postman_3')</p>
            </li>
        </ul>
    </div>
</section>
@endsection
