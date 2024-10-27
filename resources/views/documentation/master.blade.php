<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield("title") - Weetee Admin</title>

    @vite(['resources/css/app.scss'])
    @vite(['resources/js/app.js'])
</head>
<body>
    <header class="header">
        <div class="container">
            <nav class="header__nav">
                <button class="menu-side__button menu-button" data-menu-id="menu-side">
                    <img src={{ Vite::asset('resources/imgs/menu.svg') }} alt="Menu">
                </button>

                <a href="/" class="logo"><h1>Weetee</h1></a>

                <div class="auth-nav">
                    <div class="user">
                        <a class="user__name link" href="/profile/{{ Auth::id() }}">{{ Auth::user()->name }}</a>
                        <a href="/logout" class="link">Logout</a>
                    </div>
                </div>
            </nav>
        </div>

        <div class="menu-side" id="menu-side">
            <div class="container">
                @foreach ($doc_list as $doc_link)
                    <a href="/documentation/{{$doc_link->slug}}" class="link">{{$doc_link->title}}</a>
                @endforeach
            </div>
        </div>
    </header>

    <main class="body">
        @yield("content")
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer__top-line">
                <a href="/" class="logo">Weetee</a>
                <p>Weetee - all rights reserved.</p>
            </div>
	        <nav class="footer__nav">
	            <div class="footer__links">
	                <a href="/" class="link">Home</a>
	                <a href="/#about" class="link">About</a>
	                <a href="/#faq" class="link">Frequently Asked Questions</a>
                    <a href="/documentation" class="link">Documentation</a>
	                <a href="/forum" class="link">Forum</a>
	            </div>
	            <div class="footer__links">
                    <a href="tel:+380123456789" class="link">+380 (12) 345 6789</a>
                    <a href="mailto:admin@gmail.com" class="link">admin@gmail.com</a>
                </div>
	        </nav>
        </div>
    </footer>
</body>
</html>
