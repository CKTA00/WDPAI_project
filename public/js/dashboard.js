const announcementTemplate= document.querySelector("#announcement-details");
const announcementDiv= document.querySelector("aside");
const announcements = document.getElementsByClassName("announcement");
const loaderTemplate = document.querySelector("#loader");
const mainView = document.querySelector("main");
const detailView = document.querySelector("aside");
let backButton;

let focusId;
let isMobile;
let isViewDetails;
checkForMobile();
viewMain();

function checkForMobile() {
    let w = window.innerWidth;
    if(w<635)
    {
        isMobile = true;
        if(isViewDetails)
        {
            viewDetail();
        }
        else{
            viewMain();
        }
    }
    else{
        isMobile = false;
        if(isViewDetails)
        {
            detailView.style.display = "flex";
        }
        mainView.style.display = "flex";
    }
}
window.onresize = checkForMobile;

function viewDetail()
{
    if(isMobile)
    {
        mainView.style.display = "none";
    }
    detailView.style.display = "flex";
    isViewDetails = true;
}

function viewMain()
{
    mainView.style.display = "flex";
    detailView.style.display = "none";
    isViewDetails = false;
}

function deactivateAnnouncement(element)
{
    element.classList.remove("active-ann");
}

function showAnnouncement(element){
    Array.prototype.forEach.call(announcements,(ann)=>deactivateAnnouncement(ann));
    element.classList.add('active-ann');
    viewDetail();
    if(focusId!=element.id)
    {
        focusId = element.id;
        fetchAnnouncement(focusId);
    }
}

function fetchAnnouncement(annId)
{
    announcementDiv.innerHTML="";
    const loader = loaderTemplate.content.cloneNode(true);
    announcementDiv.appendChild(loader);
    fetch("/get_announcement_JSON/"+annId).then(function(response){
        return response.json();
    }).then(function(ann){
        announcementDiv.innerHTML="";
        showDetails(ann);
    });

}

function showDetails(ann)
{
    const result = announcementTemplate.content.cloneNode(true);

    const title = result.querySelector("h2");
    title.innerHTML = ann.title;

    const img = result.querySelector("img");
    img.src="public/uploads/"+ann.images;

    const description = result.querySelector("#description");
    description.innerHTML = ann.description;

    const location = result.querySelector("#location");
    location.innerHTML = "<i class=\"fas fa-map-marker-alt\"></i>&nbsp;"+ann.location; //TODO: get location name

    const time = result.querySelector("#time");
    console.log(ann.created_at);
    time.innerHTML = "<i class=\"fas fa-clock\"></i>&nbsp;" + formatTimespan(new Date(ann.created_at));

    const owner_picture = result.querySelector(".mini-user-profile>img");
    if(ann.profile_image==null)
        owner_picture.src = "public/img/blank-profile-picture.svg";
    else
        owner_picture.src = "public/uploads/"+ann.profile_image;

    const owner_name = result.querySelector(".mini-user-profile>h2");
    owner_name.innerHTML = ann.name + " " + ann.surname;

    back_button = result.querySelector("#back-to-map");
    back_button.addEventListener("click",viewMain);


    const follow_button = result.querySelector("#follow");
    if(ann.follows)
        follow_button.innerHTML = "unfollow announcement";
    else
        follow_button.innerHTML = "follow announcement";

    const chat_button = result.querySelector("#chat");

    announcementDiv.appendChild(result);
}

function formatTimespan(created_at)
{
    // let timespan = Date.now() - created_at;
    // console.log(Date.now());
    // console.log(created_at);
    // timespan = Math.floor(timespan/1000);
    // console.log(timespan);
    // if(timespan<60) return "just a moment ago";
    // timespan = Math.floor(timespan/60);
    // if(timespan<120) return timespan + " minutes ago";
    // timespan = Math.floor(timespan/60);
    // if(timespan<48) return timespan + " hours ago";
    // timespan = Math.floor(timespan/24);
    // if(timespan<31) return timespan + " days ago";
    return "posted at " + created_at.toLocaleDateString();
}

function submitIdForm(form)
{
    const hiddenField = document.createElement('input');
    hiddenField.type = 'hidden';
    hiddenField.name = 'id';
    hiddenField.value = focusId;
    form.appendChild(hiddenField);

    document.body.appendChild(form);
    form.submit();
}

function getAnnouncement(){
    const form = document.createElement('form');
    form.method = 'post';
    form.action = './edit_announcement';
    submitIdForm(form);
}

function bindElement(element)
{
    element.addEventListener("click",function(e){showAnnouncement(element)})
}

Array.prototype.forEach.call(announcements,(element)=>bindElement(element));