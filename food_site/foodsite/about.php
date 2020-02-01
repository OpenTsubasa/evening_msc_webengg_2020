<?php
  include 'php/utility_functions.php';
?>
<?php
  $search = '';
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
      <h2>About</h2>
      <ul id="navigation">
        <li><a href="index.php">Home</a></li>
        <li class="active">About</li>
        <li><a href="products.php">Products</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </div>
    <div id="content">
      <h3>Basic Information</h3>
      For Mediterranean food, Adams Morgan and Alexandria insiders know: the best is at Astor Mediterranean. Our half-chicken dinners and platters make for a savory sit-down or takeout treat. Pair our Falafel Sandwich with a fluffy Baba Ghanooj or match our Lamb Kabob to an elegant Egyptian Salad. No matter the time of year, you can come to Astor for a bit of Mediterranean sunshine. Our clever prices mean you don't get back pennies - keeping your pockets as light as our Lentil Salad!
    </div>
    <div id="subcontent">
      Basic information of the business is given on this page.
    </div>
    <div id="footer">
      Small Food Restaurant Business Website. (Group Project).
    </div>
  </div>
</body>
</html>