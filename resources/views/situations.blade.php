@extends('layout.app')
@extends('layout.nuvbar')
@section('title')
Все ситуации
@endsection
@section('content')

  <div class="container">
    <div class="row">
        <div class="col-10">
            <div class="d-flex justify-content-between mt-4 col-5">


                 <h3>{{$category->title}}</h3>

                 <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Создать ситуацию +
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Создание ситуации</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('situation', ['id'=>$category->id]) }}" class="mt-3" method="post">
                                @csrf
                                @method('post')
                                <div class="mb-3">
                                    <textarea type="text" name="text" class="form-control @error('text') is-invalid @enderror" placeholder="Ситуация"></textarea>
                                    <div class="invalid-feedback">
                                       @error('text')
                                        {{ $message }}
                                       @enderror
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <textarea type="text" name="text_right" class="form-control @error('text_right') is-invalid @enderror" placeholder="Правильный ответ"></textarea>
                                    <div class="invalid-feedback">
                                        @error('text_right')
                                         {{ $message }}
                                        @enderror
                                     </div>
                                </div>


                                <h6 class="mb-3">Введите три варианта ответа:</h6>
                                <div class="mb-3">
                                    <textarea type="text" name="answer_one" class="form-control @error('answer_one') is-invalid @enderror" placeholder="Вариант ответа первый"></textarea>
                                    <div class="invalid-feedback">
                                        @error('answer_one')
                                         {{ $message }}
                                        @enderror
                                     </div>
                                </div>

                                <div class="mb-3">
                                    <textarea type="text" name="answer_two" class="form-control @error('answer_two') is-invalid @enderror" placeholder="Вариант ответа второй"></textarea>
                                    <div class="invalid-feedback">
                                        @error('answer_two')
                                         {{ $message }}
                                        @enderror
                                     </div>
                                </div>

                                <div class="mb-3">
                                    <textarea type="text" name="answer_three" class="form-control @error('answer_three') is-invalid @enderror" placeholder="Вариант ответа третий"></textarea>
                                    <div class="invalid-feedback">
                                        @error('answer_three')
                                         {{ $message }}
                                        @enderror
                                     </div>
                                </div>
                                <button type="submit" class="btn btn-dark">Сохранить</button>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid d-flex flex-wrap align-items-sm-start" style="margin: 0 auto">
                @foreach($questions as $question)

                        <div class="card m-3 pb-2">
                            <div class="card-body">
                                <p class="card-title col-12 text-truncate">{{$question->text}}</p>
                                <a href="{{ route('detail', ['id'=>$question->id]) }}" class="btn btn-outline-dark mt-2">Открыть</a>
                                 <!-- Button trigger modal -->
                                 <button type="button" class="btn btn-outline-danger mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal1{{ $question->id }}">
                                    Удалить
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal1{{ $question->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Вы точно хотите удалить ситуацию?</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                        <a href="{{ route('questionDelete', ['question'=>$question]) }}" class="btn btn-danger" >Удалить</a>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                @endforeach
            </div>

        </div>
    </div>
  </div>
  @endsection
