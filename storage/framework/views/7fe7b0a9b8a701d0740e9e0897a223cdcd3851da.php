<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e($user->name . __(' - Profile')); ?></div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo e(session('status')); ?>

                    </div>
                    <?php endif; ?>

                    <div class="d-flex flex-row justify-content-around">
                        <ul class="profile-block">
                            <img src="/storage/<?php echo e($user->avatar); ?>" class="rounded-circle" width="100" height="100"/>
                            <form method="POST" action="/change-profileimg/<?php echo e($user->id); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field("PUT"); ?>
                            <label for="profileImage"> 
                             <a style="cursor: pointer;" class="avatar_block"><em class="fa fa-minus"></em></a></label> 
                            <input type="file" name="avatar" id="profileImage" style="display: none;">
                            <input type="submit" name="submit" value="Change" class="btn"/>
                            </form>
                            <li> <?php echo e($user->name); ?></li>
                            <li><?php echo e($user->email); ?></li>
                            <?php if(auth()->user()->id !== $user->id): ?>
                <?php if(auth()->user()->followings->contains($user->id)): ?>
                <a href="<?php echo e(route('unfollow',['follower_id' => auth()->user()->id, 'following_id' => $user->id])); ?>" class="btn btn-sm btn-danger">unfollow</a>
                <?php else: ?>
                <a href="<?php echo e(route('follow',['follower_id' => auth()->user()->id, 'following_id' => $user->id])); ?>" class="btn btn-sm btn-primary">follow</a>
                <?php endif; ?>
                <?php endif; ?>
                 <a href="/post-timeline/<?php echo e($user->id); ?>" class="btn btn-light">Post Timeline</a>
                            <!-- <li> Registered at: <?php echo e($user->created_at->diffForHumans()); ?></li> -->
                        </ul>
                        <br>
                        <ul>
                            <li> Posts count: <?php echo e(count($user->posts)); ?></li>
                            <li>Followers:<?php echo e(count($user->followers)); ?></li>
                            <li>Following:<?php echo e(count($user->followings)); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <br>
            <div class="card d-flex align-items-center ">
                <div class="card-body">
                <?php if(count($user->followers) > 0): ?>
                    <?php $__currentLoopData = $user->posts->chunk(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex-row">
                        <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('user.post.show',$post->id)); ?>">
                            <img src="<?php echo e(asset("storage/$post->image")); ?>" class="img-fluid rounded card-img-top " alt=""
                                srcset="" style="width: 20%; height: 20%;">
                        </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <p>Account is private</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\pictura-app-main\resources\views/pages/user/home.blade.php ENDPATH**/ ?>