@extends('layouts.app')
@section('content')
    <header class="header">
        <div class="container">
            <div class="header_wrapper">
                @if(Auth::guest())
                    <a href="{{ url('/login') }}" class="link">Войти</a>
                    <a href="{{ url('/register') }}" class="link">Регистрация</a>
                @else
                    <a href="{{ url('/logout') }}" class="link">Выйти</a>
                @endif
            </div>
        </div>
    </header>
    <div class="wrapper">
        <div class="container">
            <div class="upload">
                @if(!Auth::guest())
                    <h1>Загрузить чек</h1>
                    <div class="check">
                        <div class="check_wrapper">
                            <form method="post" action="{{ url('/check-upload') }}" enctype="multipart/form-data"
                                  class="check_form">
                                @csrf
                                <check-upload/>
                            </form>
                        </div>
                        @if(session('success'))
                            <script>
                                alert("{{ session('success') }}");
                            </script>
                        @endif
                    </div>
                @else
                    <h1>Зарегистрируйтесь чтобы загрузить чек</h1>
                @endif
            </div>
            <div class="table">
                <h2>Таблица чеков</h2>
                <div class="table_head">
{{--                    <div>Имя</div>--}}
{{--                    <div>--}}
{{--                        Фото--}}
{{--                    </div>--}}
{{--                    <div>Тип</div>--}}
{{--                    <div>Дата</div>--}}
{{--                   <div>Статус</div> --}}
                </div>
                @foreach($checks as $check)

                    <div class="table_row">
                        <div> {{ $check->user_name }}</div>
                        <a href="{{ asset('storage/checks/' . $check->image) }}" target="_blank">Фото чека</a>
                        <div> @if($check->status == 1)
                                Призовой
                            @else
                                Обычный
                            @endif</div>
                        <div>{{ $check->date }}</div>
                        @if(\Carbon\Carbon::parse($check->date)->isSameWeek(\Carbon\Carbon::now()) && $check->code !== null)
                            <div>Ваш код: {{ $check->code }}</div>
                        @elseif(!\Carbon\Carbon::parse($check->date)->isSameWeek(\Carbon\Carbon::now()))
                            <div>Не учавствует на этой неделе</div>
                            @else
                            --
                        @endif

                    </div>

                @endforeach
                <div class="nav">
                    {{ $checks->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection

