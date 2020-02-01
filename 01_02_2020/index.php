<?php

session_start();

if (isset($_SESSION['id'])) {
  $id = $_SESSION['id'];
  $username = $_SESSION['username'];
  $email = $_SESSION['email'];
  $isadmin = $_SESSION['isadmin'];
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
  unset($_SESSION);
  session_destroy();
  header('location: index.php');
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Home Page</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <div>
    <nav>
      <ul>
        <li>
          <a href="index.php" class="active"><b>Home</b></a>
        </li>
        <li>
          <a href="signup.php">Sign Up</a>
        </li>
        <li>
          <a href="signin.php">Sign In</a>
        </li>
        <?php if (isset($isadmin)) { ?>
        <li>
          <a href="admin.php">Admin</a>
        </li>
        <?php } ?>
      </ul>
    </nav>
    <hr>
    <div>
      <p>This is a very basic user sign-up & sign-in web application!!!</p>
      <?php if (isset($id)) { ?>
        <p>Welcome <?=$username?>!</p>
        <form method="post" action="<?php echo $SERVER['PHP_SELF'] ?>">
          Click <a onclick="this.closest('form').submit();return false;" href="#">Here</a> to logout!
        </form>
      <?php } ?>
    </div>
    <hr>
    <div>
      Copyright OT, 2020
    </div>
  </div>
</body>
</html>