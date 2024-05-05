<?php $__env->startSection('title'); ?>
Игры
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <?php if(session()->has('ok')): ?>
            <div class="alert alert-success mt-2">
                <?php echo e(session('ok')); ?>

            </div>
            <?php endif; ?>

            <div>
                <form action="<?php echo e(route('search')); ?>" class="mt-3"  role="search" method="post">
                    <?php echo method_field('post'); ?>
                    <?php echo csrf_field(); ?>
                    <div  class="d-flex justify-content-between col-10">
                         <input class="form-control" type="search"  id="title" name="search" placeholder="Искать игру" aria-label="Search">
                    <button class="btn btn-dark" style="margin-left:10px" type="submit">Поиск</button>
                    <a href="" class="btn bg-body-secondary col-2" style="margin-left:10px"> Все Игры</a>
                    </div>

                </form>
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
                        <form action="<?php echo e(route('categorySave')); ?>" class="mt-3" method="post">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('post'); ?>
                            <div class="mb-3">
                                <input type="text" name="title" class="form-control" placeholder="Название">
                            </div>
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>
            </div>

            <div class="container-fluid d-flex flex-wrap align-items-sm-start mt-3" style="margin: 0 auto">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card m-3 pb-2" >
                            <div class="card-body">
                                <h5 class="card-title"><?php echo e($category->title); ?></h5>
                                <p><?php echo e(date('d-m-Y', strtotime($category->created_at))); ?></p>
                                <a href="<?php echo e(route('situationPage', ['id'=>$category->id])); ?>" class="btn btn-outline-dark">Открыть</a>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo e($category->id); ?>">
                                    Редактировать
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal<?php echo e($category->id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Редактирование</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?php echo e(route('categoryUpdate', ['category'=>$category])); ?>" class="mt-3" method="post">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('post'); ?>
                                                <div class="mb-3">
                                                    <input type="text" name="title" class="form-control" placeholder="Название" value="<?php echo e($category->title); ?>">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Изменить</button>
                                            </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal1<?php echo e($category->id); ?>">
                                    Удалить
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal1<?php echo e($category->id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Вы точно хотите удалить игру?</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                        <a href="<?php echo e(route('categoryDelete', ['category'=>$category])); ?>" class="btn btn-danger">Удалить</a>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout.nuvbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\onixc\Downloads\situations\resources\views/category.blade.php ENDPATH**/ ?>