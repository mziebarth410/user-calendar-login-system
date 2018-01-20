<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Login</title>

	<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
  <h1>Login Page</h1>
  <h3 style="text-align:center;">Please enter your login name and password<br>username and password are both case sensitive</h3>

    <div class="event_form">
      <form method="post" name="loginForm" action="login_code.php">
          <label><b>Username</b></label>
          <input type="text" placeholder="Enter Username" name="user_name" required>
          <br>
          <label><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="pass_word" required>
          <br>
          <input type="submit" value="Submit" name="Login">
      </form>
    </div>




</body>
</html>
