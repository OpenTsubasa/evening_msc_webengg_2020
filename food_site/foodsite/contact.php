<?php session_start(); ?>
<?php
  include 'php/utility_functions.php';
?>
<?php
  $search = '';
?>
<?php
  $valid = 0;
  $validate = false;
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['send_email'])) {
      $validate = true;
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
      <h2>Contact</h2>
      <ul id="navigation">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="products.php">Products</a></li>
        <li class="active">Contact</li>
      </ul>
    </div>
    <div id="content">
      <h3>Contact Form</h3>
      <?php
        if (isset($_SESSION['contact_success'])) {
          echo "E-mail sent successfully.";
          echo "<br />";
          echo "Click on the link, to go to <a href='index.php'>Home</a> page.";
          echo "<br />";
          echo "Or, re-request this page to send another e-mail.";
          unset($_SESSION['contact_success']);
      } else { ?>
      <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <fieldset>
          <legend>Contact Form</legend>
          <?php
            $name = "";
            if (isset($_POST['name'])) $name = $_POST['name'];
            $data = commonHtmlFormTag (
              'Name', 
              'name', 
              'text', 
              $name, 
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
            $email = "";
            if (isset($_POST['email'])) $email = $_POST['email'];
            $data = commonHtmlFormTag (
              'Email', 
              'email', 
              'email', 
              $email, 
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
            $subject = "";
            if (isset($_POST['subject'])) $subject = $_POST['subject'];
            $data = commonHtmlFormTag (
              'Subject', 
              'subject', 
              'select', 
              $subject, 
              array('required' => true), 
              $validate, 
              array('common' => 'Common', 'complain' => 'Conplain', 'compliment' => 'Compliment')
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
            $message = "";
            if (isset($_POST['message'])) $message = $_POST['message'];
            $data = commonHtmlFormTag (
              'Message', 
              'message', 
              'textarea', 
              $message, 
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
            $data = commonHtmlFormTag(
              '', 
              'send_email', 
              'submit', 
              'Send Email'
            );
            echo $data['print'];
          ?>
          <?php
            if (isset($_SESSION['contact_error'])) {
              echo "<br /><br />".$_SESSION['contact_error'];
              unset($_SESSION['contact_error']);
            }
          ?>
        </fieldset>
      </form>
      <?php } ?>
    </div>
    <?php
      if ($validate) {
        if ($valid == 4) {
          $header = "From: $name <$email>";
          $to = $email;
          $successful = mail($to,$subject,$message,$header);
          if ($successful) {
            $_SESSION['contact_success'] = true;
            header("Location: contact.php");
          } else {
            $_SESSION['contact_error'] = "<span class='error'>Unknown problem occured. Try again.</span>";
            header("Location: contact.php");
          }
        }
      }
    ?>
    <div id="subcontent">
      A contact form, to give the users, the opportunity to provide feedbacks; is given on this page.
    </div>
    <div id="footer">
      Small Food Restaurant Business Website. (Group Project).
    </div>
  </div>
</body>
</html>