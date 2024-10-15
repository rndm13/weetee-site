@extends("master")

@section("title", "Home")

@section("content")

<section class="report-form" id="create-report">
    <canvas class="sine-background"></canvas>
    <div class="container">
        <form action="/account/report/{{$user->id}}" method="POST" class="form">
            @csrf

            <h3 class="form__title">Report User {{ $user->name }}</h3>

            <div class="form__group">
                <label for="reason">Reason</label>
                <textarea name="reason"></textarea>
                <p class="form__error">
                @error('reason')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <button class="form__submit" id="report-submit">Submit</button>
        </form>
    </div>
</section>

@endsection
