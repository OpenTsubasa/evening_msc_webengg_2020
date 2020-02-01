<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	session_destroy();
	header('location: index.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
<body>
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="signup.php">Sign Up</a></li>
		<li><a href="signin.php">Sign In</a></li>
		<li><a href="admin.php">Admin</a></li>
	</ul>
	<div>
		<?php

		echo "Welcome, " . $_SESSION['username'];

		?>

		<form method="post" action="">
          <input type="submit" name="signout" value="Sign Out">
        </form>
	</div>
</body>
</html>