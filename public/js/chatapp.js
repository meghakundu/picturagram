      // Display contacts list on page
    // Get contacts list container from the DOM
    const contactsWrapper = document.getElementById('contacts-list');
    // Loop through array and display each contact in contact-list div
    for (let contact of contactsList) {
        // Extract contact details
        const id = contact.id;
        const username = contact.name;
        const photoUrl = contact.avatar;
       const last_seen = new Date(contact.last_seen);
        //create img tag to hold contact pic, give it a class name (for styling purposes) and add photo to it
        const contactPhoto = document.createElement('img');
        contactPhoto.classList.add('contact-photo');
        contactPhoto.src = '/storage/'+photoUrl;
      
        // Create div to hold contact Name and add name
        const usernameDiv = document.createElement('div');
        usernameDiv.classList.add('contact-name');
        usernameDiv.innerHTML = username+'<br><span>'+last_seen.getHours()+'hrs ago</span>';
        
    
        // Create contact parent div and add to it contactPhotoDiv and usernameDiv
        const contactContainerDiv = document.createElement('div');
        contactContainerDiv.classList.add('contact-container');

        contactContainerDiv.appendChild(contactPhoto);
        contactContainerDiv.appendChild(usernameDiv);
        contactsWrapper.appendChild(contactContainerDiv);
    };
    
    Talk.ready.then(function() {
    // Create user "me"
    let me = new Talk.User({
        id: currentUser.id,
        name: currentUser.name,
        photoUrl: '/storage/'+currentUser.avatar
    });

    // Start TalkJS Session
    window.talkSession = new Talk.Session({
        appId: 'tlGpkFgB',
        me: me
    });
    
    // Create and mount the chatbox
    const chatbox = talkSession.createChatbox();//{showChatHeader: false});
    chatbox.select(null);
    chatbox.mount(document.getElementById('talkjs-container'));
    
    // Create conversationBuilder objects for each user
    const conversations = contactsList.map(function(user, index) {
        const talkUser = new Talk.User(user); 
        conversation = talkSession.getOrCreateConversation(Talk.oneOnOneId(me, talkUser));
        conversation.setParticipant(me);
        conversation.setParticipant(talkUser);
        conversation.setAttributes({
            photoUrl: '/storage/'+user.avatar,
            subject: ""
        })
        return conversation;
    });
    
    
    // Listen for clicks on each contact and select the appropriate conversation
    let contactsListDivs = document.getElementsByClassName('contact-container');
    
    conversations.forEach(function(conversation, index) {
        contactsListDivs[index].addEventListener('click', () => {
        chatbox.select(conversation);     
        });
        var button = document.getElementById("user-location");
        button.addEventListener("click", function() {
            chatbox.sendLocation(conversation);
        });
    });
  
});