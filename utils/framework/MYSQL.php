<?php
$connection = new mysqli('rdbms.strato.de', 'U3545427', 'R22YG4aUuYtirZt', 'DB3545427');
$connection->set_charset('utf8');

if ($connection->connect_error) {
	die('There was an error connection to the back-end database, please try again later!');
}