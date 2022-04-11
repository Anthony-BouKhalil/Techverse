<head>
    <style>
    *{
	    margin: 0;
	    padding: 0;
	}
	#map{
	    height: 600px;
	    width: 700px;
	}    
    .center {
        text-align: center;
        padding: 15px;
    }
    .container{
        display: flex;
        justify-content: center;
    }
    .sub-container{
        display: flex;
        padding-left: 10%;
        padding-top: 5%;
    }
    </style>

</head>
<body ng-controller="InvoiceController">
    <div class="container">
        <div id="map"></div>
        
        <div class="sub-container">
            <div class='center'>
                <h2>Invoice</h2><br><br>
                Name: {{checkout.name}}<br>
                Email: {{checkout.email}}<br><br>
                Delivery Date: {{checkout.date}}<br>
                Delivery Time: {{checkout.time}}<br><br>
                
                <h5>Products</h5>
                <div ng-repeat="product in cart">
                  {{product.name}}<br>
                  Type: {{product.type}}<br>
                  Price: ${{product.unit_price}} CAD<br><br>
                </div>
                <b>Total:</b> ${{total_price}} CAD
                <br><br>

                <form ng-submit="confirm_purchase()">
                    <input value="Confirm Purchase" type='submit' name='submit' class='btn btn-success'/>
                </form>
            </div>
        </div>
    </div>
    
<!-- Java Script -->
<script>
  var coord  = $scope.branch.split(',');
    var latitude = parseFloat(parseFloat(coord[0]).toFixed(6));
    var longitude = parseFloat(parseFloat(coord[1]).toFixed(6));


    // function to calculate distance between two points
    function haversine_distance(mk1, mk2) {
        var R = 3958.8; // Radius of the Earth in miles
        var rlat1 = mk1.position.lat() * (Math.PI/180); // Convert degrees to radians
        var rlat2 = mk2.position.lat() * (Math.PI/180); // Convert degrees to radians
        var difflat = rlat2-rlat1; // Radian difference (latitudes)
        var difflon = (mk2.position.lng()-mk1.position.lng()) * (Math.PI/180); // Radian difference (longitudes)

        var d = 2 * R * Math.asin(Math.sqrt(Math.sin(difflat/2) * Math.sin(difflat/2) + Math.cos(rlat1) * Math.cos(rlat2) * Math.sin(difflon/2) * Math.sin(difflon/2)));
        return d;
    }

    let map, infoWindow;
    
    // Initialize the map
    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            // once initialized, map centers around 'center'
            center: { lat: 40.774102, lng: -73.971734 },
            zoom: 11,
        });

        infoWindow = new google.maps.InfoWindow();
        const locationButton = document.createElement("button");

        locationButton.textContent = "Calculate Location";
        locationButton.classList.add("custom-map-control-button");
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);

        // the following only gets executed if the user hits "Calculate Location"
        locationButton.addEventListener("click", () => {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position) => {
                    const userPosition = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };
                    
                    infoWindow.setPosition(userPosition);
                    infoWindow.setContent("You are here!"); // current user location pointer (points to EXACT locaiton)
                    infoWindow.open(map);
                    map.setCenter(userPosition);
                    
                    const location = {lat: latitude, lng: longitude};

                    var position1 = new google.maps.Marker({position: userPosition, map: map});
                    var position2 = new google.maps.Marker({position: location, map: map});
                    var line = new google.maps.Polyline({path: [userPosition, location], map: map});

                    var distance = haversine_distance(posititon1, posititon2);

                    // calculates the distance between the points in miles
                    document.getElementById('msg').innerHTML = "Distance between location: " + distance.toFixed(2) + " mi.";

                }, () => {
                    handleLocationError(true, infoWindow, map.getCenter());
                }
            );
            } else {
                // User did not accept permission on browser
                handleLocationError(false, infoWindow, map.getCenter());
            }
        });
    }

</script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2mAYmeS6wL_5Tvn86c3Ij2xPQtHb5CaY&callback=initMap">
</script>
</body>
