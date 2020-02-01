<?php

session_start();

if ($_SESSION['isadmin'] != 1) {
	header('location: index.php');
}

$mysql_server = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_db = "simple";
$db = mysqli_connect($mysql_server, $mysql_user, $mysql_password, $mysql_db);

$sql = "SELECT * FROM users";
$result = mysqli_query($db, $sql);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<style type="text/css">
		table, tr, th, td {
			 border: 1px solid black;
		}
	</style>
</head>
<body>
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="signup.php">Sign Up</a></li>
		<li><a href="signin.php">Sign In</a></li>
		<li><a href="admin.php">Admin</a></li>
	</ul>
	<div>
		<table>
			<tr>
				<th>Username</th>
				<th>Email</th>
				<th>Is Admini</th>
			</tr>
			<?php while($user = mysqli_fetch_assoc($result)) { ?>
			<tr>
				<td><?=$user['username']?></td>
				<td><?=$user['email']?></td>
				<td><?=$user['isadmin']?></td>
			</tr>
			<?php } ?>
		</table>
	</div>
</body>
</html>