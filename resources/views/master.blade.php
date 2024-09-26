<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield("title") - Weetee</title>

    @vite(['resources/css/app.scss'])
    @vite(['resources/js/app.js'])
</head>
<body>
    <header class="header">
        <a href="/" class="logo"><h1>Weetee</h1></a>
        <nav class="header__nav">
            <a href="/" class="link">Home</a>
            <a href="/#about" class="link">About</a>
            <a href="/#faq" class="link">FAQ</a>
            <a href="/documentation" class="link">Documentation</a>
            <a href="/forum" class="link">Forum</a>
        </nav>

        <div class="menu">
            <button class="menu__button">
                <img src={{ Vite::asset('resources/imgs/menu.svg') }} alt="Menu">
            </button>

            <div class="menu__hidden">
                <div class="container">
                    <a href="/" class="link">Home</a>
                    <a href="/#about" class="link">About</a>
                    <a href="/#faq" class="link">FAQ</a>
                    <a href="/documentation" class="link">Documentation</a>
                    <a href="/forum" class="link">Forum</a>
                </div>
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
