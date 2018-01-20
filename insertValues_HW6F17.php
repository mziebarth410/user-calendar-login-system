<?php
include 'database_HW6F17.php';

error_reporting(E_ALL);
ini_set( 'display_errors','1');

// Create connection
$conn=new mysqli($db_servername,$db_username,$db_password,$db_name,$db_port);
// Check connection
if (mysqli_connect_errno())
  {
  echo 'Failed to connect to MySQL:' . mysqli_connect_error();
  }
echo sha1('1234');
echo sha1('1234');

//You can replace the strings below with whatever passwords you would like
$str1 = "1234";
$str2 = "1234";

// You can replace the
//'Jim Smith', 'Smitty'   And
//'Jane Jones', 'JJones'
//with whatever account names and logins that you would like
//NOTE, you can have more account names and logins than 2, but you need at least 1
mysqli_query($conn,"INSERT INTO tbl_accounts (acc_name, acc_login, acc_password) VALUES ('Jim Smith', 'Smitty', '". sha1($str1)."');");
mysqli_query($conn,"INSERT INTO tbl_accounts (acc_name, acc_login, acc_password) VALUES ('Jane Jones', 'JJones', '". sha1($str2)."');");

mysqli_close($conn);


echo '<h1> Successfully Inserted Values into the Table </h1>'
?>
