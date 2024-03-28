@extends('layout.app')
@section('title')
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">

            <div class="shadow rounded mt-5 col-7">
                 <h3 class="p-2" style="text-align: center">Регистрация</h3>

            <div class="p-4">
                <form action="{{ route('reg') }}" method="post">
                    @csrf
                    @method('post')
                    <div class="mb-3">
                        <input type="text" class="form-control @error('login') is-invalid @enderror" placeholder="Логин" name="login">
                        <div class="invalid-feedback">
                            @error('login')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Пароль" name="password">
                        <div class="invalid-feedback">
                            @error('password')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Повторите пароль" name="password_confirmation">
                        <div class="invalid-feedback">
                            @error('password_confirmation')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <input type="checkbox" id="rule" name="rule" class="form-check-input @error('rule') is-invalid @enderror" >
                        <label for="rule">Согласие на обработку ПД</label>
                        <div class="invalid-feedback">
                            @error('rule')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                </form>
            </div>
            </div>

        </div>
    </div>
</div>
@endsection
