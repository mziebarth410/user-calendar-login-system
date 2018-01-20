<?php
session_start();

error_reporting(E_ALL);
ini_set( 'display_errors','1');

  if(isset($_POST['update']))
  {
    include 'database_HW6F17.php';
    $conn=new mysqli($db_servername,$db_username,$db_password,$db_name,$db_port);

    $user_id2 = $_POST['id_to_pass'];
    $name2 = $_POST['name_text'];
    $uid2 = $_POST['login_text'];
    $pwd2 = $_POST['password_text'];

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

          if (!empty($_POST['name_text']) || !empty($_POST['login_text'])|| !empty($_POST['password_text']))
          {
              if($rowCount >= 1) //username was found
              {
                  header("Location: admin.php");
                  echo "Username has already been used. Please try again.";
                  exit();
              }
              else //username has not been used yet
              {
                  $hashedPwd = sha1($pwd);
                  $sql2 = "UPDATE tbl_accounts
                            SET acc_name = '$name2', acc_login= '$uid2', acc_password = '$hashedPwd2'
                            WHERE acc_id = '$user_id2'";
                  mysqli_query($conn,$sql2);
                  header("Location: admin.php");
                  exit();
              }
          }
          else
          {
              header("Location: admin.php");
              echo "please enter values in all 3 text boxes to update a user";
              exit();
          }


     }
  }
  else
  {
      header("Location: admin.php");
      exit();

  }
?>
