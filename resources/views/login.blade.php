@extends("master")

@section("title", "Home")
@section("css", "/css/home.css")
@section("js", "/js/home.js")

@section("content")

<section class="login" id="login">
    <canvas class="line-background"></canvas>
    <div class="container login__container">
        <form action="/login" method="POST" class="form">
            <h3 class="form__title">Login</h3>

            <div class="form__group">
                <label for="name">Name</label>
                <input type="text" name="name">
                <p class="form__error"></p>
            </div>

            <div class="form__group">
                <label for="email">Email</label>
                <input type="email" name="email">
                <p class="form__error"></p>
            </div>

            <div class="form__group">
                <label for="password">Password</label>
                <input type="password" name="password">
                <p class="form__error"></p>
            </div>

            <button class="form__submit" id="login-submit">Login</button>

            <div class="login__links">
                <a class="link" href="/password_recovery">Forgot your password?</a>
                <a class="link" href="/register">Don't have an account? Register now.</a>
            </div>
        </form>
    </div>
</section>
