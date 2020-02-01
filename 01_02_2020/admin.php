<?php

session_start();

if (isset($_SESSION['id'])) {
  $id = $_SESSION['id'];
  $username = $_SESSION['username'];
  $email = $_SESSION['email'];
  $isadmin = $_SESSION['isadmin'];
}

if (empty($isadmin)) {
  header('location: index.php');
}

include 'php/db.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = trim($_POST['id']);

  if (empty($id)) {
    header('location: admin.php');
  }

  $sql = "SELECT * FROM `users` WHERE `id` = '{$id}'";
  $result = mysqli_query($db, $sql);
  if(mysqli_num_rows($result) == 0) {
    header('location: admin.php');
  } else {
    $user = mysqli_fetch_assoc($result);
    $isadmin = $user['isadmin'];
    
    if ($isadmin == 1) {
      header('location: admin.php');
    }
  }

  $sql = "DELETE FROM `users` WHERE `id` = '{$id}'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    $successMessage = "Delete successfull!";
  } else {
    $errorMessage = "Delete failed! Something went wrong! Please try again!";
  }
}

$sql = "SELECT * FROM `users`";
$result = mysqli_query($db, $sql);
mysqli_close($db);

?><!DOCTYPE html>
<html>
<head>
  <title>Admin Page</title>
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
      <h3>All the users of this application are listed below:</h3>
      <table>
        <tr>
          <th>Username</th>
          <th>Email</th>
          <th>Is Admin</th>
          <th>Action</th>
        </tr>
      <?php while ($user = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?=$user['username']?></td>
          <td><?=$user['email']?></td>
          <td><?=$user['isadmin']?></td>
          <td>
            <?php if ($user['isadmin'] != 1) { ?>
            <form method="post" action="<?php echo $SERVER['PHP_SELF'] ?>">
              <input type="hidden" name="id" value="<?=$user['id']?>">
              <input type="submit" onclick="return confirm('Are you sure?');" name="delete">
            </form>
            <?php } ?>
          </td>
        </tr>
      <?php } ?>
      </table>
    </div>
    <hr>
    <div>
      Copyright OT, 2020
    </div>
  </div>
</body>
</html>