<?php  

session_start();
require '../core/config.php';


if (!isset($_SESSION['username'])) {
	header('location: ../index.php');
	exit();
}


if ($_SESSION['username'] !== $_GET['username']) {
	$url = $urls['account'] . $_GET['username'];
	header("location: $url");
}


$connection->query("DELETE FROM user WHERE username = '{$_SESSION['username']}'");
$connection->query("DELETE FROM post WHERE user = '{$_SESSION['username']}'");
$connection->query("DELETE FROM comment WHERE user = '{$_SESSION['username']}'");
$connection->query("DELETE FROM relation WHERE from_user = '{$_SESSION['username']}'");
$connection->query("DELETE FROM relation WHERE to_user = '{$_SESSION['username']}'");

unset($_SESSION['username']);
$_SESSION['message'] = 'Account was deleted';
$_SESSION['message-type'] = 'info';

header('location: ../index.php');
exit();

?>