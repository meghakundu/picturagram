<?php if(auth()->guard()->check()): ?>
<?php $__env->startSection('title', '- Posts'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <div class="card my-3" id="postsAdd">
                <div class="card-body">
                    <form action="<?php echo e(route('user.post.store')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Aa" name="body" id="" cols="20"
                                rows="4"></textarea>
                            <input class="form-control py-2" type="file" name="image" id="">
                            Tags:<input class="form-control" type="text" name="post_tags"/>
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
        
        <div class="col-sm-12 col-md-4">
        <div classs="form-group">
            <input type="text" id="search" name="search" placeholder="Search friends and posts.." class="form-control" />
            
        </div>
        <div id="search_list"></div>
        </div>
       
    </div>
</div>
<script src="/amsify/jquery.amsify.suggestags.js"></script>
<script type="text/javascript">
    $('input[name="post_tags"]').amsifySuggestags();
        $('#search').on('keyup',function(){
            var query= $(this).val(); 
            $.ajax({
                url:"search",
                type:"GET",
                data:{'search':query},
                success:function(data){ 
                    $('#search_list').html(data);
                }
            });
             //end of ajax call
        });
</script>
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