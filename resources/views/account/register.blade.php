@extends("master")

@section("title", "Register")

@section("content")

<section class="register" id="register">
    <canvas class="line-background"></canvas>
    <div class="container">
        <form action="/register" method="POST" class="form">
            @csrf

            <h3 class="form__title">Register</h3>

            <div class="form__group">
                <label for="name">Name</label>
                <input type="text" name="name">
                <p class="form__error">
                @error('name')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <div class="form__group">
                <label for="email">Email</label>
                <input type="email" name="email">
                <p class="form__error">
                @error('email')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <div class="form__group">
                <label for="password">Password</label>
                <input type="password" name="password">
                <p class="form__error">
                @error('password')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <div class="form__group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password">
                <p class="form__error">
                @error('confirm_password')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <button class="form__submit" id="register-submit">Register</button>

            <div class="register__auth">
                <a class="button--auth-google" href="/auth/google/redirect">
                    <img src={{ Vite::image('google.png') }} alt="Google">
                    Login with Google
                </a>
            </div>

            <div class="register__links">
                <a class="link" href="/login">Already have an account? Login now.</a>
            </div>
        </form>
    </div>
</section>

@endsection
