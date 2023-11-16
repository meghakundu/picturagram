
  
<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Laravel Display Online Users - ItSolutionStuff.com</h1>
  
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Last Seen</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($user->id); ?></td>
                    <td><?php echo e($user->name); ?></td>
                    <td><?php echo e($user->email); ?></td>
                    <td>
                        <?php echo e(Carbon\Carbon::parse($user->last_seen)->diffForHumans()); ?>

                    </td>
                    <td>
                        <?php if(Cache::has('user-is-online-' . $user->id)): ?>
                            <span class="text-success">Online</span>
                        <?php elseif(!Cache::has('user-is-online-'. $user->id)): ?>
                            <span class="text-primary">Offline</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\pictura-app-main\resources\views/users.blade.php ENDPATH**/ ?>