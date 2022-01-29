const sampleDiv = document.querySelector(".property");
const mapDiv = document.querySelector("#map").parentElement;
resizeMap();

mapboxgl.accessToken = mapBoxToken;

const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/light-v10',
    center: [50.0614300,19.9365800],
    zoom: 10
});

function resizeMap() {
    let width = sampleDiv.offsetWidth-32;
    if(width>500) width = 500;
    mapDiv.setAttribute("style","width:"+width+"px");
}

window.onresize = resizeMap;