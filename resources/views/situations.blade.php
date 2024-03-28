@extends('layout.app')
@section('title')
Все ситуации
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

  <div class="container">
    <div class="row">
        <div class="col-12">
            <div class="container-fluid d-flex flex-wrap align-items-sm-start" style="margin: 0 auto">
                @foreach($questions as $question)
                        <div class="card m-3 pb-2" >
                            <div class="card-body">
                                <p class="card-title">{{$question->text}}</p>
                                <h6  class="card-title">Категория: {{$question->category->title}}</h6>
                               <a  href="{{ route('detail', ['id'=>$question->id]) }}" class="btn btn-outline-dark mt-2">Открыть</a>
                               <a href="{{ route('questionDelete', ['question'=>$question]) }}" class="btn btn-outline-danger mt-2">Удалить</a>
                            </div>
                        </div>

                @endforeach
            </div>
        </div>
    </div>
  </div>
  @endsection
