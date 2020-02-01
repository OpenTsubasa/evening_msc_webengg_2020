<?php

session_start();

// var_dump($_SERVER["REQUEST_METHOD"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$un = $_POST['un'];
	$pw = $_POST['pw'];

	$mysql_server = "localhost";
	$mysql_user = "root";
	$mysql_password = "";
	$mysql_db = "simple";
	$db = mysqli_connect($mysql_server, $mysql_user, $mysql_password, $mysql_db);

	$sql = "SELECT * FROM users WHERE username = '{$un}' AND password = '{$pw}'";
	$result = mysqli_query($db, $sql);

	if(mysqli_num_rows($result) == 0) {
      echo "Sign In failed! Wrong username/password!";
    } else {
      $user = mysqli_fetch_assoc($result);

      $_SESSION['id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['isadmin'] = $user['isadmin'];

      echo "Sign In successfull! Go to <a href='index.php'>Home</a> page to explore!";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign In</title>
</head>
<body>
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="signup.php">Sign Up</a></li>
		<li><a href="signin.php">Sign In</a></li>
		<li><a href="admin.php">Admin</a></li>
	</ul>
	<div>
		<form action="" method="post">
			<input type="text" name="un" id="un" placeholder="Username" value="<?=$un?>">
			<input type="password" name="pw" id="pw" placeholder="Password" value="<?=$pw?>">
			<input type="submit" name="si" id="si" value="Sign In">
		</form>
	</div>
</body>
</html>