@extends("master")

@section("title", "Home")

@section("content")
<section class="home" id="home">
	<canvas class="line-background"></canvas>
    <div class="container">
	    <h2 class="home__title">Start testing APIs freely with Weetee</h1>

        <div class="home__buttons">
            <button class="button--install">
                <img src={{ Vite::image('linux.png') }} alt="Linux">
                Install for linux
            </button>

            <button class="button--install">
                <img src={{ Vite::image('windows_10.png') }} alt="Windows">
                Install for windows
            </button>
        </div>
    </div>
</section>

<section class="about" id="about">
    <h2 class="about__title">About</h2>

    <div class="container">
        <div class="about__row">
                <div class="about__col">
                    <p class="about__description">
                        Weetee is a free and open-source tool for manual and automatic HTTP API testing.
                    </p>
                    <p class="about__description">
                        With it you can quickly and efficiently create a test suite for your HTTP API server and run it automatically.
                    </p>
                    <p class="about__description">
                        Weetee also supports remote file syncing so you can work on your test suite from different computers and have them synced.
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
        <h2 class="faq__title">Frequently Asked Questions</h2>
        <ul class="faq__questions">
            <li class="faq__element">
                <p class="faq__question">How do I install it?</p>
                <p class="faq__answer">Click on the <a href="/#home">install button</a> for your OS, extract the downloaded archive and open the executable in it.</p>
            </li>
            <li class="faq__element">
                <p class="faq__question">How do I use it?</p>
                <p class="faq__answer">First create a new test by clicking on the green plus button near your root group. Then edit the newly added test to suit your needs. You can read more on the <a href="/documentation/quick-start">quick start</a> page in our documentation</p>
            </li>
            <li class="faq__element">
                <p class="faq__question">How is it different from postman?</p>
                <p class="faq__answer">It allows you to save files on your own pc as well as remotely or remotely on self-hosted file saving API, unlike postman which can only save remotely on their server</p>
                <p class="faq__answer">Weetee has the functionality to both import and export test suite to OpenAPI Swagger format, while postman can only import from it.</p>
                <p class="faq__answer">Additionally, Weetee is a desktop application written in C++ unlike postman that is electron based. While making it in C++ creates more risk for bugs it also makes it much faster.</p>
            </li>
        </ul>
    </div>
</section>
@endsection
