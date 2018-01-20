<?php
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>calendar</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>

  <?php
    if(!isset($_SESSION['acc_name']))
    {
      header("location: login.php");
      exit();
    }

  ?>

 	<h1 align="center">My Schedule</h1>

  <?php

    echo '<h6 align="center">';
    echo "Welcome ";
    echo $_SESSION['acc_name'];
    echo '</h6>';
  ?>

  <form method="post" name="Log_out" action="logout.php">
    <input type="submit" value="Logout" name="logout">
  </form>


  <ul align = "center">
  		<li><a href="calendar.php">My Schedule</a></li>
  		<li><a href="form_html.php">Event Entry Form</a></li>
      <li><a href="admin.php">Admin</a></li>
	</ul>
	<br>

	<div class="table_container">
	<?php
				$name_file = "calendar.txt";
				$checkfile = file_get_contents("calendar.txt");

				if($checkfile != "")
				{
						echo '<table>';
						$myfile = fopen($name_file, "r");
						$events = file_get_contents($name_file);
						$events = json_decode($events, true);
						fclose($myfile);

						$days = array("monday","tuesday","wednesday","thursday","friday");

						for($i = 0; $i <= 4; $i++)
						{
								$single_day = $days[$i];

								if(isset($events[$single_day]))
								{
										echo '<tr><td><span style="font-weight: 800">';
										echo $single_day;
										echo '</span></td>';

										foreach($events[$single_day] as $dayevent)
										{
												echo '<td><h6>';
												$start_time_text = $dayevent['starttime'];
												echo date('h:i a', strtotime($start_time_text));
												echo '-';
												$end_time_text = $dayevent['endtime'];
												echo date('h:i a', strtotime($end_time_text));
												echo '</h6><br>';
												echo $dayevent['eventname'];
												echo '--';
												echo $dayevent['location'];
												echo '<br></td>';

												$temp = $dayevent['location'];

												echo '<script> var address =';
												echo $temp;
												echo ', Minneapolis, MN; </script>';
										}
										echo '</tr>';


								}
						}
						echo '</table>';


				}
				else
				{
					echo '<p>Calendar has no events. Use "Event Entry Form" to enter new events.</p>';
				}
	?>

</div>
	<br>
	<br>

	<div class="gmaps_form">
	<form method="get" name="maps_form">
		Radius:
		<input id="id1" type="number" name="radius">
		<input type="button" value="Find Nearby Restaurants" onClick="initMap()">
		<br>
</select>

	</form>
</div>

	<div id="map" style="width:50%;height:500px;margin:auto;display:block;text-align:center;"></div>

	<script>
		function myMap() {
		  var myCenter = new google.maps.LatLng(44.97527613221183,-93.23640032419797);
		  var mapCanvas = document.getElementById("map");
		  var mapOptions = {center: myCenter, zoom: 15};
		  var map = new google.maps.Map(mapCanvas, mapOptions);

				geocoder.geocode({'address': address}, function(results, status) {
						 if (status === 'OK') {
							 resultsMap.setCenter(results[0].geometry.location);
							 var marker = new google.maps.Marker({
								 map: resultsMap,
								 position: results[0].geometry.location
							 });
						 } else {
							 alert('Geocode was not successful for the following reason: ' + status);
						 }
				 });

			}

			function initMap()
			{
						var pyrmont = {lat: 44.97527613221183,lng: -93.23640032419797};

						map = new google.maps.Map(document.getElementById('map'), {
							center: pyrmont,
							zoom: 15
						});

						infowindow = new google.maps.InfoWindow();
						var service = new google.maps.places.PlacesService(map);
						service.nearbySearch({
							location: pyrmont,
							radius: document.getElementById("id1").value,
							type: ['restaurant']
						}, callback);
				}

				function callback(results, status)
				{
						if (status === google.maps.places.PlacesServiceStatus.OK) {
							for (var i = 0; i < results.length; i++) {
								createMarker(results[i]);
							}
						}
				}

				function createMarker(place)
				{
						var placeLoc = place.geometry.location;
						var marker = new google.maps.Marker({
							map: map,
							position: place.geometry.location
						});

						google.maps.event.addListener(marker, 'click', function() {
							infowindow.setContent(place.name);
							infowindow.open(map, this);
						});
				}



		</script>

	</script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAdmluiXvRgHAGKY7skdJJ4fMvOywiM3CE&libraries=places&callback=myMap" async defer></script>

</body>
</html>
