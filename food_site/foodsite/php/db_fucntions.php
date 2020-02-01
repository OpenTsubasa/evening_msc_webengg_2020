<?php
  require 'database.php';
  function deleteRowFromTableById($table, $id, $related = '')
  {
    $db = mysqli_connect("localhost", USERNAME, PASSWORD, DATABASE);
    $sql = "DELETE FROM `{$table}` WHERE `{$table}`.`id` = '{$id}'";
    if (!empty($related)) $sql = "DELETE FROM `{$table}` WHERE `{$table}`.`$related` = '{$id}'";
    echo "$sql";
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    if($result) {
      return true;
    } else {
      return false;
    }
  }
  function getRecentAnnouncement()
  {
    $db = mysqli_connect("localhost", USERNAME, PASSWORD, DATABASE);
    $sql = "SELECT `announcement_text` FROM `announcement` ORDER BY `announcement_date` DESC LIMIT 1";
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    if (mysqli_num_rows($result) == 0) {
      return "No announcement available";
    } else {
      $row = mysqli_fetch_row($result);
      return $row[0];
    }
  }
  function getAllAnnouncements()
  {
    $db = mysqli_connect("localhost", USERNAME, PASSWORD, DATABASE);
    $sql = "SELECT `announcement_text`, `announcement_date`, `id` FROM `announcement` ORDER BY `announcement_date` DESC";
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    return $result;
  }
  function getAllUserInfo()
  {
    $db = mysqli_connect("localhost", USERNAME, PASSWORD, DATABASE);
    $sql = "SELECT `user`.`user_name`, `profile`.`first_name`, `profile`.`last_name`, `profile`.`mailing_address`, `profile`.`email_address`, `user`.`id` FROM `user`, `profile` WHERE `user`.`id` = `profile`.`user_id`";
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    return $result;
  }
  function publishAnnouncement($announcement_text)
  {
    $announcement_date = date("Y-m-d");
    $db = mysqli_connect("localhost", USERNAME, PASSWORD, DATABASE);
    $sql = "INSERT INTO `announcement` (`announcement_text`, `announcement_date`) VALUES ('{$announcement_text}', '{$announcement_date}')";
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    if($result) {
      return true;
    } else {
      return false;
    }
  }
  function addCategory($category_name)
  {
    $db = mysqli_connect("localhost", USERNAME, PASSWORD, DATABASE);
    $sql = "INSERT INTO `category` (`category_name`) VALUES ('{$category_name}')";
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    if($result) {
      return true;
    } else {
      return false;
    }
  }
  function getAllFoodCategories()
  {
    $db = mysqli_connect("localhost", USERNAME, PASSWORD, DATABASE);
    $sql = "SELECT * FROM `category`";
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    return $result;
  }
  function getAllCategoryNames()
  {
    $db = mysqli_connect("localhost", USERNAME, PASSWORD, DATABASE);
    $sql = "SELECT `category_name`, `id`, `id` FROM `category`";
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    return $result;
  }
  function getCategoryNameById($category_id)
  {
    $db = mysqli_connect("localhost", USERNAME, PASSWORD, DATABASE);
    $sql = "SELECT `category_name` FROM `category` WHERE `id`='{$category_id}'";
    $result = mysqli_query($db, $sql);
    if(mysqli_num_rows($result) == 1) {
      mysqli_close($db);
      $row = mysqli_fetch_row($result);
      return $row[0];
    } else {
      mysqli_close($db);
      return 0;
    }
  }
  function updateCategoryNameById($category_name, $category_id)
  {
    $db = mysqli_connect("localhost", USERNAME, PASSWORD, DATABASE);
    $sql = "UPDATE `category` SET `category_name` = '{$category_name}' WHERE `id`='{$category_id}'";
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    if($result) {
      return true;
    } else {
      return false;
    }
  }
  function getAllProductsByCategoryOrSearch($category_id = '', $search = '')
  {
    $db = mysqli_connect("localhost", USERNAME, PASSWORD, DATABASE);
    if (empty($category_id)) $sql = "SELECT `product`.`product_name`, `product`.`product_price`, `product`.`id`, `category`.`category_name` FROM `product`, `category` WHERE `category`.`id` = `product`.`category_id`";
    else $sql = "SELECT `product_name`, `product_price`, `id` FROM `product` WHERE `category_id`='{$category_id}'";
    if (!empty($search)) $sql = "SELECT `product`.`product_name`, `product`.`product_price`, `product`.`id`, `category`.`category_name` FROM `product`, `category` WHERE `category`.`id` = `product`.`category_id` AND `product`.`product_name` LIKE '%{$search}%'";
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    if (mysqli_num_rows($result) == 0) {
      return "No product found, by name as: [<strong>$search</strong>]";
    } else {
      return $result;
    }
  }
  function getProductByProductId($product_id)
  {
    $db = mysqli_connect("localhost", USERNAME, PASSWORD, DATABASE);
    $sql = "SELECT `product`.`product_name`, `product`.`product_price`, `product`.`product_description`, `category`.`category_name` FROM `product`, `category` WHERE `category`.`id` = `product`.`category_id` AND `product`.`id`='{$product_id}' LIMIT 1";
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    if (mysqli_num_rows($result) == 0) {
      return "Product detail not available";
    } else {
      $row = mysqli_fetch_assoc($result);
      return $row;
    }
  }
  function checkForUser($user_name, $user_password)
  {
    $user_password = md5($user_password);
    $db = mysqli_connect("localhost", USERNAME, PASSWORD, DATABASE);
    $sql = "SELECT * FROM `user` WHERE `user_name`='{$user_name}' AND `user_password`='{$user_password}'";
    $result = mysqli_query($db, $sql);
    if(mysqli_num_rows($result) == 1) {
      mysqli_close($db);
      return true;
    } else {
      mysqli_close($db);
      return false;
    }
  }
  function checkForExistingUserName($user_name)
  {
    if ($user_name === "admin") {
      return true;
    }
    $db = mysqli_connect("localhost", USERNAME, PASSWORD, DATABASE);
    $sql = "SELECT id FROM `user` WHERE `user_name`='{$user_name}'";
    $result = mysqli_query($db, $sql);
    if(mysqli_num_rows($result) == 1) {
      mysqli_close($db);
      return true;
    } else {
      mysqli_close($db);
      return false;
    }
  }
  function getUserIdByUserName($user_name)
  {
    $db = mysqli_connect("localhost", USERNAME, PASSWORD, DATABASE);
    $sql = "SELECT id FROM `user` WHERE `user_name`='{$user_name}'";
    $result = mysqli_query($db, $sql);
    if(mysqli_num_rows($result) == 1) {
      mysqli_close($db);
      $row = mysqli_fetch_row($result);
      return $row[0];
    } else {
      mysqli_close($db);
      return 0;
    }
  }
  function getProfileIdByUserId($user_id)
  {
    $db = mysqli_connect("localhost", USERNAME, PASSWORD, DATABASE);
    $sql = "SELECT `id` FROM `profile` WHERE `user_id`='{$user_id}'";
    $result = mysqli_query($db, $sql);
    if(mysqli_num_rows($result) == 1) {
      mysqli_close($db);
      $row = mysqli_fetch_row($result);
      return $row[0];
    } else {
      mysqli_close($db);
      return 0;
    }
  }
  function getProfileDataByUserId($user_id)
  {
    $db = mysqli_connect("localhost", USERNAME, PASSWORD, DATABASE);
    $sql = "SELECT `id`, `first_name`, `last_name`, `mailing_address`, `email_address`, `category_id` FROM `profile` WHERE `user_id`='{$user_id}'";
    $result = mysqli_query($db, $sql);
    if(mysqli_num_rows($result) == 1) {
      mysqli_close($db);
      $row = mysqli_fetch_assoc($result);
      return $row;
    } else {
      mysqli_close($db);
      return 0;
    }
  }
  function addProfileForUserId($first_name, $last_name, $mailing_address, $email_address, $category_id, $user_id)
  {
    $db = mysqli_connect("localhost", USERNAME, PASSWORD, DATABASE);
    $sql = "INSERT INTO `profile` (`first_name`, `last_name`, `mailing_address`, `email_address`, `category_id`, `user_id`) VALUES ('{$first_name}', '{$last_name}', '{$mailing_address}', '{$email_address}', '{$category_id}', '{$user_id}')";
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    if($result) {
      return true;
    } else {
      return false;
    }
  }
  function updateProfileByProfileId($first_name, $last_name, $mailing_address, $email_address, $category_id, $profile_id)
  {
    $db = mysqli_connect("localhost", USERNAME, PASSWORD, DATABASE);
    $sql = "UPDATE `profile` SET `first_name` = '{$first_name}', `last_name` = '{$last_name}', `mailing_address` = '{$mailing_address}', `email_address` = '{$email_address}', `category_id` = '{$category_id}' WHERE `id` = '{$profile_id}'";
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    if($result) {
      return true;
    } else {
      return false;
    }
  }
  function registerUser($user_name, $user_password)
  {
    $user_password = md5($user_password);
    $db = mysqli_connect("localhost", USERNAME, PASSWORD, DATABASE);
    $sql = "INSERT INTO `user` (`user_name`, `user_password`) VALUES ('{$user_name}', '{$user_password}')";
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    if($result) {
      return true;
    } else {
      return false;
    }
  }
?>