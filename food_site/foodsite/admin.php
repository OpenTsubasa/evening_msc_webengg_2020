<?php session_start(); ?>
<?php
  if ((!isset($_SESSION['user_name'])) || ($_SESSION['user_name'] != "admin")) {
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
  $valid = 0;
  $validate = false;
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['select_task'])) {
      $validate = true;
    } elseif (isset($_POST['cancel_selection'])) {
      unset($_SESSION['task_subject']);
    } elseif (isset($_POST['publish_announcement'])) {
      $validate = true;
    } elseif (isset($_POST['add_category'])) {
      $validate = true;
      $_SESSION['add_category'] = true;
    } elseif (isset($_POST['update_category'])) {
      $validate = true;
      $_SESSION['update_category'] = true;
    }
  } else {
    if (isset($_SESSION['task_subject'])) {
      if (isset($_GET['delete'])) {
        if (is_numeric($_GET['delete'])) {
          $table = $_SESSION['task_subject'];
          $id = $_GET['delete'];
          if ($table == 'announcement') {
            $_SESSION['announcement_deleted'] = deleteRowFromTableById($table, $id);
          } elseif ($table == 'user') {
            $_SESSION['user_deleted'] = deleteRowFromTableById('profile', $id, 'user_id');
            if ($_SESSION['user_deleted']) {
              $_SESSION['user_deleted'] = deleteRowFromTableById($table, $id);
            }
          } elseif ($table == 'category') {
            $_SESSION['category_deleted'] = deleteRowFromTableById($table, $id);
          }
        }
      } elseif (isset($_GET['edit'])) {
        if (is_numeric($_GET['edit'])) {
          $table = $_SESSION['task_subject'];
          $id = $_GET['edit'];
          $_SESSION['category_name'] = getCategoryNameById($id);
          $_SESSION['category_id'] = $id;
        }
      }
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
      <h2>Admin</h2>
      <ul id="navigation">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </div>
    <div id="content">
      <h3>Admin Area</h3>
      <?php if(!isset($_SESSION['task_subject'])) { ?>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
          <fieldset>
            <legend>Task Subject Selection Form</legend>
            <?php
              $task_subject = "";
              if (isset($_POST['task_subject'])) $task_subject = $_POST['task_subject'];
              $data = commonHtmlFormTag (
                'Select a Task Subject', 
                'task_subject', 
                'select', 
                $task_subject, 
                array('required' => true), 
                $validate, 
                array('announcement' => 'Announcements', 'product' => 'Products', 'category' => 'Categories', 'user' => 'Users')
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
                'select_task', 
                'submit', 
                'Select Task'
              );
              echo $data['print'];
            ?>
          </fieldset>
        </form>
      <?php } else { ?>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
          <fieldset>
            <legend>Task Subject Selection-Cancelation Form</legend>
            <p>Selected task subject is: <strong><?php echo $_SESSION['task_subject']; ?></strong></p>
            <?php
              $data = commonHtmlFormTag(
                '', 
                'cancel_selection', 
                'submit', 
                'Cancel Selection'
              );
              echo $data['print'];
            ?>
          </fieldset>
        </form>
      <?php } ?>
      <br /><hr /><br />
      <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <?php
          $data = commonHtmlFormTag(
            '', 
            'reload', 
            'submit', 
            'Reload Everything'
          );
          echo $data['print'];
        ?>
      </form>
      <br />
      <?php if (isset($_SESSION['task_subject']) && ($_SESSION['task_subject'] == "announcement")) {
        if(isset($_SESSION['announcement_published'])) {
          if ($_SESSION['announcement_published']) {
            echo "<p>Announcement Successfully Published.</p>";
          } else {
            echo "<p class='error'>Unknown problem occured. Try again.</p>";
          }
          unset($_SESSION['announcement_published']);
        }
        $announcement_text = "";
        if (isset($_POST['announcement_text'])) $announcement_text = $_POST['announcement_text'];
        $data = publishAnnouncementForm($announcement_text, $validate);
        if ($validate) {
          if ($data['valid']) {
            $valid++;
          }
        }
        echo $data['print'];
        echo "<br />";
        $result = getAllAnnouncements();
        $data = resultToData($result);
        $headings = array('Announcement Text', 'Announcement Date', 'Action');
        $caption = "Site Announcements ordered Newest to Oldest";
        $table = printTable($data, $headings, $caption, (-1), false, array(2), array('admin.php'), array('Remove'), array('delete'));
        if(isset($_SESSION['announcement_deleted'])) {
          if ($_SESSION['announcement_deleted']) {
            echo "<p>Announcement Successfully Deleted.</p>";
          } else {
            echo "<p class='error'>Unknown problem occured. Try again.</p>";
          }
          unset($_SESSION['announcement_deleted']);
        }
        echo $table;
        }
      ?>
      <?php if (isset($_SESSION['task_subject']) && ($_SESSION['task_subject'] == "category")) {
        if(isset($_SESSION['category_added'])) {
          if ($_SESSION['category_added']) {
            echo "<p>Category Successfully Added.</p>";
          } else {
            echo "<p class='error'>Unknown problem occured. Try again.</p>";
          }
          unset($_SESSION['category_added']);
        }
        $category_name = "";
        if (isset($_SESSION['category_name'])) {
          $category_name = $_SESSION['category_name'];
          unset($_SESSION['category_name']);
          $data = updateCategoryForm($category_name, $validate);
          if ($validate) {
            if ($data['valid']) {
              $valid++;
            }
          }
          echo $data['print'];
        } else {
          if (isset($_POST['category_name'])) $category_name = $_POST['category_name'];
          $data = addCategoryForm($category_name, $validate);
          if ($validate) {
            if ($data['valid']) {
              $valid++;
            }
          }
          echo $data['print'];
        }
        echo "<br />";
        $result = getAllCategoryNames();
        $data = resultToData($result);
        $headings = array('Category Name', 'Edit Action', 'Delete Action');
        $caption = "All Food Category Names";
        $table = printTable($data, $headings, $caption, (-1), false, array(1, 2), array('admin.php', 'admin.php'), array('change', 'Remove'), array('edit', 'delete'));
        if(isset($_SESSION['category_deleted'])) {
          if ($_SESSION['category_deleted']) {
            echo "<p>Category Successfully Deleted.</p>";
          } else {
            echo "<p class='error'>Unknown problem occured. Try again.</p>";
          }
          unset($_SESSION['category_deleted']);
        }
        if(isset($_SESSION['category_changed'])) {
          if ($_SESSION['category_changed']) {
            echo "<p>Category Successfully Changed.</p>";
          } else {
            echo "<p class='error'>Unknown problem occured. Try again.</p>";
          }
          unset($_SESSION['category_changed']);
        }
        echo $table;
        }
      ?>
      <?php if (isset($_SESSION['task_subject']) && ($_SESSION['task_subject'] == "user")) {
        $result = getAllUserInfo();
        $data = resultToData($result);
        $headings = array('User Name', 'First Name', 'Last Name', 'Mailing Address', 'Email Address', 'Action');
        $caption = "All user Info";
        $table = printTable($data, $headings, $caption, (-1), false, array(5), array('admin.php'), array('Remove'), array('delete'));
        if(isset($_SESSION['user_deleted'])) {
          if ($_SESSION['user_deleted']) {
            echo "<p>User Successfully Deleted.</p>";
          } else {
            echo "<p class='error'>Unknown problem occured. Try again.</p>";
          }
          unset($_SESSION['user_deleted']);
        }
        echo $table;
        }
      ?>
    </div>
    <?php if (!isset($_SESSION['task_subject'])) { ?>
      <?php
        if ($validate) {
          if ($valid == 1) {
            $_SESSION['task_subject'] = $task_subject;
            header("Location: admin.php");
          }
        }
      ?>
    <?php } elseif ($_SESSION['task_subject'] == "announcement") { ?>
      <?php
        if ($validate) {
          if ($valid == 1) {
            $_SESSION['announcement_published'] = publishAnnouncement($announcement_text);
            header("Location: admin.php");
          }
        }
      ?>
    <?php } elseif (($_SESSION['task_subject'] == "category") && (isset($_SESSION['add_category']))) { ?>
      <?php
        unset($_SESSION['add_category']);
        if ($validate) {
          if ($valid == 1) {
            $_SESSION['category_added'] = addCategory($category_name);
            header("Location: admin.php");
          }
        }
      ?>
    <?php } elseif (($_SESSION['task_subject'] == "category") && (isset($_SESSION['update_category']))) { ?>
      <?php
        unset($_SESSION['update_category']);
        if ($validate) {
          if ($valid == 1) {
            $id = $_SESSION['category_id'];
            unset($_SESSION['category_id']);
            $_SESSION['category_changed'] = updateCategoryNameById($category_name, $id);
            header("Location: admin.php");
          } else {
            $_SESSION['category_name'] = getCategoryNameById($_SESSION['category_id']);
            header("Location: admin.php");
          }
        }
      ?>
    <?php } ?>
    <div id="subcontent">
      This is the admin's private page. Only the admin (after logging in) can access this page.
      <br/><br/>
      Admin can perform many different data manipulation tasks on this page.
    </div>
    <div id="footer">
      Small Food Restaurant Business Website. (Group Project).
    </div>
  </div>
</body>
</html>