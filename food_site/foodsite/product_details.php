<?php
  include 'php/db_fucntions.php';
  include 'php/utility_functions.php';
?>
<?php
  $search = '';
?>
<?php
  $product_id = '';
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['detail'])) {
      if (is_numeric($_GET['detail'])) {
        $product_id = $_GET['detail'];
      }
    }
  }
?>
<?php
  $details = getProductByProductId($product_id);
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
      <h2>Product Details</h2>
      <ul id="navigation">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </div>
    <div id="content">
      <h3>Product Details</h3>
      <?php
        if (is_string($details)) {
          echo $details;
        } else {
          echo "<p><u>Product Name</u>: <strong>".$details['product_name']."</strong></p>";
          echo "<p><u>Product Price</u>: <strong>".$details['product_price']."</strong></p>";
          echo "<p><u>Product Category</u>: <strong>".$details['category_name']."</strong></p>";
          echo "<p><u>Product Description</u>: <em>".utf8_encode($details['product_description'])."</em></p>";
        }
      ?>
    </div>
    <div id="subcontent">
      One single product details, that gets selected from products page, is given on this page.
      <br/><br/>
      This page, by itself, doesn't give any perticular product details by default.
    </div>
    <div id="footer">
      Small Food Restaurant Business Website. (Group Project).
    </div>
  </div>
</body>
</html>