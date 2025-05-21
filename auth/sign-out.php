<?php 

session_start();


if (!isset($_SESSION['username'])) {
	header('location: ../index.php');
	exit();
}


unset($_SESSION['username']);
$_SESSION['message'] = 'Sign-Out was successful';
$_SESSION['message-type'] = 'info';

header('location: ../index.php');
exit();

?>