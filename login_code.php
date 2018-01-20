<?php
session_start();

error_reporting(E_ALL);
ini_set( 'display_errors','1');

  if(isset($_POST['Login']))
  {
      include 'database_HW6F17.php';
      $conn=new mysqli($db_servername,$db_username,$db_password,$db_name,$db_port);
      $uid = $_POST['user_name'];
      $pwd = $_POST['pass_word'];

      if ($conn->connect_error)
      {
          echo "conn error";
      }
      else
      {
            if(empty($uid))
            {
                echo "Please enter a valid username";
                exit();
            }
            else
            {
                if(empty($pwd))
                {
                    echo "Please enter a valid password";
                    exit();
                }
                else
                {
                    $sql = "SELECT * FROM tbl_accounts WHERE acc_name='$uid' OR acc_login='$uid'";
                    $result = mysqli_query($conn, $sql);
                    $rowCount = 0;

                    if($result)
                    {
                        $rowCount = mysqli_num_rows($result);
                    }
                    else
                    {
                      echo "fail";
                    }

                    if($rowCount < 1) //username was not found
                    {
                        echo "Username is incorrect.";
                        echo '<br>';
                        echo "Click ";
                        echo '<a href="form_html.php">here</a>';
                        echo " to try again.";
                        exit();
                    }
                    else //username was valid
                    {
                        if($row = mysqli_fetch_assoc($result))
                        {

                            if (sha1($pwd) != $row['acc_password'])
                            {
                                echo "Password is incorrect.";
                                echo '<br>';
                                echo "Click ";
                                echo '<a href="form_html.php">here</a>';
                                echo " to try again.";
                                exit();
                            }
                            elseif (sha1($pwd) == $row['acc_password'])
                            {
                                $_SESSION['acc_name'] = $row['acc_name'];
                                $_SESSION['acc_login'] = $row['acc_login'];
                                header("Location: calendar.php");
                            }
                        }
                     }
               }
            }
      }

  }
  else
  {
      echo "Could not connect to server";
      header("Location: login.php");
      exit();

  }
?>
