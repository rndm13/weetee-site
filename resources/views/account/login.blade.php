@extends("master")

@section("title", "Login")

@section("content")

<section class="login" id="login">
    <canvas class="line-background"></canvas>
    <div class="container">
        <form action="/login" method="POST" class="form">
            @csrf

            <h3 class="form__title">@lang('forms.login')</h3>

            <div class="form__group">
                <label for="email">@lang('forms.email')</label>
                <input class="form__input" type="email" name="email">
                <p class="form__error">
                @error('email')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <div class="form__group">
                <label for="password">@lang('forms.password')</label>
                <input class="form__input" type="password" name="password">
                <p class="form__error">
                @error('email')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <button class="form__submit" id="login-submit">@lang('forms.login')</button>

            <div class="login__auth">
                <a class="button--auth-google" href="/auth/google/redirect">
                    <img src={{ Vite::image('google.png') }} alt="Google">
                    @lang('forms.login_with_google')
                </a>
            </div>

            <div class="login__links">
                <a class="link" href="/register">@lang('forms.register_link')</a>
            </div>
        </form>
    </div>
</section>

@endsection
