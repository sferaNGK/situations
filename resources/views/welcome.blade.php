@extends('layout.app')
@section('title')
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">

            <div class="shadow rounded mt-5 col-7">
                 <h3 class="p-2" style="text-align: center">Авторизация</h3>

                 @if (session()->has('error'))
                 <div class="alert alert-danger">
                     {{ session('error') }}
                 </div>

                 @endif
            <div class="p-4">
                <form action="{{ route('auth') }}" method="post">
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
                    <div>
                        <button type="submit" class="btn btn-primary">Авторизоваться</button>
                        <a href="{{ route('regPage') }}" class="p-2">Еще не зарегистрированы?</a>
                    </div>

                </form>
            </div>
            </div>

        </div>
    </div>
</div>
@endsection
