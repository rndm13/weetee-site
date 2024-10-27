@extends('admin.dashboard')

@section('title', 'Reports')

@section('content')
<section class="report-details">
    <div class="container">
        <div class="report-details__header">
            <h3 class="report-details__title">Report {{$report->status}}</h3>
            <a class="link" href="/profile/{{$report->on_user->id}}"> On user {{ $report->on_user->name }} </a>
            <a class="link" href="/profile/{{$report->from_user->id}}"> From user {{ $report->from_user->name }} </a>
            <p class="report-details__date">{{ $report->created_at }}</p>
        </div>

        <p class="report-details__reason">
            {!! nl2br(e($report->reason)) !!}
        </p>

        <div class="report-details__buttons">
            <form action="/account/ban/{{$report->on_user->id}}" method="POST">
                @csrf
                <button class="form__submit">Ban reported user</button>
            </form>
            <form action="/admin/report/resolve/{{$report->id}}" method="POST">
                @csrf
                <button class="form__submit">Mark as resolved</button>
            </form
        </div>

        <form action="/admin/report/reply/{{$report->id}}" method="POST" class="form">
            @csrf

            <p class="form__title">Reply to report</p>

            <div class="form__group">
                <label for="form__input">Reply</label>
                <textarea name="reply" class="form__input"></textarea>
                <p class="form__error">
                @error('reply')
                    {{ $message }}
                @enderror
                </p>
            </div>

            <button class="form__submit"> Reply </button>
        </form>
    </div>
</section>
@endsection
