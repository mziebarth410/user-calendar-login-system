<?php
session_start();

error_reporting(E_ALL);
ini_set( 'display_errors','1');

  if(isset($_POST['del']))
  {
      include 'database_HW6F17.php';
      $conn=new mysqli($db_servername,$db_username,$db_password,$db_name,$db_port);

      $user_id = $_POST['id_to_pass'];

      if ($conn->connect_error)
      {
          echo "conn error";
      }
      else
      {
          $sql3 = "DELETE FROM tbl_accounts WHERE acc_id='$user_id'";
					$result3 = mysqli_query($conn, $sql3);
          header("Location: admin.php");
     }
  }
  else
  {
      header("Location: login.php");
      exit();

  }
?>
