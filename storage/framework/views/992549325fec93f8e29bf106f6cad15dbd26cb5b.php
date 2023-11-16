
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
      <div class="posts-tags"><span>#<?php echo e(collect(request()->segments())->last()); ?></span>
      <p><?php echo e($postsByTag->count()); ?>posts count</p>
      </div>
      <div class="recent-posts">
        <h3>Top posts</h3>
      <?php $__currentLoopData = $postsByTag->chunk(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="flex-row">
      <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <a href="<?php echo e(route('user.post.show',$post->id)); ?>">
      <img src="<?php echo e(asset("storage/$post->image")); ?>" class="img-fluid rounded card-img-top" alt="" srcset="" style="width:30%; height:40%">
      </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div> 
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\pictura-app-main\resources\views/pages/posts/tagsPost.blade.php ENDPATH**/ ?>