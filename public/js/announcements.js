//VARIABLES:
const newButton = document.getElementById("new-button");
const editButton = document.getElementById("edit-button");
const deleteButton = document.getElementById("delete-button");
const announcements = document.getElementsByClassName("announcement");
const announcementsView = document.querySelector("#properties");
const announcementTemplate= document.querySelector("#announcement-properties");
const loaderTemplate = document.querySelector("#loader");
let focusId = document.getElementById("focusId").innerHTML;
const sampleDiv = document.querySelector("main");
let mapDiv;


/// FUNCTIONS:
// aside announcement functions

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
        console.log(focusId);
        fetchAnnouncement(focusId);
    }
}

// properties functions

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
    img.src="public/uploads/"+ann.images;

    const description = result.querySelector(".property>#description");
    description.innerHTML = ann.description;

    mapDiv = result.querySelector("#map");

    announcementsView.appendChild(result);
    let pointData = JSON.parse(ann.location);
    embedMap(pointData.point);
}

// map related

function embedMap(point){
    resizeMap();
    mapboxgl.accessToken = mapBoxToken;
    let map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/light-v10',
        center: point,
        scrollZoom: false,
        dragPan: false,
        dragRotate: false,
        doubleClickZoom: false,
        zoom: 12
    });
    const marker = document.createElement('div');
    marker.className = 'mini-marker';
    new mapboxgl.Marker({
        element: marker
    }).setLngLat(point).addTo(map);
}

// is called by updateMobileView() in mobile_back.js
function resizeMap() {
    if(mapDiv!=null)
    {
        let width = sampleDiv.offsetWidth-97;
        if(width>500) width = 500;
        mapDiv.setAttribute("style","width:"+width+"px");
    }

}

// other

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

// button click functions:

function newAnnouncement(){
    location.replace('./new_announcement');
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

// initial script:

if(focusId > 0)
    fetchAnnouncement(focusId);

newButton.addEventListener("click",newAnnouncement);
editButton.addEventListener("click",editAnnouncement);
deleteButton.addEventListener("click",deleteAnnouncement);
Array.prototype.forEach.call(announcements,(element)=>bindElement(element));