<div class="modal fade" tabindex="-1" id="editModal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(route('user.post.update',$post->id)); ?>" method="POST">
                <?php echo method_field('PUT'); ?>
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <textarea placeholder="Aa" class="form-control m-0" name="body" id="" cols="20"
                        rows="4"> 
                            <?php echo e($post->body); ?>

                        </textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH E:\xampp\htdocs\pictura-app-main\resources\views/pages/posts/components/modal.blade.php ENDPATH**/ ?>