let nav = document.querySelector('nav');
let dashboardNavButton = nav.querySelector(".fa-map-marked-alt");
dashboardNavButton = dashboardNavButton.parentElement;
let chatsNavButton = nav.querySelector(".fa-comments");
chatsNavButton = chatsNavButton.parentElement;
let announcementsNavButton = nav.querySelector(".fa-clipboard-list");
announcementsNavButton = announcementsNavButton.parentElement;
let optionsNavButton = nav.querySelector(".fa-cog");
optionsNavButton = optionsNavButton.parentElement;


function navigateDashboard() {
    location.replace('./dashboard');
}


function navigateChats() {
    location.replace('./chats');
}

function navigateAnnouncements() {
    location.replace('./announcements');
}

function navigateOptions() {
    location.replace('./options');
}

dashboardNavButton.addEventListener("click",navigateDashboard);
chatsNavButton.addEventListener("click",navigateChats);
announcementsNavButton.addEventListener("click",navigateAnnouncements);
optionsNavButton.addEventListener("click",navigateOptions);