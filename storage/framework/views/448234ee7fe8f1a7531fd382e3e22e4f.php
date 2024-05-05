<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <?php if(auth()->guard()->check()): ?>
                   <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('category')); ?>">Игры</a>
              </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('exit')); ?>">Выход</a>
          </li>
            <?php endif; ?>

        </ul>
      </div>
    </div>
  </nav>
<?php /**PATH C:\Users\onixc\Downloads\situations\resources\views/layout/nuvbar.blade.php ENDPATH**/ ?>