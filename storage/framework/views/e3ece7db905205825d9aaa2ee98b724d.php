<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container" id="Reg">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-center">

            <div class="shadow rounded mt-5 col-7">
                 <h3 class="p-2" style="text-align: center">Регистрация</h3>

            <div class="p-4">
                <form @submit.prevent="AuthAdmin" id="reg_form" class="col-12">
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Логин</label>
                      <input name="login" type="text" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Пароль</label>
                      <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
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
            async AuthAdmin(){
                let form = document.getElementById('reg_form');
                let form_data = new FormData(form);
                const response = await fetch('<?php echo e(route('register')); ?>',{
                    method: 'post',
                    headers:{
                        'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
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
    Vue.createApp(app).mount('#Reg');
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\onixc\Downloads\situations\resources\views/reg.blade.php ENDPATH**/ ?>