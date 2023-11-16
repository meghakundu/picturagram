<?php if(auth()->guard()->check()): ?>
<?php $__env->startSection('title', '- Posts'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <div class="card my-3">
                <div class="card-body">
                    <form action="<?php echo e(route('user.post.store')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Aa" name="body" id="" cols="20"
                                rows="4"></textarea>
                            <input class="form-control py-2" type="file" name="image" id="">
                            <br>
                            <input class="btn btn-primary btn-block" type="submit" value="Publish">
                        </div>
                    </form>
                </div>
            </div>
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('pages.posts.components.post',$post, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <br>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="col-sm-12 col-md-4 text-right users-list">
            <h3>Chat with</h3>
            <ul>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(auth()->user()->name!=$user->name): ?>
         <li> <?php if(Cache::has('user-is-online-'. $user->id)): ?><i class="fa fa-circle"></i><?php endif; ?> <?php echo e($user->name); ?></li>
         <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php if(auth()->guard()->guest()): ?>
<?php $__env->startSection('content'); ?>
<div class="container">
<div class="row justify-content-center">
<p>Sign up to see <i>photos</i> and <br> <i>videos</i> from your friends.</p>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\pictura-app-main\resources\views/pages/posts/index.blade.php ENDPATH**/ ?>