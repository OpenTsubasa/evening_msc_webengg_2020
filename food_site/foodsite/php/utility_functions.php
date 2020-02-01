<?php
  function commonHtmlFormTag ($label, $name, $type, $value, $rules = array(), $validate = false, $extra_attrs = '') {
    $valid = false;
    $print = "";
    if (!empty($label)) {
      $print .= "<label for='$name'>";
      $print .= "<span>$label:</span>";
    }
    if ($validate) {
      $error_message = "[Errors:";
      if (isset($rules['required'])) {
        if ($rules['required']) {
          if (empty($value)) {
            $error_message .= " (Required)";
          }
        }
      }
      if (isset($rules['max_length'])) {
        if ($rules['max_length'] < strlen($value)) {
          $error_message .= " (Length must be less than or equal ".$rules['max_length'].")";
        }
      }
      if (isset($rules['min_length'])) {
        if ($rules['min_length'] > strlen($value)) {
          $error_message .= " (Length must be greater than or equal ".$rules['min_length'].")";
        }
      }
      if (isset($rules['match'])) {
        if ($rules['match'] !== $value) {
          $error_message .= " (Match failed)";
        }
      }
      if ($error_message === "[Errors:") {
        $error_message = "";
        $valid = true;
      } else {
        $error_message .= "]";
      }
      if (!empty($error_message)) {
        $print .= "&nbsp;&nbsp;<span class='error'>$error_message</span>";
      }
    }
    if (!empty($label)) {
      $print .= "<br />";
    }
    if ($type == 'textarea') {
      $print .= "<textarea name='$name' $extra_attrs>$value</textarea>";
    } elseif ($type == 'select') {
      $print .= "<select name='$name'>";
      $print .= "<option value=''>-- Select An Option --</option>";
      foreach ($extra_attrs as $value_attr => $option_attr) {
        if ($value_attr == $value) {
          $print .= "<option value='$value_attr' selected='true'>$option_attr</option>";
        } else {
          $print .= "<option value='$value_attr'>$option_attr</option>";
        }
      }
      $print .= "</select>";
    } else {
      $print .= "<input type='$type' name='$name' $extra_attrs";
      if ($type != 'password') {
        $print .= " value='$value'";
      }
      $print .= " />";
    }
    if (!empty($label)) {
      $print .= "</label>";
    }
    $data['print'] = $print;
    $data['valid'] = $valid;
    return $data;
  }
  function resultToData($result)
  {
    $i = 1;
    while ($row = mysqli_fetch_row($result)) {
      $rows[$i++] = $row;
    }
    $data = $rows;
    return $data;
  }
  function sortData($data, $column, $direction = '') {
    foreach ($data as $key => $row) {
      $sort_by[$key] = $row[$column];
    }
    if (empty($direction)) {
      array_multisort($sort_by, SORT_ASC, $data);
    } else {
      if ($direction === 'ASC') {
        array_multisort($sort_by, SORT_ASC, $data);
      } elseif ($direction === 'DESC') {
        array_multisort($sort_by, SORT_DESC, $data);
      } else {
        array_multisort($sort_by, SORT_ASC, $data);
      }
    }
    return $data;
  }
  function printTable($data, $headings, $caption, $no_sort, $direction = false, $column_detail = array(), $link = array(), $text = array(), $action = array(), $skip = array()) {
    $table = "<table  class=\"information_table\"><caption>$caption</caption><thead><tr>";
    foreach ($headings as $key => $value) {
      if ($key > $no_sort) {
        $table .= "<th>$value</th>";
      } else {
        $this_file = $_SERVER['PHP_SELF'];
        if ($direction) {
          $table .= "<th>$value&nbsp;<a href=\"$this_file?col=$key&dir=ASC\">&#9650</a>&nbsp;<a href=\"$this_file?col=$key&dir=DESC\">&#9660</a></th>";
        } else {
          $table .= "<th><a href=\"$this_file?sort=$key\">$value</a></th>";
        }
      }
    }
    $table .= "</tr></thead><tbody>";
    foreach ($data as $key1 => $row) {
      $table .= "<tr>";
      foreach ($row as $key2 => $value) {
        $j = false;
        for ($i=0; $i < count($skip); $i++) {
          if ((!empty($skip)) && ($skip[$i] == $key2)) {
            $j = true;
            break;
          }
        }
        if ($j == true) {
          continue;
        }
        $j = false;
        for ($i=0; $i < count($column_detail); $i++) {
          if ((!empty($column_detail)) && ($column_detail[$i] == $key2) && (!empty($action))) {
            $table .= "<td><a href=\"$link[$i]?$action[$i]=$value\">$text[$i]</a></td>";
            $j = true;
          }
        }
        if ($j == false) {
          $table .= "<td>$value</td>";
        }
      }
      $table .= "</tr>";
    }
    $table .= "</tbody></table>";
    $table .= "</table>";
    return $table;
  }
  function searchForm($search = '')
  {
    $form = "<br /><br />";
    $form .= "<div>";
    $form .= "<form action='products.php' method='post'>";
    $data = commonHtmlFormTag('Enter Search String', 'search_string', 'text', $search, array(), false, 'id=\'search_field\'');
    $form .= $data['print'];
    $form .= "&nbsp;";
    $data = commonHtmlFormTag('', 'search', 'submit', 'Search');
    $form .= $data['print'];
    $form .= "&nbsp;";
    $data = commonHtmlFormTag('', 'clear_search', 'submit', 'Cleaar Search');
    $form .= $data['print'];
    $form .= "</form>";
    $form .= "</div>";
    return $form;
  }
  function publishAnnouncementForm($announcement_text = '', $validate = false)
  {
    $valid = false;
    $form = "<div>";
    $form .= "<form action='admin.php' method='post'>";
    $data = commonHtmlFormTag('Announcement Text', 'announcement_text', 'textarea', $announcement_text, array('required' => true), $validate);
    $form .= $data['print'];
    $valid = $data['valid'];
    $form .= "&nbsp;";
    $data = commonHtmlFormTag('', 'publish_announcement', 'submit', 'publish Announcement');
    $form .= $data['print'];
    $form .= "</form>";
    $form .= "</div>";
    $data['print'] = $form;
    $data['valid'] = $valid;
    return $data;
  }
  function addProductForm($product_name = '', $product_price = '', $product_description = '', $category_id = '', $validate = false)
  {

  }
  function addCategoryForm($category_name = '', $validate = false)
  {
    $valid = false;
    $form = "<div>";
    $form .= "<form action='admin.php' method='post'>";
    $data = commonHtmlFormTag('Category Name', 'category_name', 'text', $category_name, array('required' => true), $validate);
    $form .= $data['print'];
    $valid = $data['valid'];
    $form .= "&nbsp;";
    $data = commonHtmlFormTag('', 'add_category', 'submit', 'Add Category');
    $form .= $data['print'];
    $form .= "</form>";
    $form .= "</div>";
    $data['print'] = $form;
    $data['valid'] = $valid;
    return $data;
  }
  function updateCategoryForm($category_name = '', $validate = false)
  {
    $valid = false;
    $form = "<div>";
    $form .= "<form action='admin.php' method='post'>";
    $data = commonHtmlFormTag('Category Name', 'category_name', 'text', $category_name, array('required' => true), $validate);
    $form .= $data['print'];
    $valid = $data['valid'];
    $form .= "&nbsp;";
    $data = commonHtmlFormTag('', 'update_category', 'submit', 'Update Category');
    $form .= $data['print'];
    $form .= "</form>";
    $form .= "</div>";
    $data['print'] = $form;
    $data['valid'] = $valid;
    return $data;
  }
?>