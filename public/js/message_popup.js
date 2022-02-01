let messages = document.querySelector("body>.messages");
setTimeout(vanishMessages,8000);

function vanishMessages(){
    if(messages)
        messages.style.display ="none";
}

