@extends('layout.app')
@section('title')
Подробнее
@endsection
@section('content')
<div class="container mt-3" id="Deatil">
    <div class="row">
        <div class="col-12">
            <div class="shadow rounded p-4">
                {{-- Quesiton --}}
                <div v-for="question in questions">
                    <p class="card-title"><h5>Ситуация:</h5>@{{ question.text }}</p>
                    <img :src="question.file" style="width: 10%; object-fit:cover" alt="">
                    <p><h5>Ответы:</h5></p>
                </div>
                {{-- Answer --}}
                <div v-for="answer in answers">
                    <p>@{{ answer.answer_text }} <span v-if="answer.right == 1"><b>(Правильный ответ)</b></span></p>
                </div>

                <div>
                    <h5>Объяснение:</h5>
                    <p>@{{ explainText }}</p>
                    <img :src="explainImg" style="width: 15%; object-fit:cover" alt="" srcset="">
                </div>

                <div>
                    <h5>Подсказка:</h5>
                    <p>@{{ helpText }}</p>
                    <img :src="helpImg" style="width: 15%; object-fit:cover" srcset="">
                </div>

                <button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Изменить
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header d-flex flex-column">
                            <div class="alert alert-success w-100" v-if="message != ''">
                                @{{ message }}
                            </div>
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Изменение ситуации</h1>
                        </div>
                        <form @submit.prevent="EditSituation" id="form_edit">
                            <div class="modal-body" v-for="question in questions">

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
                                    <textarea class="form-control" name="text" placeholder="Описание" :value="question.text" cols="30" rows="10"></textarea>
                                </div>
                                <div class="mb-3" v-if="selectTypeAdd != 'Текст'">
                                    <label for="">Файл:</label>
                                    <input type="file" name="file" class="form-control">
                                </div>

                                {{-- Answer --}}

                                <h5 class="mb-2">Ответы:</h5>

                                    <div class="row" v-for="(answer, index) in answers">
                                        <div class="col-2 d-flex justify-content-center align-items-center">
                                            <label class="d-flex justify-content-between">
                                            <div> @{{ index + 1 }}</div>
                                            <input v-if="answer.right == 1" checked type="radio"  style=" transform: scale(1.7); margin-left:15px;margin-top:5px" name="right" :value="index">
                                            <input v-else type="radio"  style=" transform: scale(1.7); margin-left:15px;margin-top:5px" name="right" :value="index">
                                        </label>
                                        </div>
                                        <div class="col-10 mb-4">
                                            <div class="mt-2">
                                                <textarea type="text" placeholder="Введите ответ" :value="answer.answer_text" class="form-control" :id="`answer_area_${index}`" :name="`answer_text[${index}]`"></textarea>
                                            </div>
                                        </div>
                                    </div>


                                 <div class="mb-4">
                                    <h6 for="explain"> Введите объяснение:</h6>
                                    <select name="explain_type" class="form-select mt-2 mb-2" v-model="ExplainSelector" id="answer_type">
                                        <option value="Текст">Текст</option>
                                        <option value="Изображение">Изображение</option>
                                        <option value="Аудио">Аудио</option>
                                        <option value="Видео">Видео</option>
                                    </select>
                                    <textarea type="text" v-if="ExplainSelector == 'Текст'" :value="explainText" name="explain" id="explain" class="form-control @error('explain') is-invalid @enderror" placeholder="Объяснение"></textarea>
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
                                    <textarea type="text" v-if="HelpSelector == 'Текст'" :value="helpText" name="help" id="help" class="form-control @error('help') is-invalid @enderror" placeholder="Подсказка"></textarea>
                                    <input type="file" v-if="HelpSelector != 'Текст'" name="help_file" class="form-control  @error('file') is-invalid @enderror" id="help_input">
                                </div>

                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
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

                helpText:'',
                helpImg:'',
                explainText:'',
                explainImg:'',

                selectTypeEdit:0,
                selectTypeAdd:'',


                ExplainSelector:'',
                HelpSelector:'',

                title:'',
            }
        },
        methods: {
            async EditSituation(){
                let form = document.getElementById('form_edit');
                let form_data = new FormData(form);
                form_data.append('id', this.questions[0].id);
                const response = await fetch('{{route('editQuestionAndAnswer')}}',{
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
                form.reset();
                this.getQuestions();
                this.getAnswers();
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
                let id = `{{ $questions->id }}`;
                const response = await fetch('{{route('getQuestionDetail')}}',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'{{ csrf_token() }}',
                        'content-type':'application/json'
                    },
                    body:JSON.stringify({id:id})
                });
                this.questions = await response.json();
                this.title = this.questions[0].text;
                this.selectTypeAdd = this.questions[0].type;
            },
            async getAnswers(){
                let id = `{{ $questions->id }}`;
                const response = await fetch('{{route('getAnswersDetail')}}',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'{{ csrf_token() }}',
                        'content-type':'application/json'
                    },
                    body:JSON.stringify({id:id})
                });
                this.answers = await response.json();
               this.helpText = this.answers[0].help;
               this.helpImg = this.answers[0].help_file;

               this.explainText = this.answers[0].explain;
               this.explainImg = this.answers[0].explain_file;

               this.ExplainSelector = this.answers[0].explain_type;
               this.HelpSelector = this.answers[0].help_type;

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
            this.getAnswers();
        },
    }
    Vue.createApp(app).mount('#Deatil');
  </script>
@endsection
