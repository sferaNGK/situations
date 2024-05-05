<?php $__env->startSection('title'); ?>
Создание ситуации
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

            <div class="shadow rounded mt-3">
                <h3 style="margin-left:40px; margin-bottom:-15px" class="pt-4">Создание ситуации</h3>
                <form action="<?php echo e(route('situation', ['category' => $category->id])); ?>" class="p-5" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('post'); ?>


                    <div class="question">
                        <select class="form-select mb-3" name="type" id="questionType">
                            <option>Текст</option>
                            <option>Изображение</option>
                            <option>Аудио</option>
                            <option>Видео</option>
                        </select>


                        <div class="mb-3">
                            <textarea  class="form-control <?php $__errorArgs = ['text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="display: block" id="question_textarea" name="text"></textarea>
                        </div>
                        <input type="file" name="file" class="form-control  <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="display: none" id="question_input">
                        <div class="invalid-feedback">
                            <?php $__errorArgs = ['text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <?php echo e($message); ?>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>


                    <h3  class="pt-3">Добавление ответов</h3>

                    <?php for($i=0; $i < 4; $i++): ?>
                        <div class="row">
                            <div class="col-2 d-flex justify-content-center align-items-center">
                                <label class="d-flex justify-content-between">
                                   <div> <?php echo e($i + 1); ?> </div><input type="radio"  style=" transform: scale(1.7);
                                    margin-left:15px;margin-top:5px" class="<?php $__errorArgs = ['right'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="right" value="<?php echo e($i); ?>">

                                <div class="p-3 invalid-feedback">
                                    <?php $__errorArgs = ['right'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <?php echo e($message); ?>

                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </label>
                            </div>
                            <div class="col-10">
                                <select class="form-select mt-4" name="answer_type[<?php echo e($i); ?>]" onchange="changeTypeAnswer(this.value, <?php echo e($i); ?>)">
                                    <option>Текст</option>
                                    <option>Изображение</option>
                                    <option>Аудио</option>
                                    <option>Видео</option>
                                </select>

                                <div class="mt-2">
                                    <textarea type="text" style="display: block" class="form-control <?php $__errorArgs = ['answer_text.' . $i];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="answer_area_<?php echo e($i); ?>" name="answer_text[<?php echo e($i); ?>]"></textarea>
                                    <input type="file" style="display: none" class="form-control <?php $__errorArgs = ['answer_file.' . $i];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="answer_file[<?php echo e($i); ?>]" id="answer_input_<?php echo e($i); ?>">
                                    <div class="invalid-feedback">
                                        <?php $__errorArgs = ['answer_text.' . $i];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <?php echo e($message); ?>

                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>

                    <div class="mb-4">
                        <h6 for="explain"> Введите объяснение:</h6>
                        <textarea type="text" name="explain" id="explain" class="form-control <?php $__errorArgs = ['explain'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Объяснение"></textarea>
                        <div class="invalid-feedback">
                        <?php $__errorArgs = ['explain'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <?php echo e($message); ?>

                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 for="help"> Введите подсказку:</h6>
                        <textarea type="text" name="help" id="help" class="form-control <?php $__errorArgs = ['help'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Подсказка"></textarea>
                        <div class="invalid-feedback">
                        <?php $__errorArgs = ['help'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <?php echo e($message); ?>

                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
    const question_textarea =  document.querySelector('#question_textarea');
    const question_input =  document.querySelector('#question_input');
    if(event.target.value !== 'Текст'){
        question_textarea.style.display = 'none';
        question_input.style.display = 'block';
    }else{
        question_textarea.style.display = 'block';
        question_input.style.display = 'none';
    }
});


    function changeTypeAnswer(el, id){
        console.log(el, id);
        const answer_area = document.querySelector(`#answer_area_${id}`);
        const answer_input = document.querySelector(`#answer_input_${id}`);
        if(el !== 'Текст'){
            answer_area.style.display = 'none';
            answer_input.style.display = 'block';
        } else {
            answer_area.style.display = 'block';
            answer_input.style.display = 'none';
        }
    }



</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.nuvbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\onixc\Downloads\situations\resources\views/add_situations.blade.php ENDPATH**/ ?>