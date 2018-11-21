<?php
require('../utils/framework.php');
/**
 * Created by PhpStorm.
 * User: sebastiaandirks
 * Date: 20/11/2018
 * Time: 09:40
 */

//$_POST['data'] = "qqJZjSeRSZzxf2nFGqGu4yempCHMzwmHV3X+5Hu/GwpJohVQUMf8gTpJdcuUJo4Lf5RpOkOsd6YnvvS6nMxn1tWLiWQ9Srjj";
function process() {
    $inc = isset($_POST['data']) ? $_POST['data'] : null;
    if ($inc == null) {
        return false;
    }
    $dec = Utils::decryptString($inc);
    if ($dec == null) {
        return false;
    }
    $dec = '../'.$dec;
    if (!file_exists($dec) || !is_readable($dec)) {
        return false;
    }
    return $dec;
}

$pro = process();
if ($pro !== false) {
    include_once($pro);
} else {
    echo "Error.";
}