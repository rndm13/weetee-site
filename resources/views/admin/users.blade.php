@extends('admin.dashboard')

@section('title', 'Users')

@section('content')
<section class="admin-index">
    <div class="container">
        <h3 class="admin-index__title">Users</h3>

        <div class="collection-users">
            <ul class="collection-users__list">
                @foreach ($users as $user)
                    <div class="collection__list-item collection-users__list-item">
	                    <a class="collection-users__field link" href="/user/view/{{$user->id}}">{{ $user->name }}</a>
	                    <p class="collection-users__field">{{ ucfirst($user->role) }}</p>
	                    <p class="collection-users__field">{{ $user->email }}</p>
                        <p class="collection-users__field--secondary">@date($user->created_at)</p>

                        <div class="collection__actions collection-users__actions">
                            <form action="/user/delete/{{ $user->id }}" method="user">
                                @csrf
                                <button class="action--delete"> <img src={{ Vite::image("cross.svg") }} /></button>
                            </form>
                            <button class="action--edit"><img src={{ Vite::image("edit.svg") }} /></button>
                        </div>
                    </div>

                    <form action="/account/edit/{{$user->id}}" method="POST" class="collection__form--edit collection-users__form--edit">
                        @csrf

                        <input type="text" class="form__input--hidden" value="{{$user->name}}" name="name">
	                    <a class="collection-users__field link" href="/user/view/{{$user->id}}">{{ $user->name }}</a>

                        <div class="form__group">
                            <select class="form__select2" name="role">
                                <option value="user"> User </option>
                                <option value="admin"> Admin </option>
                                <option value="moderator"> Moderator </option>
                            </select>

                            <p class="form__error--hide">
                            @error('role')
                                {{ $message }}
                            @enderror
                            </p>
                        </div>

                        <input type="text" class="form__input--hidden" value="{{$user->email}}" name="email">
	                    <p class="collection-users__field">{{ $user->email }}</p>

                        <p class="collection-users__field--secondary">@date($user->created_at)</p>

                        <div class="collection__actions collection-users__actions">
                            <button class="form__submit">Save</button>
	                        <button type="button" class="action--edit"> <img src={{ Vite::image("edit.svg") }} /> </button>
                        </div>
                    </form>

                    <hr class="collection-users__separator"/>
                @endforeach
            </ul>
            <div class="pagination">
                <a @class([
                    "pagination__button",
                    "pagination__button--inactive" => $users->onFirstPage(),
                ]) href={{ $users->previousPageUrl() }}>
                    <img src={{ Vite::image('previous.svg') }} alt="Previous">
                </a>
                <p class="pagination__page"> {{ $users->currentPage() }} / {{ $users->lastPage() }} </p>
                <a @class([
                    "pagination__button",
                    "pagination__button--inactive" => $users->onLastPage(),
                ]) href={{ $users->nextPageUrl() }}>
                    <img src={{ Vite::image('next.svg') }} alt="Next">
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
