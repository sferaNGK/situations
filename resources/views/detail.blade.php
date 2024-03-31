@extends('layout.app')
@extends('layout.nuvbar')
@section('title')
Подробнее
@endsection
@section('content')
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
                                            <textarea type="text" name="text" class="form-control" placeholder="Ситуация" >{{ $question->text }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <textarea type="text" name="text_right" class="form-control" placeholder="Правильный ответ" >{{ $question->text_right }}</textarea>
                                        </div>

                                        <p>Введите три варианта ответа:</p>
                                        <div class="mb-3">
                                            <textarea type="text" name="answer_one" class="form-control" placeholder="Вариант ответа первый">{{ $question->answer_one }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <textarea type="text" name="answer_two" class="form-control" placeholder="Вариант ответа второй" >{{ $question->answer_two }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <textarea type="text" name="answer_three" class="form-control" placeholder="Вариант ответа третий" >{{ $question->answer_three }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Изменить</button>
                                    </form>
                                </div>

                            </div>
                            </div>
                        </div>
                </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
