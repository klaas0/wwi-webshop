<?php
require('../utils/framework.php');

$msg = "external/suggestions.php";
$enc = Utils::encryptString($msg);
echo $enc . "<br>";
echo Utils::decryptString($enc);
?>