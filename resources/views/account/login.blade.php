@extends("master")

@section("title", "Login")

@section("content")

<section class="login" id="login">
    <canvas class="line-background"></canvas>
    <div class="container">
        <form action="/login" method="POST" class="form">
            @csrf

            <h3 class="form__title">Login</h3>

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
                @error('email')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <button class="form__submit" id="login-submit">Login</button>

            <div class="login__links">
                <a class="link" href="/password_recovery">Forgot your password?</a>
                <a class="link" href="/register">Don't have an account? Register now.</a>
            </div>
        </form>
    </div>
</section>

@endsection
