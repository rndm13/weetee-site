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
        <div class="container">
            <nav class="header__nav">
                <a href="/" class="logo"><h1>Weetee</h1></a>
                <a href="/" class="link">@lang('header.home')</a>
                <a href="/#about" class="link">@lang('header.about')</a>
                <a href="/#faq" class="link">@lang('header.faq')</a>
                <a href="/documentation" class="link">@lang('header.documentation')</a>
                <a href="/forum" class="link">@lang('header.forum')</a>
                @can('admin-dashboard')
                    <a href="/admin" class="link">@lang('header.admin')</a>
                @endcan

                <div class="auth-nav">
                    <a href="/locale/en" class="link">EN</a>
                    <a href="/locale/uk" class="link">UK</a>
                    @if (!Auth::check())
                        <a href="/login" class="link">@lang('header.login')</a>
                        <a href="/register" class="link">@lang('header.register')</a>
                    @else
                        <div class="user">
                            <a class="user__name link" href="/profile/{{ Auth::id() }}">{{ Auth::user()->name }}</a>
                            <a href="/logout" class="link">@lang('header.logout')</a>
                        </div>
                    @endif
                </div>

                <button class="menu__button menu-button" data-menu-id="menu">
                    <img src={{ Vite::asset('resources/imgs/menu.svg') }} alt="Menu">
                </button>
            </nav>
        </div>

        <div class="menu" id="menu">
            <div class="container">
                @if (!Auth::check())
                    <a href="/login" class="link">@lang('header.login')</a>
                    <a href="/register" class="link">@lang('header.register')</a>
                @else
                    <div class="user">
                        <a class="user__name link" href="/profile/{{ Auth::id() }}">{{ Auth::user()->name }}</a>
                        <a href="/logout" class="link">@lang('header.logout')</a>
                    </div>
                    <hr class="menu__separator"/>
                @endif

                @can('admin-dashboard')
                    <a href="/admin" class="link">@lang('header.admin')</a>
                @endcan

                <a href="/" class="link">@lang('header.home')</a>
                <a href="/#about" class="link">@lang('header.about')</a>
                <a href="/#faq" class="link">@lang('header.faq')</a>
                <a href="/documentation" class="link">@lang('header.documentation')</a>
                <a href="/forum" class="link">@lang('header.forum')</a>
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
                <p>@lang('footer.rights_reserved')</p>
            </div>
	        <nav class="footer__nav">
	            <div class="footer__links">
                    <a href="/" class="link">@lang('header.home')</a>
                    <a href="/#about" class="link">@lang('header.about')</a>
                    <a href="/#faq" class="link">@lang('header.faq')</a>
                    <a href="/documentation" class="link">@lang('header.documentation')</a>
                    <a href="/forum" class="link">@lang('header.forum')</a>
	            </div>
	        </nav>
        </div>
    </footer>
</body>
</html>
