@extends('layouts.app')
@section('content')
    <div class="register_page">
        <div class="register_wrapper">
            <h1>Регистрация</h1>
            <div class="register_form">
                <form method="post" action="{{ url('/register-create') }}">
                    @csrf
                    <div class="form-group">
                        <input placeholder="Имя" type="text" name="name">
                        @error('name', 'registration')
                        <span class="error-text">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input placeholder="Email" type="email" name="email" value="{{ old('email') }}">
                        @error('email', 'registration')
                        <span class="error-text">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input placeholder="Пароль" type="password" name="password">
                        @error('password', 'registration')
                        <span class="error-text">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit">
                            Зарегистрироваться
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
