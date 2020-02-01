<?php session_start(); ?>
<?php
  include 'php/db_fucntions.php';
  include 'php/utility_functions.php';
?>
<?php
  $search = 'Some Text';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php echo searchForm($search); ?>
</body>
</html>