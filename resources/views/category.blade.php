@extends('layout.app')
@section('title')
Категории
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
        <div class="col-7">
            @if (session()->has('ok'))
            <div class="alert alert-success mt-2">
                {{ session('ok') }}
            </div>
            @endif
            <div class="shadow rounded p-3 mt-4">
                 <h3>Создать категорию</h3>
            <form action="{{ route('categorySave') }}" class="mt-3" method="post">
                @csrf
                @method('post')
                <div class="mb-3">
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Название">
                    <div class="invalid-feedback">
                        @error('title')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-dark">Сохранить</button>
            </form>
            </div>
            <h3 class="mt-5">Все категории</h3>
            <div class="container-fluid d-flex flex-wrap align-items-sm-start" style="margin: 0 auto">
                @foreach($categories as $category)
                        <div class="card m-3 pb-2" >
                            <div class="card-body">
                                <h5 class="card-title">{{$category->title}}</h5>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $category->id }}">
                                    Редактировать
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $category->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Редактиорвание</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('categoryUpdate', ['category'=>$category]) }}" class="mt-3" method="post">
                                                @csrf
                                                @method('post')
                                                <div class="mb-3">
                                                    <input type="text" name="title" class="form-control" placeholder="Название" value="{{ $category->title }}">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Изменить</button>
                                            </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                               <a href="{{ route('categoryDelete', ['category'=>$category]) }}" class="btn btn-outline-danger">Удалить</a>
                            </div>
                        </div>

                @endforeach
            </div>

        </div>
    </div>
</div>
@endsection

