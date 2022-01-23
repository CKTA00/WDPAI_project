const newButton = document.getElementById("new-button");

function newAnnouncement(){
    location.replace('./new_announcement');
}

newButton.addEventListener("click",newAnnouncement);