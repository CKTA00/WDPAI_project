const announcementTemplate= document.querySelector("#announcement-details");
const announcementDiv= document.querySelector("aside");
const announcements = document.getElementsByClassName("announcement");
const loaderTemplate = document.querySelector("#loader");
let focusId;
console.log(announcements);

function deactivateAnnouncement(element)
{
    element.classList.remove("active-ann");
}

function showAnnouncement(element){
    Array.prototype.forEach.call(announcements,(ann)=>deactivateAnnouncement(ann));
    element.classList.add('active-ann');
    viewMain();
    focusId = element.id;
    console.log(focusId);
    fetchAnnouncement(focusId);

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
    location.innerHTML = ann.location; //TODO: get location name

    const time = result.querySelector("#time");
    time.innerHTML = ann.created_at;

    const owner_picture = result.querySelector(".user-profile>img");
    if(ann.profile_image==null)
        owner_picture.src = "public/img/blank-profile-picture.svg";
    else
        owner_picture.src = "public/uploads/"+ann.profile_image;

    const owner_name = result.querySelector(".user-profile>h2");
    owner_name.innerHTML = ann.name + " " + ann.surname;

    const follow_button = result.querySelector("#follow");
    if(ann.follows)
        follow_button.innerHTML = "unfollow announcement";
    else
        follow_button.innerHTML = "follow announcement";

    const chat_button = result.querySelector("#chat");

    announcementDiv.appendChild(result);
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