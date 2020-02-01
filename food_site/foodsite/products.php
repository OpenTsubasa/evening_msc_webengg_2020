<?php session_start(); ?>
<?php
  include 'php/db_fucntions.php';
  include 'php/utility_functions.php';
?>
<?php
  $search = '';
?>
<?php
  $column = '';
  $direction = '';
  $validate = false;
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['filter_products'])) {
      $validate = true;
      $_SESSION['category_id'] = $_POST['category_id'];
      unset($_SESSION['search_string']);
    } elseif (isset($_POST['clear_filter'])) {
      unset($_SESSION['category_id']);
      unset($_POST['category_id']);
    }
    if (isset($_POST['search'])) {
      $_SESSION['search_string'] = $_POST['search_string'];
      unset($_SESSION['category_id']);
      unset($_POST['category_id']);
    } elseif (isset($_POST['clear_search'])) {
      unset($_SESSION['search_string']);
    }
  } else {
    if (isset($_GET['col'])) {
      if (is_numeric($_GET['col'])) {
        if ( ($_GET['col'] >= 0) && ($_GET['col'] <= 1) ) {
          $column = $_GET['col'];
        }
      }
    }
    if (isset($_GET['dir'])) {
      if (($_GET['dir'] === 'ASC') || ($_GET['dir'] === 'DESC')) {
        $direction = $_GET['dir'];
      }
    }
  }
  $food_categories = getAllFoodCategories();
  $t = array();
  while ($row = mysqli_fetch_row($food_categories)) {
    $t[$row[0]] = ucfirst($row[1]);
  }
  $food_categories = $t;
  if (isset($_SESSION['category_id'])) {
    $category_id = $_SESSION['category_id'];
  } elseif (isset($_POST['category_id'])) {
    $category_id = $_POST['category_id'];
  } else {
    $category_id = '';
  }
  if (isset($_SESSION['search_string'])) {
    $search = $_SESSION['search_string'];
  }
?>
<?php
  $result = getAllProductsByCategoryOrSearch($category_id, $search);
  if (is_string($result)) {
    $table = $result;
  } else {
    $data = resultToData($result);
    if (($column !== '') && (!empty($direction))) {
      $data = sortData($data, $column, $direction);
    }
    if (empty($category_id)) {
      $headings = array('Product Name', 'Product Price', 'Click to see Details', 'Category');
    } else {
      $headings = array('Product Name', 'Product Price', 'Click to see Details');
    }
    $caption = "List of Product(s)";
    $table = printTable($data, $headings, $caption, 1, true, array(2), array('product_details.php'), array('Description'), array('detail'));
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
      <h2>Products</h2>
      <ul id="navigation">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li class="active">Products</li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </div>
    <div id="content">
      <h3>Our Product Categories</h3>
      <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <fieldset>
          <legend>Choose and Submit to Filter by Category</legend>
          <?php
            if (isset($_POST['category_id'])) $category_id = $_POST['category_id'];
            $data = commonHtmlFormTag (
              'Select Category', 
              'category_id', 
              'select', 
              $category_id, 
              array('required' => true), 
              $validate, 
              $food_categories
            );
            echo $data['print'];
          ?>
          <br /><br />
          <?php
            $data = commonHtmlFormTag(
              '', 
              'filter_products', 
              'submit', 
              'Filter Products'
            );
            echo $data['print'];
          ?>
          &nbsp;&nbsp;
          <?php
            $data = commonHtmlFormTag(
              '', 
              'clear_filter', 
              'submit', 
              'Clear Filter'
            );
            echo $data['print'];
          ?>
        </fieldset>
      </form>
      <br/><br/>
      <?php if (!empty($category_id)) { ?>
      <h3>Selected Category-Wise Product(s)</h3>
      <?php } elseif (!empty($search)) { ?>
      <h3>Search-String[<strong><?php echo $search;?></strong>]-Wise Product(s)</h3>
      <?php } else { ?>
      <h3>All Product(s)</h3>
      <?php } ?>
      <?php echo $table; ?>
    </div>
    <div id="subcontent">
      A list of products that can be filtered by category is given on this page.
      <br/><br/>
      The results can be sorted by name and price in both ascending and descending order.
    </div>
    <div id="footer">
      Small Food Restaurant Business Website. (Group Project).
    </div>
  </div>
</body>
</html>