<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Maps</title>
    <style>
        #map {
            height: 80%;
            width: 100%;
        }

        #saveButton {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div id="map"></div>

<form id="polygonForm">
    <label for="name">Parking Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="zone"> Zone: </label>
    <select id="zone" name="zone" required>
        <option value="">Select a zone</option>
        @foreach ($zones as $zone)
            <option value="{{ $zone->id }}">{{$zone->name}}</option>
        @endforeach
    </select>

    <button type="button" id="saveButton">Save</button>
    <button type="button" id="deleteButton">Delete</button>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=&libraries=drawing&callback=initMap"></script>

<script>

    let drawingManager;
    let map;
    let polygonCoordinates = [];
    let polygonName = "";
    let selectedPolygon = null;

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
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

        google.maps.event.addListener(drawingManager, "overlaycomplete", function (event) {
            if (event.type === google.maps.drawing.OverlayType.POLYGON) {
                const polygon = event.overlay;

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

        $("#deleteButton").click(function () {
            if (selectedPolygon) {
                const polygonName = selectedPolygon.name;
                deletePolygon(polygonName);
            } else {
                alert("No polygon is selected to delete");
            }
        });
    }

    const savePolygon = function () {
        const name = $("#name").val();
        const zone = $("#zone").val();

        if (name !== "" && zone !== "") {
            if (polygonCoordinates.length > 0) {
                $.ajax({
                    url: "{{ route('save.polygon') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: name,
                        polygonCoordinates: polygonCoordinates,
                        zone: zone,
                    },
                    success: function (response) {
                        console.log(response.message);
                        loadPolygons();
                        $("#name").val(""); // reset input
                        $("#zone").val(""); // reset zone select
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                    },
                });
            } else {
                alert("No polygon drawn");
            }
        } else {
            alert("Please enter a name and select a zone for the polygon");
        }
    };

    $("#saveButton").click(savePolygon);

    const deletePolygon = function (name) {
        if (selectedPolygon) {
            $.ajax({
                url: "{{ route('delete.polygon') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    name: name,
                },
                success: function (response) {
                    console.log(response.message);
                    loadPolygons();
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                },
            });
        } else {
            alert("No polygon selected for deletion");
        }
    };

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
                        strokeColor: "#FF0000",
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: "#FF0000",
                        fillOpacity: 0.35,
                        editable: true,
                        draggable: true,
                    });
                    loadedPolygon.name = polygon.name;
                    loadedPolygon.setMap(map);

                    google.maps.event.addListener(loadedPolygon, "click", function () {
                        selectedPolygon = loadedPolygon;
                        populateFormFields(selectedPolygon);
                    });
                });
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            },
        });
    };

    const populateFormFields = function (polygon) {
        const polygonNameInput = document.getElementById("name");
        polygonNameInput.value = polygon.name;
    };

</script>
</body>
</html>
