let messages = document.querySelectorAll("body>.message");
setTimeout(vanishMessages,8000);

function vanishMessages(){
    messages.forEach(function(msg){msg.style.display ="none"});
}

