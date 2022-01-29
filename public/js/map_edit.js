const sampleDiv = document.querySelector(".property");
const mapDiv = document.querySelector("#map").parentElement;
resizeMap();

mapboxgl.accessToken = 'pk.eyJ1IjoiY2t0YTAwIiwiYSI6ImNrdmNkYWViMjA0bngydW4zbnAxdzR1bGcifQ.wybkM1qtvY9WiHa1AxRlgQ';
const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/light-v10',
    center: [50.0614300,19.9365800],
    zoom: 3
});

function resizeMap() {
    mapDiv.setAttribute("style","width:"+(sampleDiv.offsetWidth-32)+"px");
}

window.onresize = resizeMap;