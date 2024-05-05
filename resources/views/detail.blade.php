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
                @if($question->file)
                    <img src="{{ asset($question->file) }}" class="w-25" alt="">
                @endif
                <p><h5>Ответы:</h5></p>
                @foreach ( $question->answers as $key=>$answer )
                <div class="d-flex">
                    <p>{{ $key + 1 }}</p>
                     <p style="margin-left:10px" class="mb-3">{{ $answer->answer_text }}</p>
                     @if($answer->answer_file)
                     @php
                     $extension = strtolower(pathinfo($answer->answer_file, PATHINFO_EXTENSION));
                     @endphp

                     @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
                         <img src="{{ asset($answer->answer_file) }}" style="margin-left:10px" class="col-2 mb-3" alt="Ответ">
                     @elseif(in_array($extension, ['mp3', 'wav', 'ogg']))

                         <audio controls class="mb-3">
                             <source src="{{ asset($answer->answer_file) }}" type="audio/mpeg">
                             Ваш браузер не поддерживает аудио элемент.
                         </audio>
                         @elseif(in_array($extension, ['mp4', 'webm', 'ogg']))
                        <video controls style="max-width: 30%; max-height: 400px;" class="mb-3">
                            <source src="{{ asset($answer->answer_file) }}"   type="video/{{ $extension }}">
                            Ваш браузер не поддерживает видео элемент.
                        </video>
                     @else
                         <p>Формат файла не поддерживается</p>
                     @endif

                    @endif

                    @if ($answer->right === '1')
                    <p style="margin-left:10px">(правильный ответ)</p>
                    @endif


                    </div>
                @endforeach

                <h5>Объяснение:</h5>
                <p>{{ $answer->explain }}</p>
                <h5>Подсказка:</h5>
                <p>{{ $answer->help }}</p>

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
                                    <form action="{{ route('questionUpdate' , ['question'=>$question, 'answer'=>$answer]) }}" class="mt-3" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('post')

                                        <div class="question">
                                            <select class="form-select mb-3" name="type" id="questionType">
                                                <option>Текст</option>
                                                <option>Изображение</option>
                                                <option>Аудио</option>
                                                <option>Видео</option>
                                            </select>


                                            <div class="mb-3">
                                                <textarea  class="form-control @error('question_text') is-invalid @enderror" style="display: block" id="question_textarea" name="text">{{ $question->text }}</textarea>
                                            </div>
                                            <input type="file" name="file" class="form-control  @error('question_file') is-invalid @enderror" style="display: none" id="question_input">
                                            <div class="invalid-feedback">
                                                @error('question_text')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        @for ($i=0; $i < 4; $i++)

                                        <input type="hidden" name="id[{{ $i }}]" value="{{ $answers[$i]->id }}">

                                            <div class="row">
                                                <div class="col-2 d-flex justify-content-center align-items-center">
                                                    <label class="d-flex justify-content-between">
                                                       <div> {{ $i + 1 }}) </div><input type="radio"   style=" transform: scale(1.7);
                                                        margin-left:15px;margin-top:5px" class="@error('right') is-invalid @enderror" name="right" value="{{ $i }}">

                                                    <div class="p-3 invalid-feedback">
                                                        @error('right')
                                                        {{ $message }}
                                                        @enderror
                                                    </div>
                                                </label>
                                                </div>
                                                <div class="col-10">
                                                    <select class="form-select mt-4" name="answer_type[{{ $i }}]" onchange="changeTypeAnswer(this.value, {{ $i }})">
                                                        <option>Текст</option>
                                                        <option>Изображение</option>
                                                        <option>Аудио</option>
                                                        <option>Видео</option>
                                                    </select>

                                                    <div class="mt-2">
                                                        <textarea type="text" style="display: block" class="form-control @error('answer_text.' . $i)
                                                        is-invalid @enderror" id="answer_area_{{ $i }}" name="answer_text[{{ $i }}]">{{ $answers[$i]->answer_text }}</textarea>
                                                        <input type="file" style="display: none" class="form-control @error('answer_file.' . $i)
                                                        is-invalid @enderror" name="answer_file[{{ $i }}]" id="answer_input_{{ $i }}">
                                                        <div class="invalid-feedback">
                                                            @error('answer_text.' . $i)
                                                            {{ $message }}
                                                            @enderror
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        @endfor

                                        <div class="mb-4">
                                            <h6 for="explain"> Введите объяснение:</h6>
                                            <textarea type="text" name="explain" id="explain" class="form-control @error('explain') is-invalid @enderror" placeholder="Пояснение">{{$answer->explain}}</textarea>
                                            <div class="invalid-feedback">
                                            @error('explain')
                                            {{ $message }}
                                            @enderror
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <h6 for="help"> Введите подсказку:</h6>
                                            <textarea type="text" name="help" id="help" class="form-control @error('help') is-invalid @enderror" placeholder="Подсказка">{{$answer->help}}</textarea>
                                            <div class="invalid-feedback">
                                            @error('help')
                                            {{ $message }}
                                            @enderror
                                            </div>
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
<script>
    const questionType = document.querySelector('#questionType');
    questionType.addEventListener('change', (event) => {
        const question_textarea =  document.querySelector('#question_textarea');
        const question_input =  document.querySelector('#question_input');
        if(event.target.value !== 'Текст'){
            question_textarea.style.display = 'none';
            question_input.style.display = 'block';
        }else{
            question_textarea.style.display = 'block';
            question_input.style.display = 'none';
        }
    });
        function changeTypeAnswer(el, id){
            console.log(el, id);
            const answer_area = document.querySelector(`#answer_area_${id}`);
            const answer_input = document.querySelector(`#answer_input_${id}`);
            if(el !== 'Текст'){
                answer_area.style.display = 'none';
                answer_input.style.display = 'block';
            } else {
                answer_area.style.display = 'block';
                answer_input.style.display = 'none';
            }
        }
    </script>
@endsection
