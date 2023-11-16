<div class="modal fade" tabindex="-1" id="tagperson<?php echo e($post->id); ?>">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mention someone in your post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/tagged-person" id="your-form" method="GET">
            <!-- <?php echo method_field('PUT'); ?>
                <?php echo csrf_field(); ?> -->
                <input type="hidden" name="id" value="<?php echo e($post->id); ?>"/>
                <div class="modal-body">
                    <div class="form-group">
                      @<input type="text" id="searchPeople" name="tagged_person" value=""/>
                    </div>       
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
           </form>
        </div>
    </div>
</div>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"> 
    </script>
    <script type="text/javascript">
        var route = "<?php echo e(url('autocomplete-search')); ?>";
        $('#searchPeople').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return  process(data);
               });
            }
            
        });
       // window.location.href = "http://sidanmor.com";
    </script><?php /**PATH E:\xampp\htdocs\pictura-app-main\resources\views/pages/posts/components/tagPerson.blade.php ENDPATH**/ ?>