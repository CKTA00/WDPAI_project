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



    // const range = result.querySelector(".property>#range");
    // range.innerHTML = getRangeName(ann.range_id);

    announcementDiv.appendChild(result);
}

// function getRangeName(range)
// {
//     let ret="";
//     switch (range){ // TODO fetch this names from database
//         case 1:
//             ret = "Small (300m)";
//             break;
//         case 2:
//             ret = "Medium (500m)";
//             break;
//         case 3:
//             ret = "Large (1km)";
//             break;
//         case 4:
//             ret = "Very Large (2km)";
//             break;
//     }
//     return ret;
// }

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