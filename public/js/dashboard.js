const announcementTemplate= document.querySelector("#announcement-details");
const announcementDiv= document.querySelector("aside");
const announcements = document.getElementsByClassName("announcement");
const loaderTemplate = document.querySelector("#loader");
const mainView = document.querySelector("main");
const mapDiv = document.querySelector("#full-map");
const mapButton = document.querySelector(".fa-map").parentElement;
const gridDiv = document.querySelector(".grid-view");
const gridButton = document.querySelector(".fa-th-large").parentElement;
const detailView = document.querySelector("aside");

// used to determine if resolution fits mobile screen sizes
let isMobile;

// buttons and state of current detail view
let backButton;
let followButton;
let isFollow;
let isViewDetails;
let focusId;

// map
let currentMarkers = [];
let isMap = true;
checkForMobile();
viewMain();
showProperHeaderButton();

/// map related:

mapboxgl.accessToken = mapBoxToken;

const map = new mapboxgl.Map({
    container: 'full-map',
    style: 'mapbox://styles/mapbox/light-v10',
    center: [0,0],
    zoom: 0
});

let options = {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0
};
navigator.geolocation.getCurrentPosition(locationSuccess, locationError, [options])

function locationSuccess(pos) {
    map.flyTo({
        center: [pos.coords.longitude,pos.coords.latitude],
        zoom: 12
    })
}

function locationError(err) {
    alert("Unable to get location.");
}

function placeMarker(annElement){
    let pointData = JSON.parse(annElement.querySelector("label").innerHTML);
    let id = annElement.id;
    let marker = document.createElement('div');
    marker.className = 'marker';
    marker.addEventListener("click",function(e){markerOnClick(e,id)})
    new mapboxgl.Marker({
        element: marker
    }).setLngLat(pointData.point).addTo(map);
    currentMarkers.push(marker);
    //annElement.id;
}

function markerOnClick(marker,id)
{
    // this below causes bug in position of marker:
    // currentMarkers.forEach((m)=>{m.className = "marker";})
    // marker.className = "active-marker";
    focusId = id;
    viewDetail();
    fetchAnnouncement(id);
}

function showPlaceName(annElement){
    //annElement.querySelector("p").innerHTML = '<i class="fas fa-map-marker-alt"></i>&nbsp;'
    // TODO request from mapbox api geocoding
}

/////

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

function showProperHeaderButton()
{
    if(isMap){
        mapButton.style.display = "none";
        gridButton.style.display = "flex";
        mapDiv.style.display = "inline";
        gridDiv.style.display = "none";
    }
    else
    {
        mapButton.style.display = "flex";
        gridButton.style.display = "none";
        mapDiv.style.display = "none";
        gridDiv.style.display = "inline";
    }
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
        ann = response.json();
        return ann;
    }).then(function(ann){
        announcementDiv.innerHTML="";
        showDetails(ann);
        let pointData = JSON.parse(ann.location);
        fetch(
            "https://api.mapbox.com/geocoding/v5/mapbox.places/"+pointData.point[0]+","+pointData.point[1]+".json?types=poi&access_token="+mapBoxToken
        ).then(function(response){
            return response.json();
        }).then(function(poi){
            let placeName;
            if(poi.features[0]) placeName = poi.features[0].place_name;
            else placeName = "unnamed place";
            announcementDiv.querySelector("#location").innerHTML = "<i class=\"fas fa-map-marker-alt\"></i>&nbsp;"+placeName;
        });
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

    const time = result.querySelector("#time");
    //console.log(ann.created_at);
    time.innerHTML = "<i class=\"fas fa-clock\"></i>&nbsp;" + formatTimespan(new Date(ann.created_at));

    const owner_picture = result.querySelector(".mini-user-profile>img");
    if(ann.profile_image==null)
        owner_picture.src = "public/img/blank-profile-picture.svg";
    else
        owner_picture.src = "public/uploads/"+ann.profile_image;

    const owner_name = result.querySelector(".mini-user-profile>h2");
    owner_name.innerHTML = ann.name + " " + ann.surname;

    const owner_bio = result.querySelector(".bio");
    owner_bio.innerHTML = ann.bio;

    backButton = result.querySelector("#back-to-map");
    backButton.addEventListener("click",viewMain);


    followButton = result.querySelector("#follow");
    followButton.addEventListener("click",()=>{followClick(focusId)})
    isFollow = ann.follows;
    showFollowUnfollowButton();

    announcementDiv.appendChild(result);
}

// show details sub-function

function formatTimespan(created_at)
{
    return "posted at " + created_at.toLocaleDateString();
}

function showFollowUnfollowButton()
{
    if(isFollow)
        followButton.innerHTML = "<i class=\"far fa-eye-slash\"></i>&nbsp;unfollow announcement";
    else
        followButton.innerHTML = "<i class=\"far fa-eye\"></i>&nbsp;follow announcement";
}

// follow button handling

function followClick(annId)
{
    console.log("followClick "+annId+" "+isFollow);
    if(isFollow) unfollow(annId);
    else follow(annId)
    isFollow = !isFollow;
}

function follow(annId) {
    followButton.innerHTML = "following...";
    fetch("/follow/"+annId).then(function(){
        showFollowUnfollowButton();
    });
}

function unfollow(annId) {
    followButton.innerHTML = "unfollowing...";
    fetch("/unfollow/"+annId).then(function(){
        showFollowUnfollowButton();
    });
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
    showPlaceName(element);
    placeMarker(element);
}

Array.prototype.forEach.call(announcements,(element)=>bindElement(element));

gridButton.addEventListener("click",function(e){
    isMap = false;
    showProperHeaderButton();
});
mapButton.addEventListener("click",function(e){
    isMap = true;
    showProperHeaderButton();
});