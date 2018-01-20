<?php
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>form</title>
	<link href="style.css" rel="stylesheet" type="text/css">

	<script>
		function formValidate() {
			var txt1 = document.forms["event_form"]["eventname"].value;
			var txt2 = document.forms["event_form"]["location"].value;

			if(/^[0-9a-zA-Z\s]+$/.test(txt1)==false)
			{
				alert("Event Name should consist of alphanumeric characters only");
				return false;

			}
			else if((/^[0-9a-zA-Z\s]+$/.test(txt2))== false)
			{
				alert("Location should consist of alphanumeric characters only");
				return false;
			}
			else
			{
				return true;
			}
		}
	</script>
</head>

<body>

	<?php
		if(!isset($_SESSION['acc_name']))
		{
			header("location: login.php");
			exit();
		}

	?>

	<h1>Event Entry Form</h1>

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
	<br>

	<div class="event_form">
		<form onSubmit="return formValidate()" method="post" name="event_form" action="form.php">
		  Event Name:
		  <input id="id1" type="text" name="eventname" required>
		  <br><br>
		  Start Time:
		  <input type="time" name="starttime" required>
		  <br><br>
		  End Time:
		  <input type="time" name="endtime" required>
		  <br><br>
		  Location:
		  <input id="id2" type="text" name="location" required >
		  <br><br>
		  Day of the Week:
		  <select name="day">
			<option value="monday" >Monday</option>
			<option value="tuesday">Tuesday</option>
			<option value="wednesday">Wednesday</option>
			<option value="thursday">Thursday</option>
			<option value="friday">Friday</option>
		  </select>
		  <br><br>
		  <input type="submit" value="Submit" name="Submit_button">
		</form>
		<br>
		<form method="post" name="clear_events" action="form.php">
			<input type="submit" value="Clear" name="Clear">
		</form>
	</div>


</body>
</html>
