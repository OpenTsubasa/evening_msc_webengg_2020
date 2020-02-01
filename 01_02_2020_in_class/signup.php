<?php

// var_dump($_SERVER["REQUEST_METHOD"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$un = $_POST['un'];
	$em = $_POST['em'];
	$pw = $_POST['pw'];

	$mysql_server = "localhost";
	$mysql_user = "root";
	$mysql_password = "";
	$mysql_db = "simple";
	$db = mysqli_connect($mysql_server, $mysql_user, $mysql_password, $mysql_db);

	$sql = "INSERT INTO users (username, email, password) VALUES ('{$un}', '{$em}', '{$pw}')";
	$result = mysqli_query($db, $sql);

	if ($result) {
		echo "Sign Up Success!!!";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
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
			<input type="email" name="em" id="em" placeholder="Email" value="<?=$em?>">
			<input type="password" name="pw" id="pw" placeholder="Password" value="<?=$pw?>">
			<input type="submit" name="su" id="su" value="Sign Up">
		</form>
	</div>
</body>
</html>