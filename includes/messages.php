<?php

if (isset($_SESSION['message']) and isset($_SESSION['message-type'])) {
	$message = $_SESSION['message'];
	$message_type = $_SESSION['message-type'];
	echo("<div id='message'><h5 class='message alert alert-$message_type'>$message</h5></div>");
	unset($_SESSION['message']);
	unset($_SESSION['message-type']);
}

?>