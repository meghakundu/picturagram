@extends('layouts.app')

@auth
@section('title', '- Posts')

@section('content')
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
 <script src="{{ asset('js/chatapp.js') }}" type="text/javascript"></script>
@endsection
@endauth