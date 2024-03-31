@extends('layout.app')
@extends('layout.nuvbar')
@section('title')
Создать ситуацию
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-7">
            @if (session()->has('ok'))
            <div class="alert alert-success mt-2">
                {{ session('ok') }}
            </div>
            @endif
            <div class="shadow rounded p-3 mt-4">
                 <h3>Создать ситуацию</h3>
            <form action="{{ route('situation') }}" class="mt-3" method="post">
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

                <div class="mb-3">
                    <select class="form-select @error('text') is-invalid @enderror" name="category">
                    <option selected>Выберите категорию игры</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    @error('text')
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
@endsection

