<?php
session_start();

error_reporting(E_ALL);
ini_set( 'display_errors','1');

  if(isset($_POST['addUser']))
  {
      include 'database_HW6F17.php';
      $conn=new mysqli($db_servername,$db_username,$db_password,$db_name,$db_port);

      $name = $_POST['addName'];
      $uid = $_POST['addLogin'];
      $pwd = $_POST['addPassword'];

      if ($conn->connect_error)
      {
          echo "conn error";
      }
      else
      {
          $sql = "SELECT * FROM tbl_accounts WHERE acc_name='$name' OR acc_login='$uid'";
          $result = mysqli_query($conn, $sql);
          $rowCount = 0;
          $rowCount = mysqli_num_rows($result);

          if($rowCount >= 1) //username was found
          {
              echo "Username is already used";
              echo '<br>';
              echo "Click ";
              echo '<a href="admin.php">here</a>';
              echo " to try again.";
              exit();
          }
          else //username has not been used yet
          {
              echo  "test 1";
              mysqli_query($conn,"INSERT INTO tbl_accounts (acc_name, acc_login, acc_password) VALUES ('$name', '$uid', '". sha1($pwd)."');");
              header("Location: admin.php");
          }
     }
  }
  else
  {
      header("Location: login.php");
      exit();

  }
?>
