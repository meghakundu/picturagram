<div class="modal fade" tabindex="-1" id="editModal{{$post->id}}">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user.post.update',$post->id) }}" method="POST">
                @method('PUT')
                @csrf
                <input type="hidden" name="id" value="{{$post->id}}"/>
                <div class="modal-body">
                    <div class="form-group">
                        <textarea placeholder="Aa" class="form-control m-0" name="body" id="" cols="20"
                        rows="4"> 
                            {{ $post->body }}
                        </textarea>
                    </div>
                    <div class="form-group">
                    <input class="form-control" type="text" name="post_tags" value=" {{ $post->post_tags }}"/>
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