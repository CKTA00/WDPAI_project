const newButton = document.getElementById("new-button");
const editButton = document.getElementById("edit-button");
const deleteButton = document.getElementById("delete-button");
const announcements = document.getElementsByClassName("announcement");
const announcementsView = document.querySelector("main>div");
const announcementTemplate= document.querySelector("#announcement-properties");
const loaderTemplate = document.querySelector("#loader");
let focusId = document.getElementById("focusId").innerHTML;

function newAnnouncement(){
    location.replace('./new_announcement');
}

function deactivateAnnouncement(element)
{
    element.classList.remove("active-ann");
}

function showAnnouncement(element){
    Array.prototype.forEach.call(announcements,(ann)=>deactivateAnnouncement(ann));
    element.classList.add('active-ann');
    viewMain();

    if(focusId != element.id)
    {
        focusId = element.id;
        fetchAnnouncement(focusId);
    }
}

function fetchAnnouncement(annId)
{
    announcementsView.innerHTML="";
    const loader = loaderTemplate.content.cloneNode(true);
    announcementsView.appendChild(loader);
    fetch("/get_announcement/"+annId).then(function(response){
        return response.json();
    }).then(function(ann){
        announcementsView.innerHTML="";
        showProperties(ann);
    });

}

function showProperties(ann)
{
    const result = announcementTemplate.content.cloneNode(true);

    const title = result.querySelector(".property>h1");
    title.innerHTML = ann.title;

    const img = result.querySelector(".image-container>img");
    img.src="public/uploads/"+ann.images; //TODO: multiple photos

    const description = result.querySelector(".property>#description");
    description.innerHTML = ann.description;

    //TODO: update map location

    const range = result.querySelector(".property>#range");
    range.innerHTML = getRangeName(ann.range_id);

    announcementsView.appendChild(result);
}

function getRangeName(range)
{
    let ret="";
    switch (range){ // TODO fetch this names from database
        case 1:
            ret = "Small (300m)";
            break;
        case 2:
            ret = "Medium (500m)";
            break;
        case 3:
            ret = "Large (1km)";
            break;
        case 4:
            ret = "Very Large (2km)";
            break;
    }
    return ret;
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

function deleteAnnouncement(){
    if(window.confirm("Are you sure you want ot delete this announcement?")){
        const form = document.createElement('form');
        form.method = 'post';
        form.action = './delete_announcement';
        submitIdForm(form);
    }
}

function editAnnouncement(){
    const form = document.createElement('form');
    form.method = 'post';
    form.action = './edit_announcement';
    submitIdForm(form);
}

function bindElement(element)
{
    element.addEventListener("click",function(e){showAnnouncement(element)})
}

newButton.addEventListener("click",newAnnouncement);
editButton.addEventListener("click",editAnnouncement);
deleteButton.addEventListener("click",deleteAnnouncement);
Array.prototype.forEach.call(announcements,(element)=>bindElement(element));