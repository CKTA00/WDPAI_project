const newButton = document.getElementById("new-button");
const announcements = document.getElementsByClassName("announcement");
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
    focusId = element.id;
}

function editButtonPressed()
{

}

function postEditAnnouncement(announcement_id){
    const form = document.createElement('form');
    form.method = 'post';
    form.action = './edit_announcement';

    const hiddenField = document.createElement('input');
    hiddenField.type = 'hidden';
    hiddenField.name = 'id';
    hiddenField.value = announcement_id;
    form.appendChild(hiddenField);

    document.body.appendChild(form);
    form.submit();
}

function bindElement(element)
{
    element.addEventListener("click",function(e){showAnnouncement(element)})
}

newButton.addEventListener("click",newAnnouncement);
Array.prototype.forEach.call(announcements,(element)=>bindElement(element));