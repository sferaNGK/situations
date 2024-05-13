@extends('layout.app')
@section('title')
Все ситуации
@endsection
@section('content')

  <div class="container-fluid" id="Situation">

    <div class="container d-flex justify-content-start gap-5 mt-4 col-12">
        <h3>@{{ title }}</h3>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalAddSit">
            Создать ситуацию +
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModalAddSit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form @submit.prevent="AddSituation" id="form_add">
                    <div class="modal-body">

                        {{-- Question --}}
                        <h5 class="mb-2">Вопрос:</h5>
                        <div class="mb-3">
                            <label for="">Выберите тип:</label>
                            <select class="form-control" id="editselector" name="type" v-model="selectTypeAdd">
                                <option value="Текст" >Текст</option>
                                <option value="Текст + Изображение">Текст + Изображение</option>
                                <option value="Текст + Видео">Текст + Видео</option>
                                <option value="Текст + Аудио">Текст + Аудио</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Введите текст:</label>
                            <textarea class="form-control" name="text" placeholder="Описание" cols="30" rows="10"></textarea>
                        </div>
                        <div class="mb-3" v-if="selectTypeAdd != 'Текст'">
                            <label for="">Файл:</label>
                            <input type="file" name="file" class="form-control">
                        </div>

                        {{-- Answer --}}

                        <h5 class="mb-2">Ответы:</h5>

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
                                    <div class="mt-2">
                                        <textarea type="text" placeholder="Введите ответ" class="form-control @error('answer_text.' . $i) is-invalid @enderror" id="answer_area_{{ $i }}" name="answer_text[{{ $i }}]"></textarea>
                                    </div>
                                </div>
                            </div>
                         @endfor

                         <div class="mb-4">
                            <h6 for="explain"> Введите объяснение:</h6>
                            <select name="explain_type" class="form-select mt-2 mb-2" v-model="ExplainSelector" id="answer_type">
                                <option value="Текст">Текст</option>
                                <option value="Изображение">Изображение</option>
                                <option value="Аудио">Аудио</option>
                                <option value="Видео">Видео</option>
                            </select>
                            <textarea type="text" v-if="ExplainSelector == 'Текст'" name="explain" id="explain" class="form-control @error('explain') is-invalid @enderror" placeholder="Объяснение"></textarea>
                            <input type="file" v-if="ExplainSelector != 'Текст'" name="explain_file" class="form-control  @error('file') is-invalid @enderror" id="answer_input">
                        </div>

                        <div class="mb-4">
                            <h6 for="help"> Введите подсказку:</h6>
                            <select name="help_type" class="form-select mt-2 mb-2" v-model="HelpSelector" id="help_type">
                                <option value="Текст">Текст</option>
                                <option value="Изображение">Изображение</option>
                                <option value="Аудио">Аудио</option>
                                <option value="Видео">Видео</option>
                            </select>
                            <textarea type="text" v-if="HelpSelector == 'Текст'" name="help" id="help" class="form-control @error('help') is-invalid @enderror" placeholder="Подсказка"></textarea>
                            <input type="file" v-if="HelpSelector != 'Текст'" name="help_file" class="form-control  @error('file') is-invalid @enderror" id="help_input">
                        </div>

                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
   </div>

    <div class="container-fluid d-flex flex-wrap align-items-sm-start mt-3">
        <div class="card m-3 pb-2" style="width: 25rem;" v-for="question in questions">
            <div class="card-body">
                <div class="w-75" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                    @{{question.text}}
                </div>
                <a @click="DetailPage(question.id)" class="btn btn-outline-dark">Подробнее</a>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" :data-bs-target="`#exampleModal${question.id}`">
                    Редактировать
                </button>

                <!-- Modal -->
                <div class="modal fade" :id="`exampleModal${question.id}`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Редактирование</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="EditSituation(question.id)"  class="mt-3" :id="`form_edit${question.id}`">
                                <div class="mb-3">
                                    <label for="">Выберите тип:</label>
                                    <select class="form-control" id="editselector" name="type" v-model="selectTypeEdit">
                                        <option :value="question.type" selected>@{{ question.type }}</option>
                                        <option value="Текст" v-if="question.type != 'Текст'">Текст</option>
                                        <option value="Текст + Изображение" v-if="question.type != 'Текст + Изображение'">Текст + Изображение</option>
                                        <option value="Текст + Видео" v-if="question.type != 'Текст + Видео'">Текст + Видео</option>
                                        <option value="Текст + Аудио" v-if="question.type != 'Текст + Аудио'">Текст + Аудио</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="">Введите текст:</label>
                                    <textarea class="form-control" name="text" placeholder="Описание" cols="30" rows="10">@{{ question.text }}</textarea>
                                </div>
                                <div class="mb-3" v-if="selectTypeEdit != 'Текст'">
                                    <label for="">Файл:</label>
                                    <input type="file" name="file" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Изменить</button>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- Button trigger modal -->
                <button @click="DeleteSituation(question.id)" type="button" class="btn btn-outline-danger">
                    Удалить
                </button>


            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-12 d-flex flex-column justify-content-start align-items-start">
            <div class="container d-flex justify-content-start gap-5 mt-4 col-12">
                 <h3>{{$category->title}}</h3>
                 <a class="btn btn-primary" href="{{ route('add', ['category'=>$category->id, 'question'=>$question ? $question->id : '']) }}">Создать ситуацию +</a>

            </div>

            <div class="container-fluid d-flex flex-wrap justify-content-center col-12">
                @foreach($questions as $question)

                        <div class="card col-3 m-3">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div class="d-flex flex-wrap">
                                    <p class="card-title text-truncate">{{$question->text}}</p>
                                    @if($question->file)
                                        <img src="{{ asset($question->file) }}" style="width: 5rem; heigth:2rem; object-fit:cover;" alt="">
                                    @endif
                                </div>
                                <div class="d-flex flex-row">
                                    <div>
                                        <a href="{{ route('detail', ['id'=>$question->id]) }}" class="btn btn-outline-dark mt-2">Открыть</a>
                                    </div>
                                    <div>
                                    <button type="button" class="btn btn-outline-danger mt-2 ms-2" data-bs-toggle="modal" data-bs-target="#exampleModal1{{ $question->id }}">
                                        Удалить
                                    </button>
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


                            </div>
                        </div>

                @endforeach
            </div>

        </div>
    </div> --}}
  </div>
  <script>
    const app = {
        data() {
            return {
                errors:[],
                message:'',

                SearchValue:'',
                questions:[],
                answers:[],

                selectTypeEdit:0,
                selectTypeAdd:'Текст',

                ExplainSelector:'Текст',
                HelpSelector:'Текст',

                title:'',
            }
        },
        methods: {
            async DetailPage(id){
                const response = await fetch('{{route('detailPost')}}',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'{{ csrf_token() }}',
                        'content-type':'application/json'
                    },
                    body:JSON.stringify({id:id})
                });
                if(response.status == 200){
                    window.location = response.url;
                }
            },
            async AddSituation(){
                let form = document.getElementById('form_add');
                let form_data = new FormData(form);
                form_data.append('id',this.questions[0].category.id);
                const response = await fetch('{{route('situation')}}',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'{{ csrf_token() }}',
                    },
                    body:form_data
                });
                if(response.status===200){
                    this.message = await response.json();
                    setInterval(() => {
                        this.message = '';
                    }, 500);
                }
                this.getQuestions();
            },
            async EditSituation(id){
                let form = document.getElementById('form_edit'+id);
                let form_data = new FormData(form);
                form_data.append('id',JSON.stringify(id));
                const response = await fetch('{{route('questionUpdate')}}',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'{{ csrf_token() }}',
                    },
                    body:form_data
                });
                if(response.status===200){
                    this.message = await response.json();
                    setInterval(() => {
                        this.message = '';
                    }, 500);
                }
                this.getQuestions();
            },
            async DeleteSituation(id){
                const response = await fetch('{{route('questionDelete')}}',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'{{ csrf_token() }}',
                        'content-type':'application/json'
                    },
                    body:JSON.stringify({id:id})
                });
                if(response.status===200){
                    this.message = await response.json();
                    setInterval(() => {
                        this.message = '';
                    }, 500);
                    this.getQuestions();
                }
            },
            async getQuestions(){
                let id = `{{ $categories->id }}`;
                const response = await fetch('{{route('getQuestions')}}',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'{{ csrf_token() }}',
                        'content-type':'application/json'
                    },
                    body:JSON.stringify({id:id})
                });
                // let response_categ = await fetch('{{ route('getQuestions') }}');
                this.questions = await response.json();
                this.title = this.questions[0].category.title
            },
        },
        computed:{
            Search(){
                if(this.SearchValue == ''){

                }
            }
        },
        mounted() {
            this.getQuestions();
        },
    }
    Vue.createApp(app).mount('#Situation');
  </script>
  @endsection
