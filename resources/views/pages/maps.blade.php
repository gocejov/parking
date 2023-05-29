<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Maps</title>
    <style>
        #map {
            height: 90%;
            width: 100%;
        }

        #saveButton {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div id="map"></div>
<button id="saveButton">Save</button>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=APIKEY&libraries=drawing&callback=initMap"></script>

<script>

    let drawingManager;
    let map;
    let polygonCoordinates = [];
    let polygonName = "";

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"),
            {
                zoom: 17,
                center: {lat: 42.00027542370965, lng: 21.41494029516333},
                mapTypeId: "terrain",
            });

        drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.POLYGON,
            drawingControl: true,
            drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER,
                drawingModes: [google.maps.drawing.OverlayType.POLYGON]
            },
            polygonOptions: {
                strokeColor: "#FF0000",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#FF0000",
                fillOpacity: 0.35,
                editable: true,
                draggable: true,
            }
        });

        drawingManager.setMap(map);

        loadPolygons();

        google.maps.event.addListener(drawingManager, 'overlaycomplete', function (event) {
            if (event.type === google.maps.drawing.OverlayType.POLYGON) {
                const polygon = event.overlay;

                polygonName = prompt('Enter polygon name');

                polygonCoordinates = polygon.getPath().getArray().map(function (point) {
                    return [point.lat(), point.lng()];
                });

                google.maps.event.addListener(polygon.getPath(), 'set_at', function () {
                    polygonCoordinates = polygon.getPath().getArray().map(function (point) {
                        return [point.lat(), point.lng()];
                    });
                });

                google.maps.event.addListener(polygon.getPath(), 'insert_at', function () {
                    polygonCoordinates = polygon.getPath().getArray().map(function (point) {
                        return [point.lat(), point.lng()];
                    });
                });
            }
        });

        $("#saveButton").click(function () {
            if (polygonCoordinates.length > 0 && polygonName !== "") {
                savePolygon(polygonName, polygonCoordinates);
            } else {
                alert("No polygon has been drawn or name is missing");
            }
        });
    }

    const savePolygon = function (name, polygonCoordinates) {
        $.ajax({
            url: "{{ route('save.polygon') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                name: name,
                polygonCoordinates: polygonCoordinates
            },
            success: function (response) {
                console.log(response.message);
                loadPolygons();

            },
            error: function (xhr) {
                console.error(xhr.responseText);

            }
        });
    }
    const loadPolygons = function () {
        $.ajax({
            url: "{{ route('load.polygons') }}",
            type: "GET",
            success: function (response) {
                const polygons = response.data;
                polygons.forEach(function (polygon) {
                    const polygonCoordinates = polygon.vertices;
                    const coordinates = polygonCoordinates.map(function (coordinate) {
                        return {lat: parseFloat(coordinate[0]), lng: parseFloat(coordinate[1])};
                    });

                    const loadedPolygon = new google.maps.Polygon({
                        paths: coordinates,
                        strokeColor: '#FF0000',
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: "#FF0000",
                        fillOpacity: 0.35,
                        editable: true,
                        draggable: true,
                    });
                    loadedPolygon.setMap(map);
                });
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            },
        });
    };

</script>
</body>
</html>
