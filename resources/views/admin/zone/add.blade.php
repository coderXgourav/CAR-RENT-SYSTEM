@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.zone.store', @$zone->id) }}" method="POST" id="zoneForm">
                        @csrf
                        <input type="hidden" name="coordinates" id="coordinates">
                        <input type="hidden" name="zoom" id="zoom">
                        <div class="form-group">
                            <label>@lang('Name')</label>
                            <input type="text" name="name" value="{{ old('name', @$zone->name) }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>@lang('Mark Your Zone')<span class="text--danger">*</span></label>
                            <input id="pac-input" class="controls" type="text" placeholder="Search Box">
                            <div id="map-canvas"></div>
                        </div>
                        <button id="deleteButton">@lang('Delete Selected Area')</button>
                        <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        #map-canvas {
            height: 500px;
            width: 100%;
            margin-bottom: 20px;
        }

        #pac-input {
            background-color: #fff;
            padding: 0.5em;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
    </style>
@endpush

@push('script-lib')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ gs('api_key') }}&libraries=drawing,places"></script>
@endpush
@push('script')
    <script>
        var mapOptions;
        var map;

        var coordinates = [];
        let new_coordinates = [];
        let lastElement;
        let zoom = Number(`{{ @$zone->zoom }}`) ?? 14;

        function InitMap() {
            var location = new google.maps.LatLng("{{ $initLat }}", "{{ $initLong }}");
            mapOptions = {
                zoom: zoom,
                center: location,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
            };
            map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
            var all_overlays = [];
            var selectedShape;
            var drawingManager = new google.maps.drawing.DrawingManager({
                drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_CENTER,
                    drawingModes: [google.maps.drawing.OverlayType.POLYGON],
                },
                markerOptions: {},
                circleOptions: {
                    fillColor: "#ffff00",
                    fillOpacity: 0.2,
                    strokeWeight: 3,
                    clickable: false,
                    editable: true,
                    zIndex: 1,
                },
                polygonOptions: {
                    clickable: true,
                    draggable: false,
                    editable: true,
                    fillColor: "#ADFF2F",
                    fillOpacity: 0.5,
                },
                rectangleOptions: {
                    clickable: true,
                    draggable: true,
                    editable: true,
                    fillColor: "#ffff00",
                    fillOpacity: 0.5,
                },
            });

            function clearSelection() {
                if (selectedShape) {
                    selectedShape.setEditable(false);
                    selectedShape = null;
                }
            }

            function stopDrawing() {
                drawingManager.setMap(null);
            }

            function setSelection(shape) {
                clearSelection();
                stopDrawing();
                selectedShape = shape;
                shape.setEditable(true);
            }

            function deleteSelectedShape() {
                if (selectedShape) {
                    selectedShape.setMap(null);
                    drawingManager.setMap(map);
                    coordinates.splice(0, coordinates.length);
                    document.getElementById("coordinates").value = "";
                }
            }

            function CenterControl(controlDiv, map) {
                var controlUI = document.createElement("div");
                controlUI.style.backgroundColor = "#fff";
                controlUI.style.border = "2px solid #fff";
                controlUI.style.borderRadius = "3px";
                controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
                controlUI.style.cursor = "pointer";
                controlUI.style.marginBottom = "22px";
                controlUI.style.textAlign = "center";
                controlUI.title = "Select to delete the shape";
                controlDiv.appendChild(controlUI);

                var controlText = document.createElement("div");
                controlText.style.color = "rgb(25,25,25)";
                controlText.style.fontFamily = "Roboto,Arial,sans-serif";
                controlText.style.fontSize = "16px";
                controlText.style.lineHeight = "38px";
                controlText.style.paddingLeft = "5px";
                controlText.style.paddingRight = "5px";
                controlText.innerHTML = "Delete Selected Area";
                controlUI.appendChild(controlText);

                controlUI.addEventListener("click", function() {
                    deleteSelectedShape();
                });
            }

            drawingManager.setMap(map);

            var getPolygonCoords = function(newShape) {

                coordinates.splice(0, coordinates.length)

                var len = newShape.getPath().getLength();

                for (var i = 0; i < len; i++) {
                    coordinates.push(newShape.getPath().getAt(i).toUrlValue(6))
                }
                document.getElementById('coordinates').value = coordinates
                document.getElementById('zoom').value = map.getZoom();
                console.log(map.getZoom());
            }

            google.maps.event.addListener(drawingManager, 'polygoncomplete', function(event) {
                event.getPath().getLength();
                google.maps.event.addListener(event, "dragend", getPolygonCoords(event));

                google.maps.event.addListener(event.getPath(), 'insert_at', function() {
                    getPolygonCoords(event)

                });

                google.maps.event.addListener(event.getPath(), 'set_at', function() {
                    getPolygonCoords(event)
                })
            })

            google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
                all_overlays.push(event);
                if (event.type !== google.maps.drawing.OverlayType.MARKER) {
                    drawingManager.setDrawingMode(null);

                    var newShape = event.overlay;
                    newShape.type = event.type;
                    google.maps.event.addListener(newShape, 'click', function() {
                        setSelection(newShape);
                    });
                    setSelection(newShape);
                }
            })

            var centerControlDiv = document.createElement("div");
            var centerControl = new CenterControl(centerControlDiv, map);

            centerControlDiv.index = 1;
            map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(
                centerControlDiv
            );


            function createPolygonFromCoords(coords) {
                var coordinatesArray = coords.split(",");
                var path = [];
                for (var i = 0; i < coordinatesArray.length; i += 2) {
                    path.push({
                        lat: parseFloat(coordinatesArray[i]),
                        lng: parseFloat(coordinatesArray[i + 1])
                    });
                }
                var polygon = new google.maps.Polygon({
                    paths: path,
                    map: map,
                    editable: true,
                    draggable: false,
                });

                google.maps.event.addListener(polygon.getPath(), 'set_at', function() {
                    updateCoordinates(polygon);
                });

                google.maps.event.addListener(polygon.getPath(), 'insert_at', function() {
                    updateCoordinates(polygon);
                });

                google.maps.event.addListener(polygon.getPath(), 'remove_at', function() {
                    updateCoordinates(polygon);
                });

                selectedShape = polygon;
            }

            if ("{{ @$zone->id }}") {
                createPolygonFromCoords("{{ @$zone->coordinates }}");
            }

            function updateCoordinates(polygon) {
                var path = polygon.getPath();
                var coords = [];
                for (var i = 0; i < path.getLength(); i++) {
                    var vertex = path.getAt(i);
                    coords.push(vertex.lat().toFixed(6) + ',' + vertex.lng().toFixed(6));
                }
                document.getElementById("coordinates").value = coords.join(',');
            }


            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);

            map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());
            });

            var markers = [];
            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                markers.forEach(function(marker) {
                    marker.setMap(null);
                });
                markers = [];

                var bounds = new google.maps.LatLngBounds();
                places.forEach(function(place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    var icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };

                    markers.push(new google.maps.Marker({
                        map: map,
                        icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    }));

                    if (place.geometry.viewport) {
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });

        }

        $(document).ready(function() {
            InitMap();
        });
    </script>
@endpush
