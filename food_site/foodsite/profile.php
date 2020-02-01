<?php session_start(); ?>
<?php
  if ((!isset($_SESSION['user_name'])) || ($_SESSION['user_name'] == "admin")) {
    header("Location: index.php");
  }
?>
<?php
  include 'php/db_fucntions.php';
  include 'php/utility_functions.php';
?>
<?php
  $search = '';
?>
<?php
  $user_name = $_SESSION['user_name'];
  $user_id = getUserIdByUserName($user_name);
  $profile_id = getProfileIdByUserId($user_id);
  $first_name = '';
  $last_name = '';
  $mailing_address = '';
  $email_address = '';
  $category_id = '';
  $valid = 0;
  $validate = false;
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_profile'])) {
      $validate = true;
    }
  } else {
    $data = getProfileDataByUserId($user_id);
    if ($data !== 0) {
      $profile_id = $data['id'];
      $first_name = $data['first_name'];
      $last_name = $data['last_name'];
      $mailing_address = $data['mailing_address'];
      $email_address = $data['email_address'];
      $category_id = $data['category_id'];
    }
  }
  $food_categories = getAllFoodCategories();
  $t = array();
  while ($row = mysqli_fetch_row($food_categories)) {
    $t[$row[0]] = ucfirst($row[1]);
  }
  $food_categories = $t;
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
      <h2>Profile</h2>
      <ul id="navigation">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </div>
    <div id="content">
      <h3>User Profile</h3>
      <?php
        if (isset($_SESSION['profile_success'])) {
          echo "Profile updated successfully.";
          echo "<br />";
          echo "Click on the link, to go to <a href='index.php'>Home</a> page.";
          echo "<br />";
          echo "Or, re-request this page to see your updated profile; Or, to update your profile again.";
          unset($_SESSION['profile_success']);
      } else { ?>
      <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <fieldset>
          <legend>Edit and Update your Profile Data</legend>
          <?php
            if (isset($_POST['first_name'])) $first_name = $_POST['first_name'];
            $data = commonHtmlFormTag (
              'First Name', 
              'first_name', 
              'text', 
              $first_name, 
              array('required' => true, 'max_length' => 20), 
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
            if (isset($_POST['last_name'])) $last_name = $_POST['last_name'];
            $data = commonHtmlFormTag (
              'Last Name', 
              'last_name', 
              'text', 
              $last_name, 
              array('required' => true, 'max_length' => 25), 
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
            if (isset($_POST['mailing_address'])) $mailing_address = $_POST['mailing_address'];
            $data = commonHtmlFormTag (
              'Mailing Address', 
              'mailing_address', 
              'textarea', 
              $mailing_address, 
              array('required' => true), 
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
            if (isset($_POST['email_address'])) $email_address = $_POST['email_address'];
            $data = commonHtmlFormTag (
              'Email Address', 
              'email_address', 
              'email', 
              $email_address, 
              array('required' => true), 
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
            if (isset($_POST['category_id'])) $category_id = $_POST['category_id'];
            $data = commonHtmlFormTag (
              'Favorite Food Category', 
              'category_id', 
              'select', 
              $category_id, 
              array('required' => true), 
              $validate, 
              $food_categories
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
              'update_profile', 
              'submit', 
              'Update Profile'
            );
            echo $data['print'];
          ?>
          <?php
            if (isset($_SESSION['profile_error'])) {
              echo "<br /><br />".$_SESSION['profile_error'];
              unset($_SESSION['profile_error']);
            }
          ?>
        </fieldset>
      </form>
      <?php } ?>
    </div>
    <?php
      if ($validate) {
        if ($valid == 5) {
          $successful = false;
          if ($profile_id == 0) {
            $successful = addProfileForUserId($first_name, $last_name, $mailing_address, $email_address, $category_id, $user_id);
          } else {
            $successful = updateProfileByProfileId($first_name, $last_name, $mailing_address, $email_address, $category_id, $profile_id);
          }
          if ($successful) {
            $_SESSION['profile_success'] = true;
            header("Location: profile.php");
          } else {
            $_SESSION['profile_error'] = "<span class='error'>Unknown problem occured. Try again.</span>";
            header("Location: profile.php");
          }
        }
      }
    ?>
    <div id="subcontent">
      A user can edit his/her profile information here on this page.
      <br/><br/>
      User's current profile information is loaded automatically.
    </div>
    <div id="footer">
      Small Food Restaurant Business Website. (Group Project).
    </div>
  </div>
</body>
</html>