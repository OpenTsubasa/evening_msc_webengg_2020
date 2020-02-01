<?php
  include 'php/db_fucntions.php';
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
      <h2>Announcements</h2>
      <ul id="navigation">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </div>
    <div id="content">
      <h3>All Announcements</h3>
      <?php
        $headings = array('Announcement Text', 'Announcement Date');
        $caption = "Site Announcements ordered Newest to Oldest";
        $no_sort = (-1);
        $result = getAllAnnouncements();
        if (mysqli_num_rows($result) == 0) {
          "Currently, there are no announcement available";
        } else {
          $data = resultToData($result);
          echo printTable($data, $headings, $caption, $no_sort, false, array(), array(), array(), array(), array(2));
        }
      ?>
    </div>
    <div id="subcontent">
      All the announcements made by the authority of Astor Mediterranean are listed here on this page.
      <br/><br/>
      The announcements are sorted by their release dates.
    </div>
    <div id="footer">
      Small Food Restaurant Business Website. (Group Project).
    </div>
  </div>
</body>
</html>