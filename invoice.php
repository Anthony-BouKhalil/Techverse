<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" type="text/css" href="styles/main-page.css">
    <link rel="stylesheet"  type="text/css" href="bootstrap/css/bootstrap.css"></link>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    
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
<body>
    <?php require 'header.php';?>
    <div class="container">
        <div id="map"></div>
        
    <div class="sub-container">
        <?php 
        echo "<div class='center'>";

            $conn = mysqli_connect('localhost', 'root', '', 'scsstore');
            
            echo "<h2>Invoice</h2><br><br>";
            echo "Name: " . $_SESSION['name'] . "<br>"; 
            echo "Email: " . $_SESSION['email'] . "<br><br>"; 

            echo "Delivery Date: " . $_SESSION['date'] . "<br>";
            echo "Delivery Time: " . $_SESSION['time'] . "<br><br>";


            if (isset($_SESSION['cart'])) {
                $len = array_key_last($_SESSION['cart']);

                $total_price = 0;
                for ($i = 0; $i <= $len; $i++) {
                    if(isset($_SESSION['cart'][$i])) {
                        $sql = "SELECT * FROM product WHERE product_id = " . $_SESSION['cart'][$i];
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "Product: " . $row['name'] . "<br>";
                                echo "Type: " . $row['type'] . "<br>";
                                echo "Price: $" . $row['unit_price'] . " CAD<br><br>";
                                $total_price = $total_price + $row['unit_price'];
                            }
                        }
                    }
                }
                echo "<b>Total:</b> $" . $total_price . " CAD <br><br>";
                $_SESSION['total'] = $total_price;
            }

            echo "<form action='purchase.php' method='POST'>";
            echo "<a href='purchase.php'><button type='button' name='submit' class='btn btn-success'> Confirm Purchase</button></a>";
            echo "</form>";
            echo "</div>";
        ?>
    </div>
    </div>
    
<!-- Java Script -->
<script>
    var coord  = "<?php echo $_SESSION['branch'] ?>".split(',');
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
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<?php require 'footer.php';?>
</body>
</html>