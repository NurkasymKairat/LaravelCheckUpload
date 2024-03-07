@extends('layouts.app')
@section('content')
    <div class="register_page">
        <div class="register_wrapper">
            <h1>Войти</h1>
            <div class="register_form">
                <form method="post" action="/login-create">
                    @csrf
                    <div class="form-group">
                        <input placeholder="Email" type="email" name="email" value="{{ old('email') }}">
                        @error('email', 'login')
                        <span class="error-text">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input placeholder="Пароль" type="password" name="password" required autocomplete="current-password">
                        @error('password', 'login')
                        <span class="error-text">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit">
                            Войти
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
