<div class="card rounded my-2">
    <div class="card-header bg-white border-white">
        <div class="d-flex flex-row align-items-baseline justify-content-between">
            <div class="flex-shrink-0">
                <?php
                $profile_img = $post->user->avatar;
                ?>
                <img src="<?php echo e(asset("storage/$profile_img")); ?>" alt="" class="rounded-circle" width="48" height="48">

            </div>
            <div class="flex-grow-1 ms-3">

                <a class="text-decoration-none" href="<?php echo e(route('home',$post->user->id)); ?>">
                    <h5 class="ml-2 text-primary text-break ">
                        <?php echo e($post->user->name ?? 'Unknown User'); ?>

                    </h5>
                </a>
               <!-- <button class="">Follow</button> -->
               <?php if(auth()->user()->id !== $post->user_id): ?>
                <?php if(auth()->user()->followings->contains($post->user_id)): ?>
                <a href="<?php echo e(route('unfollow',['follower_id' => auth()->user()->id, 'following_id' => $post->user_id])); ?>" class="btn btn-sm btn-danger">unfollow</a>
                <?php else: ?>
                <a href="<?php echo e(route('follow',['follower_id' => auth()->user()->id, 'following_id' => $post->user_id])); ?>" class="btn btn-sm btn-primary">follow</a>
                <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="flex-end">
                <?php if($post->user_id === auth()->user()->id): ?>
                <div class="dropdown text-right">
                    <button class="btn btn-secondary border-white dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ...
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    
                        <button class="dropdown-item" data-toggle="modal" data-target="#editModal<?php echo e($post->id); ?>">
                            Edit Post
                        </button>
                        <button class="dropdown-item" data-toggle="modal" data-target="#tagperson<?php echo e($post->id); ?>">
                            Tag Person
                        </button>
                        <form action="<?php echo e(route('user.post.destroy',$post->id)); ?>" method="POST">
                            <?php echo method_field('DELETE'); ?>
                            <?php echo csrf_field(); ?>
                            <button type=" submit" class="dropdown-item">Delete Post</button>
                         </form>
                        
                    </div>
                </div>
                <?php endif; ?>
                <sup class="text-muted text-break">
                    <?php echo e($post->created_at->diffForHumans()); ?>

                </sup>
            </div>
        </div>
        <div class="flex-row mt-3">
            <p class="card-text">
                <?php echo e($post->body); ?> 
            </p>
            <?php
            $tags_arr[]=explode(',',$post->post_tags);
            $tagname = App\Models\User::select('name')->where('id',$post->tagged_person)->first();
            ?>
            <?php $__currentLoopData = $tags_arr[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tagItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($tagItem!=0): ?>
            <a href="/explore/tags/<?php echo e($tagItem); ?>" target="_blank">#<?php echo e($tagItem); ?></a>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  

            <?php if($post->tagged_person!=0): ?> 
           <p>@<a href="/users/<?php echo e($post->tagged_person); ?>" target="_blank"><?php echo e($tagname->name); ?></a></p>
            <?php endif; ?>
        </div>
    </div>
    <a class="text-decoration-none" href="<?php echo e(route('user.post.show',$post->id)); ?>">
        <div class="card-body">
            <img class="card-img-top img-fluid rounded" src="<?php echo e(asset("storage/$post->image")); ?>" alt="" srcset="">
        </div>
    </a>
    <div class="card-footer bg-white border-white">
        <div class="btn-group">
            <?php if($post->user_id != auth()->user()->id): ?>
            <a href="" class="btn">
                <i class="fa fa-heart"></i>
            </a>
            <?php endif; ?>
            &nbsp; &nbsp;
            <div id="box">
            <span class="btn commentBox" data-id="<?php echo e($post->id); ?>">
            <i class="fa fa-comment"></i>
            </span>
            <div id="replycomment-<?php echo e($post->id); ?>">
            <?php if($post->user_id != auth()->user()->id): ?>
            <form method="post" id="" action="/add-comment/<?php echo e($post->id); ?>">
             <?php echo csrf_field(); ?>
            <div class="form-group">
             <input type="text" name="comment_input" placeholder="Add Comment..." class="form-control" />
             <input type="hidden" name="post_id" value="<?php echo e($post->id); ?>" />
             <input type="hidden" name="user_id" value="<?php echo e(auth()->user()->id); ?>"/>
            </div>
            <div class="form-group">
            <input type="submit" class="btn btn-warning" value="Post" />
            </div>
            </form>
            <?php endif; ?>
            <div class="replyBox">
            <h3>Comments</h3>
            <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($item['parent_id']==0 && $item['post_id']==$post->id): ?>
            <img src="/storage/<?php echo e($item['user']['avatar']); ?>" class="rounded-circle" width="48" height="48"/><span><?php echo e($item['user']['name']); ?></span>
            <p><?php echo e($item['comment_input']); ?></p>
            <form method="post" id="replyform" action="/reply-comment">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                    <input type="text" name="comment_input" placeholder="reply to.." class="form-control" />
                    <input type="hidden" name="user_id" value="<?php echo e(auth()->user()->id); ?>" />
                    <input type="hidden" name="parent_id" value="<?php echo e($item['id']); ?>"/>
                    <input type="hidden" name="post_id" value="<?php echo e($item['post']['id']); ?>"/>
                    </div>
                    <div class="form-group">
                    <input type="submit" class="btn" value="Reply" />
                    </div>
            </form>
            <?php endif; ?>
            <?php if($item['parent_id']!=0 && $item['post_id']==$post->id): ?>
            <img src="/storage/<?php echo e($item['user']['avatar']); ?>" class="rounded-circle" width="48" height="48"/>
            <span><?php echo e($item['user']['name']); ?></span>
            <p><?php echo e($item['comment_input']); ?></p>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            </div>
            </div>
        </div>
    </div>  
</div>
<script type="text/javascript">
       $(".commentBox").click(function(){
            // this will query for the clicked toggle
            var $toggle = $(this); 
            console.log($toggle);
            // build the target form id
            var id = "#replycomment-" + $toggle.data('id'); 
            $(id).toggle();
            const form = document.getElementById('id');
            if (form.style.display === 'none') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        });
   
</script>
<?php echo $__env->make('pages.posts.components.modal',$post, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('pages.posts.components.tagPerson', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH E:\xampp\htdocs\pictura-app-main\resources\views/pages/posts/components/post.blade.php ENDPATH**/ ?>