let backButton;
let mainDiv = document.querySelector("main");
let asideDiv = document.querySelector("aside");

isMobile = false;
isViewingMain = false;

assignBackButton();
checkForMobile();

function assignBackButton() //call in other script
{
    backButton = document.querySelector(".fa-chevron-left");
    if(backButton != null)
    {
        backButton = backButton.parentElement;
        backButton.addEventListener("click",goBack);
    }
}

function checkForMobile() {
    let w = window.innerWidth;
    if(w<635)
    {
        isMobile = true;
        if(backButton != null) backButton.style.display = "flex";
        updateMobileView();
    }
    else{
        isMobile = false;
        if(backButton != null) backButton.style.display = "none";
        mainDiv.style.display = "flex";
        asideDiv.style.display = "flex";
    }
    if(resizeMap!=null)
        resizeMap();
}

window.onresize = checkForMobile;


function goBack() {
    if(isMobile){
        isViewingMain = false;
        updateMobileView();
    }
}

function viewMain(){
    if(isMobile){
        isViewingMain = true;
        updateMobileView();
    }
}

function updateMobileView(){
    if(isViewingMain){
        mainDiv.style.display = "flex";
        asideDiv.style.display = "none";
    }
    else{
        mainDiv.style.display = "none";
        asideDiv.style.display = "flex";
    }
}