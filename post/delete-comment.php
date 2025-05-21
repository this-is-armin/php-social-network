<?php  

session_start();
require '../core/config.php';


if (!isset($_SESSION['username'])) {
	header('location: ../index.php');
	exit();
}


$comment_query = $connection->query("SELECT * FROM comment WHERE ID = '{$_GET['id']}'");
$comment_info = mysqli_fetch_array($comment_query);

if ($_SESSION['username'] !== $comment_info['user']) {
	$url = $urls['post-detail'] . $comment_info['post_id'];
	header("location: $url");
	exit();
}

$connection->query("DELETE FROM comment WHERE ID = '{$_GET['id']}'");

$_SESSION['message'] = 'Comment was deleted';
$_SESSION['message-type'] = 'info';

$url = $urls['post-detail'] . $comment_info['post_id'];
header("location: $url");

?>