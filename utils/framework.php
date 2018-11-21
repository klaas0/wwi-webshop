<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('framework/MYSQL.php');
require('framework/utils.php');
include('framework/product.php');
include('framework/cart.php');
session_name('SID');
session_start();

$cart = new Cart();
$cart->loadData(Utils::getCookie(Text::CARTNAME));