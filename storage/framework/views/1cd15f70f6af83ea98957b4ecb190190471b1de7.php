

<?php if(auth()->guard()->check()): ?>
<?php $__env->startSection('title', '- Posts'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
   
        <div style="display:inline-flex;" class="mt-5">
        <!-- container element in which TalkJS will display a chat UI  -->
        <div id="contacts-list">
            <h2>Contacts  <i class="fa fa-map-marker" id="user-location"></i> </h2>
           
        </div>
        <div id="talkjs-container">
        <i>Loading chat...</i>
        </div>     
        </div>

</div>
</div>
<script type="text/javascript">
   const contactsList = <?php if(!empty($users[0]->followings)){echo json_encode($users[0]->followings);} ?>;
    const currentUser=<?php echo json_encode($current_user); ?>;
</script>
 <script src="<?php echo e(asset('js/chatapp.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\pictura-app-main\resources\views/pages/inbox.blade.php ENDPATH**/ ?>