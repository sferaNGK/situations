@extends('layout.app')
@section('title')
Игры
@endsection
@section('content')
<div class="container" id="Categories">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success mt-2" v-if="message != ''">
                @{{ message }}
            </div>

            <div>
                <div class="d-flex justify-content-between mt-5 col-10">
                        <input class="form-control" type="search" v-model="SearchValue" id="title" name="search" placeholder="Искать игру" aria-label="Search">
                        <button href="" class="btn bg-body-secondary col-2" style="margin-left:10px"> Все Игры</button>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-5 col-4" >
            <h3>Игры</h3>
             <!-- Button trigger modal -->
             <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalAdd">
                Добавить +
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Добавление игры</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="CategoryAdd" id="form_add" class="mt-3" method="post">
                            <div class="mb-3">
                                <input type="text" name="title" class="form-control" placeholder="Название">
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" name="description" placeholder="Описание" cols="30" rows="5"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>
            </div>

            <div class="container-fluid d-flex flex-wrap align-items-sm-start mt-3">
                <div class="card m-3 pb-2" v-for="category in categories">
                    <div class="card-body">
                        <h5 class="card-title">@{{category.title}}</h5>
                        <a @click="show_page(category.id)" class="btn btn-outline-dark">Открыть</a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" :data-bs-target="`#exampleModal_${category.id}`">
                            Редактировать
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" :id="`exampleModal_${category.id}`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Редактирование</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form @submit.prevent="EditCategory(category.id)" class="mt-3" :id="`form_edit${category.id}`">
                                        <div class="mb-3">
                                            <input type="text" name="title" class="form-control" placeholder="Название" :value="category.title">
                                        </div>
                                        <div class="mb-3">
                                            <textarea class="form-control" name="description" placeholder="Описание" cols="30" rows="5">@{{ category.description }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Изменить</button>
                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>

                        <!-- Button trigger modal -->
                        <button type="button" @click="DeleteCategory(category.id)" class="btn btn-outline-danger">
                            Удалить
                        </button>


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
                categories:[],
            }
        },
        methods: {
            async show_page(id){
                const response = await fetch('{{route('situationPage')}}',{
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
            async CategoryAdd(){
                let form = document.getElementById('form_add');
                let form_data = new FormData(form);
                const response = await fetch('{{route('categorySave')}}',{
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
                this.getCategories();
            },
            async EditCategory(id){
                let form = document.getElementById('form_edit'+id);
                let form_data = new FormData(form);
                form_data.append('id',JSON.stringify(id));
                const response = await fetch('{{route('categoryUpdate')}}',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'{{ csrf_token() }}',
                        'content-type':'application/json'
                    },
                    body:form_data
                });
                if(response.status===200){
                    this.message = await response.json();
                    setInterval(() => {
                        this.message = '';
                    }, 500);
                }
                this.getCategories();
            },
            async DeleteCategory(id){
                const response = await fetch('{{route('categoryDelete')}}',{
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
                    this.getCategories();
                }
            },
            async getCategories(){
                let response_categ = await fetch('{{ route('GetCategories') }}');
                this.categories = await response_categ.json();
            }
        },
        computed:{
            Search(){
                if(this.SearchValue == ''){

                }
            }
        },
        mounted() {
            this.getCategories();
        },
    }
    Vue.createApp(app).mount('#Categories');
</script>
@endsection

