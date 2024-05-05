<?php $__env->startSection('title'); ?>
Подробнее
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <div class="shadow rounded p-4">

                <p class="card-title"><h5>Ситуация:</h5><?php echo e($question->text); ?></p>
                <?php if($question->file): ?>
                    <img src="<?php echo e(asset($question->file)); ?>" class="w-25" alt="">
                <?php endif; ?>
                <p><h5>Ответы:</h5></p>
                <?php $__currentLoopData = $question->answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex">
                    <p><?php echo e($key + 1); ?></p>
                     <p style="margin-left:10px" class="mb-3"><?php echo e($answer->answer_text); ?></p>
                     <?php if($answer->answer_file): ?>
                     <?php
                     $extension = strtolower(pathinfo($answer->answer_file, PATHINFO_EXTENSION));
                     ?>

                     <?php if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg'])): ?>
                         <img src="<?php echo e(asset($answer->answer_file)); ?>" style="margin-left:10px" class="col-2 mb-3" alt="Ответ">
                     <?php elseif(in_array($extension, ['mp3', 'wav', 'ogg'])): ?>

                         <audio controls class="mb-3">
                             <source src="<?php echo e(asset($answer->answer_file)); ?>" type="audio/mpeg">
                             Ваш браузер не поддерживает аудио элемент.
                         </audio>
                         <?php elseif(in_array($extension, ['mp4', 'webm', 'ogg'])): ?>
                        <video controls style="max-width: 30%; max-height: 400px;" class="mb-3">
                            <source src="<?php echo e(asset($answer->answer_file)); ?>"   type="video/<?php echo e($extension); ?>">
                            Ваш браузер не поддерживает видео элемент.
                        </video>
                     <?php else: ?>
                         <p>Формат файла не поддерживается</p>
                     <?php endif; ?>

                    <?php endif; ?>

                    <?php if($answer->right === '1'): ?>
                    <p style="margin-left:10px">(правильный ответ)</p>
                    <?php endif; ?>


                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <h5>Объяснение:</h5>
                <p><?php echo e($answer->explain); ?></p>
                <h5>Подсказка:</h5>
                <p><?php echo e($answer->help); ?></p>

                <div class="d-flex justify-content-between col-4">
                    <div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo e($question->id); ?>">
                            Редактировать
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal<?php echo e($question->id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Редактирование</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo e(route('questionUpdate' , ['question'=>$question, 'answer'=>$answer])); ?>" class="mt-3" method="post" enctype="multipart/form-data">
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
                                                <textarea  class="form-control <?php $__errorArgs = ['question_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="display: block" id="question_textarea" name="text"><?php echo e($question->text); ?></textarea>
                                            </div>
                                            <input type="file" name="file" class="form-control  <?php $__errorArgs = ['question_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="display: none" id="question_input">
                                            <div class="invalid-feedback">
                                                <?php $__errorArgs = ['question_text'];
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
                                        <?php for($i=0; $i < 4; $i++): ?>

                                        <input type="hidden" name="id[<?php echo e($i); ?>]" value="<?php echo e($answers[$i]->id); ?>">

                                            <div class="row">
                                                <div class="col-2 d-flex justify-content-center align-items-center">
                                                    <label class="d-flex justify-content-between">
                                                       <div> <?php echo e($i + 1); ?>) </div><input type="radio"   style=" transform: scale(1.7);
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
$message = $__bag->first($__errorArgs[0]); ?>
                                                        is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="answer_area_<?php echo e($i); ?>" name="answer_text[<?php echo e($i); ?>]"><?php echo e($answers[$i]->answer_text); ?></textarea>
                                                        <input type="file" style="display: none" class="form-control <?php $__errorArgs = ['answer_file.' . $i];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        is-invalid <?php unset($message);
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
unset($__errorArgs, $__bag); ?>" placeholder="Пояснение"><?php echo e($answer->explain); ?></textarea>
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
unset($__errorArgs, $__bag); ?>" placeholder="Подсказка"><?php echo e($answer->help); ?></textarea>
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
                                        <button type="submit" class="btn btn-primary">Изменить</button>
                                    </form>
                                </div>

                            </div>
                            </div>
                        </div>

                </div>

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
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\onixc\Downloads\situations\resources\views/detail.blade.php ENDPATH**/ ?>