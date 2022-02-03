///VARIABLES
// aside
const options = document.querySelector('aside');
const logOutButton = options.querySelector(".fa-sign-out-alt").parentElement;
const imageButton = options.querySelector(".fa-user-circle").parentElement;
const detailsButton = options.querySelector(".fa-user-edit").parentElement;

// main
let detailsDiv = document.querySelector("main");

// temporary buttons of picture changing
let deletePictureButton;
let saveButton;

//templates
let userProfileImageTemplate = document.querySelector("#user-profile-image");
let userProfileDetailsTemplate = document.querySelector("#user-profile-details");

///FUNCTIONS:

function resizeMap(){} // is called by updateMobileView() in mobile_back.js (no map in options so empty)

function logout() {
    location.replace('./logout');
}

function saveChangesToProfile() {
    const form = document.querySelector("form");
    form.submit();
}

function changeProfilePicture() {
    detailsDiv.innerHTML="";
    const profileDetails = userProfileImageTemplate.content.cloneNode(true);
    detailsDiv.appendChild(profileDetails);
    // Add events to just loaded buttons:
    saveButton = detailsDiv.querySelector("#save-button");
    saveButton.addEventListener("click",saveChangesToProfile);
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

function deletePicture() {
    if(window.confirm("Are you sure you want to delete your profile picture? It will be replaced by default picture.")){
        location.replace('./delete_profile_image');
    }
}

function changeBio() {
    detailsDiv.innerHTML="";
    const profileDetails = userProfileDetailsTemplate.content.cloneNode(true);
    detailsDiv.appendChild(profileDetails);
    // Add events to just loaded buttons:
    saveButton = detailsDiv.querySelector("#save-button");
    saveButton.addEventListener("click",saveChangesToProfile);
    let bioInput = detailsDiv.querySelector("textarea");
    bioInput.innerHTML = "loading...";
    bioInput.disabled = true;
    fetch("/get_bio").then(function(response){
        return response.json();
    }).then(function(details){
        if(details)
            bioInput.innerHTML = details.bio;
        bioInput.disabled = false;
    });

    // calling 3 functions in mobile_back.js to show main
    assignBackButton();
    viewMain();
    checkForMobile();
}

/// INITIAL SCRIP:

logOutButton.addEventListener("click",logout);
imageButton.addEventListener("click",changeProfilePicture);
detailsButton.addEventListener("click",changeBio);
