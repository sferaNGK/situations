@extends('layout.app')
@section('title')
@endsection
@section('content')
<div class="container" id="Login">
    <div class="row">
        <div class="col-12 d-flex justify-content-center align-items-center h-100">

            <div class="shadow rounded mt-5 col-7">
                 <h3 class="p-2" style="text-align: center">Авторизация</h3>

                 <div class="p-2">
                     @if (session()->has('error'))
                     <div class="alert alert-danger">
                         {{ session('error') }}
                     </div>

                     @endif
                 </div>
            <div class="p-4">
                <form @submit.prevent="loginAuth" id="login_form" class="col-12">
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Логин</label>
                      <input name="login" type="text" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Пароль</label>
                      <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn btn-primary">Войти</button>
                </form>
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
            }
        },
        methods: {
            async loginAuth(){
                let form = document.getElementById('login_form');
                let form_data = new FormData(form);
                const response = await fetch('{{route('login')}}',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'{{ csrf_token() }}',
                    },
                    body:form_data
                });
                if(response.status===200){
                      window.location = response.url;
                }
            }
        },
        mounted() {

        },
    }
    Vue.createApp(app).mount('#Login');
</script>
@endsection
