<?php

include 'template/header.php';
if ($page == 'home') {
    include 'view/home.php';
} else if ($page == 'aboutus') {
    include 'view/aboutus.php';
} else if ($page == 'products') {    
    $p = $db->protucts->all();
    include 'view/products.php';
}
include 'template/footer.php';

?>

