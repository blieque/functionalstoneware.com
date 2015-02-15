<?php

function template_process($input) {

	if (is_readable($mail_template)) {
		$mail_template	= file_get_contents($mail_template);
	} else {
		echo "4: template (" . $mail_template . ") couldn't be found/read.";
		exit();
	}

	preg_match_all("/{{ ([A-z0-9#\/ .,]+) }}/", $mail_template, $references);

	foreach ($references as &$reference) {

		if (substr($reference, 0, 9) == "#include ") {



		} elseif (isset($mail_data[$reference])) {

		}

	}

	return 0;

	/*
		for ($i = 0; $i < count($heading_lines[0]); $i++) { 

			$position		= strpos($markdown,$heading_lines[0][$i]);
			if ($position !== false) {
				$markdown	= substr_replace($markdown,$replacements[$i],$position,strlen($heading_lines[0][$i]));
			}

		}
	*/

}

if (isset($_POST["action"]) && $_POST["action"] == "submit") {

	# validate input

	$err = [];

	if (empty($_POST["name"])) {
		$err[0] = 1;
	}

	if (!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)) {
		$err[1] = 2;
	}

	if (empty($_POST["message"])) {
		$err[2] = 3;
	}
	
	if (count($err) > 0) {
		echo implode("", $err);
		exit();
	}

	# construct email

	## organise and process data

	$mail_data		= [
		"name"		-> $_POST["name"],
		"email"		-> $_POST["email"],
		"title"		-> $_POST["name"] . "'s message",
		"formatted"	-> preg_replace("/[\n]+/", "</p><p>", $_POST["message"]),
		"time"		-> date("Y-m-d \at H:i:s e")
	];

	$mail_directory	= "includes/mail/";
	$mail_template	= $mail_directory . "template.html";

	$mail_message	= template_process($mail_template);

	## other variables for mail() arguments

	$mail_to		= "Willy <bliequearts@gmail.com>";

	$mail_subject	= "Testing mail";

	$mail_headers	= "MIME-Version: 1.0\r\n";
	$mail_headers  .= "Content-Type: text/html; charset=utf-8\r\n";
	$mail_headers  .= "Reply-To: " . $_POST["email"] . "\r\n";
	$mail_headers  .= "From: Blieque.co.uk <postmaster@blieque.co.uk>\r\n";

	$mail_success	= mail($mail_to, $mail_subject, $mail_message, $mail_headers);

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