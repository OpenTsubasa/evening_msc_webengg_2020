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

  $inputEmail = trim($_POST['inputEmail']);
  $inputPassword = trim($_POST['inputPassword']);

  if (empty($inputEmail)) {
    $inputEmailError = "Input Email";
    $valid = false;
  }
  if (empty($inputPassword)) {
    $inputPasswordError = "Input Password";
    $valid = false;
  }

  if ( !empty($inputEmail) && !empty($inputPassword) ) {
    if (!filter_var($inputEmail, FILTER_VALIDATE_EMAIL)) {
      $inputEmailError = "Invalid Email Format";
      $valid = false;
    }
  }

  if ($valid) {
    include 'php/db.php';
    
    $encryptedInputPassword = md5($inputPassword);
    $sql = "SELECT * FROM `users` WHERE `email`='{$inputEmail}' AND `password`='{$encryptedInputPassword}'";
    $result = mysqli_query($db, $sql);
    if(mysqli_num_rows($result) == 0) {
      $errorMessage = "Sign In failed! Wrong username/password!";
    } else {
      $user = mysqli_fetch_assoc($result);
      $_SESSION['id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['isadmin'] = $user['isadmin'];
      $successMessage = "Sign In successfull! Go to <a href='index.php'>Home</a> page to explore!";
    }
    mysqli_close($db);

    $inputEmail = '';
    $inputPassword = '';

    // die();
  }
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Sign In Page</title>
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
          <a href="signup.php">Sign Up</a>
        </li>
        <li>
          <a href="signin.php" class="active"><b>Sign In</b></a>
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
        <label for="inputEmail">Email: </label>&nbsp;<span style="color: red"><?php if (isset($inputEmailError)) echo "[$inputEmailError]"; ?></span>
        <input type="email" name="inputEmail" id="inputEmail" placeholder="Email" value="<?=$inputEmail?>"><br>
        <label for="inputPassword">Password: </label>&nbsp;<span style="color: red"><?php if (isset($inputPasswordError)) echo "[$inputPasswordError]"; ?></span>
        <input type="password" name="inputPassword" id="inputPassword" placeholder="Password" value="<?=$inputPassword?>"><br>
        <button type="submit">Sign In</button>
      </form>
    </div>
    <hr>
    <div>
      Copyright OT, 2020
    </div>
  </div>
</body>
</html>