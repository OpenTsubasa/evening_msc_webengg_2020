<?php session_start(); ?>
<?php
  include 'php/db_fucntions.php';
  include 'php/utility_functions.php';
?>
<?php
  $search = '';
?>
<?php
  $valid = 0;
  $validate = false;
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user_login'])) {
      $validate = true;
    } else {
      unset($_SESSION);
      setcookie(session_id());
      session_destroy();
    }
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="css/style.css" media="screen,projection" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Astor Mediterranean</title>
</head>
<body>
  <div id="container">
    <div id="header">
      <h1>Mediterranean Food</h1>
      Healthy, Fresh... and Fast!
      <?php echo searchForm($search); ?>
    </div>
    <div id="subheader">
      <h2>Home</h2>
      <ul id="navigation">
        <li class="active">Home</li>
        <li><a href="about.php">About</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </div>
    <div id="content">
      <h3>Overview</h3>
      The business is simply a small restaurant; located in Arlington, Virginia, USA.
      <br/><br/>
      <h3>Most Recent Announcement</h3>
      <?php echo getRecentAnnouncement(); ?>
      <br /><br />
      Click on the link, to see all <a href="announcements.php">Announcements</a> ordered newest to oldest.
      <br/><br/>
      <h3>Login Form</h3>
      <?php if (!isset($_SESSION['user_name'])) { ?>
      <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <fieldset>
          <legend>User/Admin Login Form</legend>
          <?php
            $user_name = "";
            if (isset($_POST['user_name'])) $user_name = $_POST['user_name'];
            $data = commonHtmlFormTag (
              'User Name', 
              'user_name', 
              'text', 
              $user_name, 
              array('required' => true, 'max_length' => 20, 'min_length' => 5), 
              $validate
            );
            if ($validate) {
              if ($data['valid']) {
                $valid++;
              }
            }
            echo $data['print'];
          ?>
          <br /><br />
          <?php
            $user_password = "";
            if (isset($_POST['user_password'])) $user_password = $_POST['user_password'];
            $data = commonHtmlFormTag (
              'User Password', 
              'user_password', 
              'password', 
              $user_password, 
              array('required' => true, 'max_length' => 20, 'min_length' => 5), 
              $validate
            );
            if ($validate) {
              if ($data['valid']) {
                $valid++;
              }
            }
            echo $data['print'];
          ?>
          <br /><br />
          <?php
            $data = commonHtmlFormTag(
              '', 
              'user_login', 
              'submit', 
              'Log In'
            );
            echo $data['print'];
          ?>
          <?php
            if (isset($_SESSION['login_error'])) {
              echo "<br /><br />".$_SESSION['login_error'];
              unset($_SESSION['login_error']);
            }
          ?>
          <br /><br />
          Click on the link, to <a href='register.php'>Register</a> as a new user.
        </fieldset>
      </form>
      <?php } else { ?>
      <?php
        echo "Hello, ".$_SESSION['user_name']."! You have registered successfully.";
        echo "<br />";
        if ($_SESSION['user_name'] == "admin") {
          echo "Click on the link, to go to <a href='admin.php'>Admin</a> section.";
        } else {
          echo "Click on the link, to go to your <a href='profile.php'>Profile</a>.";
        }
      ?>
      <br /><br />
      <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        Click on the button to logout: 
        <?php
            $data = commonHtmlFormTag(
              '', 
              'user_logout', 
              'submit', 
              'Log Out'
            );
            echo $data['print'];
          ?>
      </form>
      <?php } ?>
    </div>
    <?php
      if ($validate) {
        if ($valid == 2) {
          if (($user_name == "admin") && ($user_password == "admin")) {
            $_SESSION['user_name'] = "admin";
            header("Location: index.php");
          } else {
            if (checkForUser($user_name,$user_password)) {
              $_SESSION['user_name'] = $user_name;
              header("Location: index.php");
            } else {
              $_SESSION['login_error'] = "<span class='error'>Wrong User Name/Password. Try again.</span>";
              header("Location: index.php");
            }
          }
        }
      }
    ?>
    <div id="subcontent">
      An overview of the business is given on this page along with the most recent announcement made.
      <br/><br/>
      There is also a login form which will be used by both the user and the admin.
    </div>
    <div id="footer">
      Small Food Restaurant Business Website. (Group Project).
    </div>
  </div>
</body>
</html>