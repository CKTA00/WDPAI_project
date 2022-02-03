// VARIABLES:
const sampleDiv = document.querySelector(".property");
const mapDiv = document.querySelector("#map").parentElement;
const locationInput = document.querySelector('.location');
let currentMarker;

///FUNCTIONS:
// location realted functions
function locationSuccess(pos) {
    locationInput.innerHTML = '{"point":['+pos.coords.longitude+","+pos.coords.latitude+"]}";
    map.flyTo({
        center: [pos.coords.longitude,pos.coords.latitude],
        zoom: 12
    })
    placeMarker();
}

function locationError(err) {
    alert("Unable to get location.");
}

// map size on window resize (and on back button in mobile_ack.js)
function resizeMap()
{
    let width = sampleDiv.offsetWidth-32;
    if(width>500) width = 500;
    mapDiv.setAttribute("style","width:"+width+"px");
}

//replaces text in invisible locationInput <input> to submit it later
function inputLocationJSON(rawPoint)
{
    locationInput.innerHTML = '{"point":['+rawPoint.lng+','+rawPoint.lat+']}';
}

// replace marker with new if one existed
function placeMarker(){
    if(locationInput.innerHTML)
    {
        let pointData = JSON.parse(locationInput.innerHTML);
        if(currentMarker!=null)
            currentMarker.remove();
        currentMarker = document.createElement('div');
        currentMarker.className = 'marker';
        new mapboxgl.Marker({
            element: currentMarker
        }).setLngLat(pointData.point).addTo(map);
    }
}

/// INITIAL SCRIPT:

resizeMap();

mapboxgl.accessToken = mapBoxToken;

let initPoint = [0,0];
if(locationInput.innerHTML)
{
    initPoint = JSON.parse(locationInput.innerHTML).point;
}
else{
    let options = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0
    };
    navigator.geolocation.getCurrentPosition(locationSuccess, locationError, [options])
    locationInput.innerHTML = '{"point":[0.0,0.0]}';
}

const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/light-v10',
    center: initPoint,
    zoom: 12
});

placeMarker();

map.on('click', (e) => {

    inputLocationJSON(e.lngLat.wrap());
    placeMarker();
});

window.onresize = resizeMap;