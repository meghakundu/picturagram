<div class="modal fade" tabindex="-1" id="tagperson{{$post->id}}">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mention someone in your post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/tagged-person" id="your-form" method="GET">
            <!-- @method('PUT')
                @csrf -->
                <input type="hidden" name="id" value="{{$post->id}}"/>
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
        var route = "{{ url('autocomplete-search') }}";
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
    </script>