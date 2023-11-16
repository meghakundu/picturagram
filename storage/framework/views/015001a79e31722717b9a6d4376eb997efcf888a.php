<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-2"></div>
        <div class="col-sm-12 col-md-8">
            <?php echo $__env->make('pages.posts.components.post',$post, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-sm-12 col-md-2"></div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\pictura-app-main\resources\views/pages/posts/show.blade.php ENDPATH**/ ?>