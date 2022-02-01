const nav = document.querySelector('nav');
const dashboardNavButton = nav.querySelector(".fa-map-marked-alt").parentElement;
const followsNavButton = nav.querySelector(".fa-eye").parentElement;
const announcementsNavButton = nav.querySelector(".fa-id-badge").parentElement;
const optionsNavButton = nav.querySelector(".fa-cog").parentElement;

//TODO
//dashboardNavButton.classList.add("active-tab");

function navigateDashboard() {
    location.replace('./dashboard');
}

function navigateFollowed() {
    location.replace('./followed');
}

function navigateAnnouncements() {
    location.replace('./announcements');
}


function navigateOptions() {
    location.replace('./options');
}

dashboardNavButton.addEventListener("click",navigateDashboard);
followsNavButton.addEventListener("click",navigateFollowed);
announcementsNavButton.addEventListener("click",navigateAnnouncements);
optionsNavButton.addEventListener("click",navigateOptions);