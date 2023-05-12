<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Maps</title>
</head>
<body>
<div id="map" style=" height: 100%;">

</div>
</body>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAefChyue0fuj9bFgwMHU54_oeKay17_Z4&callback=initMap"></script>

<script>
    function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 17,
            center: {lat: 42.00027542370965, lng: 21.41494029516333},
            mapTypeId: "terrain",
        });
        const cityParkCoords = [
            {lat: 42.009609650375005, lng: 21.412038682182907},
            {lat: 42.00929587157767, lng: 21.411943589176275},
            {lat: 42.00909868187948, lng: 21.41313723446667},
            {lat: 42.0092648723629, lng: 21.413181271865515},
        ];
        const cityPark = new google.maps.Polygon({
            paths: cityParkCoords,
            strokeColor: "#FF0000",
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: "#FF0000",
            fillOpacity: 0.35,
        });

        const zooParkCoords = [
            {lat: 42.0047925397074, lng: 21.418714306140984},
            {lat: 42.004931220763964, lng: 21.418808001029397},
            {lat: 42.005685606576854, lng: 21.41734837942629},
            {lat: 42.00557279741044, lng: 21.41720815507733}
        ]

        const zooPark = new google.maps.Polygon({
            paths: zooParkCoords,
            strokeColour: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35,
        });

        cityPark.setMap(map);
        zooPark.setMap(map);
    }
</script>
</html>
