let options = document.querySelector('aside');
let logOutButton = options.querySelector(".fa-sign-out-alt");
logOutButton = logOutButton.parentElement;
let profileButton = options.querySelector(".fa-user-circle");
profileButton = profileButton.parentElement;
let deletePictureButton;
let savePictureButton;
let detailsDiv = document.querySelector("main");
let userProfileDetailsTemplate = document.querySelector("#user-profile-details");

function logout() {
    location.replace('./logout');
}


function changeProfileData() {
    detailsDiv.innerHTML="";
    const profileDetails = userProfileDetailsTemplate.content.cloneNode(true);
    detailsDiv.appendChild(profileDetails);
    // Add events to just loaded buttons:
    savePictureButton = detailsDiv.querySelector("#save-button");
    savePictureButton.addEventListener("click",saveChangesToProfile);
    deletePictureButton = document.querySelector(".image-container>button");
    deletePictureButton.addEventListener("click",function (event) {
            event.preventDefault();
            deletePicture();
        }
    );
    assignBackButton();
    viewMain();
    checkForMobile();
}

function saveChangesToProfile() {
    const form = document.querySelector("form");
    form.submit();
}


function deletePicture() {
    if(window.confirm("Are you sure you want to delete your profile picture? It will be replaced by default picture.")){
        location.replace('./deleteProfileImage');
    }
}


logOutButton.addEventListener("click",logout);
profileButton.addEventListener("click",changeProfileData);
