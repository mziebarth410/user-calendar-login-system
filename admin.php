<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>ADMIN</title>
	<link href="style.css" rel="stylesheet" type="text/css">

  <style>
  table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 70%;
  }

  td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
  }

  tr:nth-child(even) {
      background-color: #dddddd;
  }

	input[type=text], select {
			font-size: 20px;
	    color:black;
			background-color: #FFFFFF;
	    padding: 12px 20px;
	    margin: 8px 0;
	    border: 1px solid #ccc;
	    border-radius: 4px;
	}

	button:hover
	{
		background-color: #0904C8;
	}

	input[type=password], select {
			font-size: 20px;
			color:black;
			background-color: #FFFFFF;
			padding: 12px 20px;
			margin: 8px 0;
			border: 1px solid #ccc;
			border-radius: 4px;
	}


  </style>

</head>

<body>

	<?php
	  if(!isset($_SESSION['acc_name']))
	  {
	    header("location: login.php");
	    exit();
	  }
	  include 'database_HW6F17.php';
	  $conn=new mysqli($db_servername,$db_username,$db_password,$db_name,$db_port);

	  if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	  }
  ?>


 	<h1 align="center">Admin</h1>

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

  <br><br>

  <h5>Data Base User Table</h5>
  <?php
    $sql2 = "SELECT acc_id, acc_name, acc_login FROM tbl_accounts";
    $result2 = $conn->query($sql2);

    if ($result2->num_rows > 0) {
        // output data of each row
        echo "<table><tr>";
        echo "<th>ID</th>";
        echo "<th>Name</th>";
        echo "<th>Login</th>";
        echo "<th>New Password</th>";
        echo "<th>Action</th>";
        echo "</tr>";
        while($row = $result2->fetch_assoc()) {
						$id_to_pass = $row["acc_id"];
            echo "<tr> <td> ". $row["acc_id"]. " </td><td> ". $row["acc_name"]. "  </td><td>  ". $row["acc_login"] .
            " </td><td> </td>
            <td>
							<form method = \"post\" action =\"editUser.php\">
										<input type=\"hidden\" name=\"id_to_pass\" value =\"$id_to_pass\">
										<input type=\"submit\" value=\"Edit\" name=\"edit\">
							</form>
							<form method = \"post\"action =\"deleteUser.php\">
											<input type=\"hidden\" name=\"id_to_pass\" value =\"$id_to_pass\">
											<input type=\"submit\" value=\"Delete\" name=\"del\">
								</form>
						</td></tr>";
        }
        echo "</table>";
    		} else {
        echo "0 results";
			}

  	?>

  <br><br>
  <h5>Add a User</h5>
  <div class="event_form">
    <form method="post" name="addNewUser_form" action="addUser.php">
      Name:
      <input type="text" name="addName" required>
      <br><br>
      Login:
      <input type="text" name="addLogin" required>
      <br><br>
      Password:
      <input type="password" name="addPassword" required>
      <br><br>
      <input type="submit" value="Add User" name="addUser">
    </form>
  </div>
</body>
</html>
