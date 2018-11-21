<?php
require ('../utils/framework.php');

$cart->addProduct(1, 2);
$cart->addProduct(1);
$cart->addProduct(2, 3);
$cart->addProduct(3, 2);
$cart->removeProduct(3, 1);
$cart->saveData();
print_r($cart);

?>

