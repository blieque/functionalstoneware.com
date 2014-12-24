<?php

if (isset($_POST["action"]) && $_POST["action"] == "submit") {

	$err = [];

	if (empty($_POST["name"])) {
		$err[0] = 1;
	}

	if (!filter_var($_POST["mail"],FILTER_VALIDATE_EMAIL)) {
		$err[1] = 2;
	}

	if (empty($_POST["text"])) {
		$err[2] = 3;
	}
	
	if (count($err) > 0) {
		echo $err[0] . $err[1] . $err[2];
	} else {
		echo "0";
	}

} else {

	include "../includes/builder.php";
	fs_open("Contact");

?>

<form method="post">
	<input name="name" placeholder="Name" type="text"><input name="email" placeholder="Email Address" type="text">
	<textarea name="message" placeholder="Message" rows="12" autocomplete="off"></textarea>
	<div type="submit">SUBMIT<svg width="32" height="24"><path id="r" d="M11 3L29 21M29 3L11 21"/><path id="g" d="M3 13L11 21L29 3"/></svg></div>
</form>

<?php
	fs_close();
}
?>