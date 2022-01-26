let backButton = document.querySelector(".fa-chevron-left");
backButton = backButton.parentElement;

function goBack() {
    window.history.back()
}

backButton.addEventListener("click",goBack);