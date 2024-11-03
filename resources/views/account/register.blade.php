@extends("master")

@section("title", "Register")

@section("content")

<section class="register" id="register">
    <canvas class="line-background"></canvas>
    <div class="container">
        <form action="/register" method="POST" class="form">
            @csrf
            <h3 class="form__title">@lang('forms.register')</h3>

            <div class="form__group">
                <label for="name">@lang('forms.name')</label>
                <input class="form__input" type="text" name="name">
                <p class="form__error">
                @error('name')
                    {{ $message }}
                @enderror
                </p>
            </div>

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
                @error('password')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <div class="form__group">
                <label for="confirm_password">@lang('forms.confirm_password')</label>
                <input class="form__input" type="password" name="confirm_password">
                <p class="form__error">
                @error('confirm_password')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <button class="form__submit" id="register-submit">@lang('forms.register')</button>

            <div class="register__auth">
                <a class="button--auth-google" href="/auth/google/redirect">
                    <img src={{ Vite::image('google.png') }} alt="Google">
                    @lang('forms.login_with_google')
                </a>
            </div>

            <div class="register__links">
                <a class="link" href="/login">@lang('forms.login_link')</a>
            </div>
        </form>
    </div>
</section>

@endsection
