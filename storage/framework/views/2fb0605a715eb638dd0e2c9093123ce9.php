<?php $__env->startSection('title'); ?>
Все ситуации
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

  <div class="container">
    <div class="row">
        <div class="col-10">
            <div class="d-flex justify-content-between mt-4 col-5">
                 <h3><?php echo e($category->title); ?></h3>
                 <a class="btn btn-primary" href="<?php echo e(route('add', ['category'=>$category->id, 'question'=>$question ? $question->id : ''])); ?>">Создать ситуацию +</a>

            </div>

            <div class="container-fluid d-flex flex-wrap align-items-start">
                <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="card m-3" style="width: 300px;">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div class="d-flex flex-wrap">
                                    <p class="card-title text-truncate"><?php echo e($question->text); ?></p>
                                    <?php if($question->file): ?>
                                        <img src="<?php echo e(asset($question->file)); ?>" class="col-3" alt="">
                                    <?php endif; ?>
                                </div>
                                <div class="d-flex flex-row">
                                    <div>
                                        <a href="<?php echo e(route('detail', ['id'=>$question->id])); ?>" class="btn btn-outline-dark mt-2">Открыть</a>
                                    </div>
                                    <div>
                                    <button type="button" class="btn btn-outline-danger mt-2 ms-2" data-bs-toggle="modal" data-bs-target="#exampleModal1<?php echo e($question->id); ?>">
                                        Удалить
                                    </button>
                                    <div class="modal fade" id="exampleModal1<?php echo e($question->id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Вы точно хотите удалить ситуацию?</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                            <a href="<?php echo e(route('questionDelete', ['question'=>$question])); ?>" class="btn btn-danger" >Удалить</a>
                                            </div>
                                        </div>
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
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\onixc\Downloads\situations\resources\views/situations.blade.php ENDPATH**/ ?>