<?php

session_start();

if (isset($_SESSION['id'])) {
  header('location: index.php');
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
  // echo "<pre>";
  // var_dump($_POST);
  // echo "</pre>";
  // die();

  $valid = true;

  $inputUsername = trim($_POST['inputUsername']);
  $inputEmail = trim($_POST['inputEmail']);
  $inputPassword = trim($_POST['inputPassword']);
  $inputConfirmPassword = trim($_POST['inputConfirmPassword']);

  if (empty($inputUsername)) {
    $inputUsernameError = "Input Username";
    $valid = false;
  }
  if (empty($inputEmail)) {
    $inputEmailError = "Input Email";
    $valid = false;
  }
  if (empty($inputPassword)) {
    $inputPasswordError = "Input Password";
    $valid = false;
  }
  if (empty($inputConfirmPassword)) {
    $inputConfirmPasswordError = "Input Confirm Password";
    $valid = false;
  }

  if ( !empty($inputUsername) && !empty($inputEmail) && !empty($inputPassword) && !empty($inputConfirmPassword) ) {
    if (!filter_var($inputEmail, FILTER_VALIDATE_EMAIL)) {
      $inputEmailError = "Invalid Email Format";
      $valid = false;
    }

    if ($inputPassword !== $inputConfirmPassword) {
      $inputConfirmPasswordError = "The password confirmation failed";
      $valid = false;
    }
  }

  if ($valid) {
    $valid = true;

    include 'php/db.php';

    $sql = "SELECT * FROM `users` WHERE `username`='{$inputUsername}'";
    $result = mysqli_query($db, $sql);
    if(mysqli_num_rows($result) == 1) {
      $inputUsernameError = "This Username is already taken";
      $valid = false;
    }

    $sql = "SELECT * FROM `users` WHERE `email`='{$inputEmail}'";
    $result = mysqli_query($db, $sql);
    if(mysqli_num_rows($result) == 1) {
      $inputEmailError = "This Email is already used";
      $valid = false;
    }

    if ($valid) {
      $encryptedInputPassword = md5($inputPassword);
      $sql = "INSERT INTO `users` (`username`, `email`, `password`) VALUES ('{$inputUsername}', '{$inputEmail}', '{$encryptedInputPassword}')";
      $result = mysqli_query($db, $sql);
      if($result) {
        $successMessage = "Sign Up successfull! Go to <a href='signin.php'>Sign In</a> page to login!";
      } else {
        $errorMessage = "Sign Up failed! Something went wrong! Please try again!";
      }
      mysqli_close($db);

      $inputUsername = '';
      $inputEmail = '';
      $inputPassword = '';
      $inputConfirmPassword = '';
    }

    // die();
  }
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Sign Up Page</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <div>
    <nav>
      <ul>
        <li>
          <a href="index.php">Home</a>
        </li>
        <li>
          <a href="signup.php" class="active"><b>Sign Up</b></a>
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
      <span style="color: green"><?php if (isset($successMessage)) echo "[$successMessage]"; ?></span>
      <span style="color: red"><?php if (isset($errorMessage)) echo "[$errorMessage]"; ?></span>
      <form method="post" action="<?php echo $SERVER['PHP_SELF'] ?>">
        <label for="inputUsername">Username: </label>&nbsp;<span style="color: red"><?php if (isset($inputUsernameError)) echo "[$inputUsernameError]"; ?></span>
        <input type="text" name="inputUsername" id="inputUsername" placeholder="Username" value="<?=$inputUsername?>"><br>
        <label for="inputEmail">Email: </label>&nbsp;<span style="color: red"><?php if (isset($inputEmailError)) echo "[$inputEmailError]"; ?></span>
        <input type="email" name="inputEmail" id="inputEmail" placeholder="Email" value="<?=$inputEmail?>"><br>
        <label for="inputPassword">Password: </label>&nbsp;<span style="color: red"><?php if (isset($inputPasswordError)) echo "[$inputPasswordError]"; ?></span>
        <input type="password" name="inputPassword" id="inputPassword" placeholder="Password" value="<?=$inputPassword?>"><br>
        <label for="inputConfirmPassword">Confirm Password: </label>&nbsp;<span style="color: red"><?php if (isset($inputConfirmPasswordError)) echo "[$inputConfirmPasswordError]"; ?></span>
        <input type="password" name="inputConfirmPassword" id="inputConfirmPassword" placeholder="Confirm Password" value="<?=$inputConfirmPassword?>"><br>
        <button type="submit">Sign Up</button>
      </form>
    </div>
    <hr>
    <div>
      Copyright OT, 2020
    </div>
  </div>
</body>
</html>