function initMap() {
    var markerArray = [];

    // Instantiate a directions service.
    var directionsRenderer = new google.maps.DirectionsRenderer;
    var directionsService = new google.maps.DirectionsService;
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 14,
        center: geo.center
    });
    directionsRenderer.setMap(map);
    // Instantiate an info window to hold step text.
    var stepDisplay = new google.maps.InfoWindow;

    calculateAndDisplayRoute(directionsService, directionsRenderer, markerArray, stepDisplay, map);


}

function calculateAndDisplayRoute(directionsService, directionsRenderer, markerArray, stepDisplay, map) {

    for (var i = 0; i < markerArray.length; i++) {
        markerArray[i].setMap(null);
    }

    directionsService.route({
        origin: new google.maps.LatLng(geo.load.lat, geo.load.lon),
        destination: new google.maps.LatLng(geo.unload.lat, geo.unload.lon),
        travelMode: 'DRIVING'
    }, function (response, status) {
        if (status == 'OK') {
            directionsRenderer.setDirections(response);
            //showSteps(response, markerArray, stepDisplay, map);
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}


function showSteps(directionResult, markerArray, stepDisplay, map) {
    // For each step, place a marker, and add the text to the marker's infowindow.
    // Also attach the marker to an array so we can keep track of it and remove it
    // when calculating new routes.
    var myRoute = directionResult.routes[0].legs[0];
    for (var i = 0; i < myRoute.steps.length; i++) {
        var marker = markerArray[i] = markerArray[i] || new google.maps.Marker;
        var image = '/assets/img/map-marker.png';
        marker.setIcon(image);
        marker.setMap(map);
        marker.setPosition(myRoute.steps[i].start_location);
        attachInstructionText(
            stepDisplay, marker, myRoute.steps[i].instructions, map);
    }
}

function attachInstructionText(stepDisplay, marker, text, map) {
    google.maps.event.addListener(marker, 'click', function () {
        // Open an info window when the marker is clicked on, containing the text
        // of the step.
        stepDisplay.setContent(text);
        stepDisplay.open(map, marker);
    });
}
