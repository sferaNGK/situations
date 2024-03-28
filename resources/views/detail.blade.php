@extends('layout.app')
@section('title')
Подробнее
@endsection
@section('content')
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('category') }}">Категории игр</a>
              </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin') }}">Создать ситуацию</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('situationPage') }}">Все ситуации</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('exit') }}">Выход</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <div class="shadow rounded p-4">
                <p class="card-title"><h5>Ситуация:</h5>{{$question->text}}</p>
                <p  class="card-text"><h5>Правильный ответ:</h5> {{$question->text_right}} </p>
                <p  class="card-text"><h5>Первый вариант ответа:</h5> {{$question->answer_one}} </p>
                <p  class="card-text"><h5>Второй вариант ответа:</h5> {{$question->answer_two}} </p>
                <p  class="card-text"><h5>Третий вариант ответа:</h5> {{$question->answer_three}} </p>
                <div class="d-flex justify-content-between col-4">
                    <div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $question->id }}">
                            Редактировать
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ $question->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Редактирование</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('questionUpdate' , ['question'=>$question]) }}" class="mt-3" method="post">
                                        @csrf
                                        @method('post')
                                        <div class="mb-3">
                                            <input type="text" name="text" class="form-control" placeholder="Ситуация" value="{{ $question->text }}">
                                        </div>

                                        <div class="mb-3">
                                            <input type="text" name="text_right" class="form-control" placeholder="Правильный ответ" value="{{ $question->text_right }}">
                                        </div>

                                        <p>Введите три варианта ответа:</p>
                                        <div class="mb-3">
                                            <input type="text" name="answer_one" class="form-control" placeholder="Вариант ответа первый" value="{{ $question->answer_one }}">
                                        </div>

                                        <div class="mb-3">
                                            <input type="text" name="answer_two" class="form-control" placeholder="Вариант ответа второй" value="{{ $question->answer_two }}">
                                        </div>

                                        <div class="mb-3">
                                            <input type="text" name="answer_three" class="form-control" placeholder="Вариант ответа третий" value="{{ $question->answer_three }}">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Изменить</button>
                                    </form>
                                </div>

                            </div>
                            </div>
                        </div>
                </div>
                <a href="{{ route('situationPage') }}" class="btn bg-body-secondary">Все ситуации <img src="{{ asset('public\icons8-выход-50.png') }}" style="width: 2vw" alt=""></a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
