@extends('layout.app')
@extends('layout.nuvbar')
@section('title')
Создание ситуации
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">

            @if (session()->has('ok'))
            <div class="alert alert-success mt-2">
                {{ session('ok') }}
            </div>
            @endif

            <div class="shadow rounded mt-3">
                <h3 style="margin-left:40px; margin-bottom:-15px" class="pt-4">Создание ситуации</h3>
                <form action="{{ route('situation', ['category' => $category->id]) }}" class="p-5" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')


                    <div class="question">
                        <select class="form-select mb-3" name="type" id="questionType">
                            <option>Текст</option>
                            <option>Текст + Изображение</option>
                            <option>Текст + Аудио</option>
                            <option>Текст + Видео</option>
                        </select>


                        <div class="mb-3">
                            <textarea  class="form-control @error('text') is-invalid @enderror" style="display: block" id="question_textarea" name="text"></textarea>
                        </div>
                        <input type="file" name="file" class="form-control  @error('file') is-invalid @enderror" style="display: none" id="question_input">
                        <div class="invalid-feedback">
                            @error('text')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>


                    <h3  class="pt-3">Добавление ответов</h3>

                    @for ($i=0; $i < 4; $i++)
                        <div class="row">
                            <div class="col-2 d-flex justify-content-center align-items-center">
                                <label class="d-flex justify-content-between">
                                   <div> {{ $i + 1 }} </div><input type="radio"  style=" transform: scale(1.7);
                                    margin-left:15px;margin-top:5px" class="@error('right') is-invalid @enderror" name="right" value="{{ $i }}">

                                <div class="p-3 invalid-feedback">
                                    @error('right')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </label>
                            </div>
                            <div class="col-10 mb-4">
                                {{-- <select class="form-select mt-4" name="answer_type[{{ $i }}]" onchange="changeTypeAnswer(this.value, {{ $i }})">
                                    <option>Текст</option>
                                    <option>Изображение</option>
                                    <option>Аудио</option>
                                    <option>Видео</option>
                                </select> --}}
                                <div class="mt-2">
                                    <textarea type="text" placeholder="Введите ответ" class="form-control @error('answer_text.' . $i) is-invalid @enderror" id="answer_area_{{ $i }}" name="answer_text[{{ $i }}]"></textarea>
                                    {{-- <input type="file" style="display: none" class="form-control @error('answer_file.' . $i) is-invalid @enderror" name="answer_file[{{ $i }}]" id="answer_input_{{ $i }}">
                                    <div class="invalid-feedback">
                                        @error('answer_text.' . $i)
                                        {{ $message }}
                                        @enderror
                                    </div> --}}

                                </div>
                            </div>
                        </div>
                    @endfor

                    <div class="mb-4">
                        <h6 for="explain"> Введите объяснение:</h6>
                        <select name="explain_type" class="form-select mt-2 mb-2" id="answer_type">
                            <option>Текст</option>
                            <option>Изображение</option>
                            <option>Аудио</option>
                            <option>Видео</option>
                        </select>
                        <textarea type="text" name="explain" id="explain" class="form-control @error('explain') is-invalid @enderror" placeholder="Объяснение"></textarea>
                        <input type="file" name="explain_file" class="form-control  @error('file') is-invalid @enderror" style="display: none" id="answer_input">
                        <div class="invalid-feedback">
                            @error('explain')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 for="help"> Введите подсказку:</h6>
                        <select name="help_type" class="form-select mt-2 mb-2" id="help_type">
                            <option>Текст</option>
                            <option>Изображение</option>
                            <option>Аудио</option>
                            <option>Видео</option>
                        </select>
                        <textarea type="text" name="help" id="help" class="form-control @error('help') is-invalid @enderror" placeholder="Подсказка"></textarea>
                        <input type="file" name="help_file" class="form-control  @error('file') is-invalid @enderror" style="display: none" id="help_input">
                        <div class="invalid-feedback">
                            @error('help')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <button  type="submit" class="btn btn-dark">Сохранить</button>
                </form>
            </div>
        </div>
        </div>
    </div>
</div>
<script>

const questionType = document.querySelector('#questionType');

questionType.addEventListener('change', (event) => {
    const question_input =  document.querySelector('#question_input');
    if(event.target.value !== 'Текст'){
        question_input.style.display = 'block';
    }else{
        question_input.style.display = 'none';
    }
});

document.querySelector('#answer_type').addEventListener('change', (event) =>{
    const answer_input = document.querySelector('#answer_input');
    const answer_area = document.querySelector('#explain');
    if(event.target.value !== 'Текст'){
        answer_input.style.display = 'block';
        answer_area.style.display = 'none';
    }else{
        answer_input.style.display = 'none';
        answer_area.style.display = 'block';
    }
});

document.querySelector('#help_type').addEventListener('change', (event) =>{
    const help_input = document.querySelector('#help');
    const help_area = document.querySelector('#help_input');
    if(event.target.value !== 'Текст'){
        help_area.style.display = 'block';
        help_input.style.display = 'none';
    }else{
        help_area.style.display = 'none';
        help_input.style.display = 'block';
    }
});

</script>
@endsection
