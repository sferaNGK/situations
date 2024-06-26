<?php $__env->startSection('title'); ?>
Игры
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container" id="Categories">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success mt-2" v-if="message != ''">
                {{ message }}
            </div>

            <div>
                <div class="d-flex justify-content-between mt-5 col-10">
                        <input class="form-control" type="search" v-model="SearchValue" id="title" name="search" placeholder="Искать игру" aria-label="Search">
                        <button @click="ClearSearch" class="btn bg-body-secondary col-2" style="margin-left:10px"> Все Игры</button>
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
                    <div class="modal-header d-flex flex-column">
                    <div class="alert alert-success w-100" v-if="message != ''">
                        {{ message }}
                    </div>
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Добавление игры</h1>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="CategoryAdd" id="form_add" class="mt-3" method="post">
                            <div class="mb-3">
                                <input type="text" name="title" class="form-control" placeholder="Название">
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" name="description" placeholder="Описание" cols="30" rows="5"></textarea>
                            </div>
                            <div class="mb-3">
                                <select name="type" class="form-control">
                                    <option value="Программисты">Программисты</option>
                                    <option value="Преподователи">Преподователи</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>
            </div>

            <div class="container-fluid d-flex flex-wrap align-items-sm-start mt-3">
                <div class="card m-3 pb-2" v-for="category in Search">
                    <div class="card-body">
                        <h5 class="card-title">{{category.title}}</h5>
                        <a @click="show_page(category.id)" class="btn btn-outline-dark">Открыть</a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary ms-2 me-2" data-bs-toggle="modal" :data-bs-target="`#exampleModal_${category.id}`">
                            Редактировать
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" :id="`exampleModal_${category.id}`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header d-flex flex-column">
                                    <div class="alert alert-success w-100" v-if="message != ''">
                                        {{ message }}
                                    </div>
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Редактирование</h1>
                                </div>
                                <div class="modal-body">
                                    <form @submit.prevent="EditCategory(category.id)" class="mt-3" :id="`form_edit${category.id}`">
                                        <div class="mb-3">
                                            <input type="text" name="title" class="form-control" placeholder="Название" :value="category.title">
                                        </div>
                                        <div class="mb-3">
                                            <textarea class="form-control" name="description" placeholder="Описание" cols="30" rows="5">{{ category.description }}</textarea>
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
                const response = await fetch('<?php echo e(route('situationPage')); ?>',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
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
                const response = await fetch('<?php echo e(route('categorySave')); ?>',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
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
                const response = await fetch('<?php echo e(route('categoryUpdate')); ?>',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
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
                const response = await fetch('<?php echo e(route('categoryDelete')); ?>',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
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
                let response_categ = await fetch('<?php echo e(route('GetCategories')); ?>');
                this.categories = await response_categ.json();
            },
            ClearSearch(){
                this.SearchValue = '';
            }
        },
        computed:{
            Search(){
                if(this.SearchValue == ''){
                    return [...this.categories];
                } else{
                    return this.categories.filter(cat=>cat.title.toLowerCase().includes(this.SearchValue.toLowerCase()));
                }
            }
        },
        mounted() {
            this.getCategories();
        },
    }
    Vue.createApp(app).mount('#Categories');
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\onixc\Downloads\situations\resources\views/category.blade.php ENDPATH**/ ?>