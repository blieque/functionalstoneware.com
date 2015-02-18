<?php

/*
 * Contact page for Functional Stoneware
 * @author    Blieque Mariguan <himself [at] blieque.co.uk>
 * @copyright licensed under GPL v3
 *
 * https://github.com/blieque/functionalstoneware.com/
 * https://gnu.org/licenses/gpl.html
 *
 */

if (isset($_POST['action']) && $_POST['action'] == 'submit') {

	# validate input

	$err = [];

	if (empty($_POST['name'])) {
		$err[0] = 1;
	}

	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$err[1] = '2';
	}

	if (empty($_POST['message'])) {
		$err[2] = '3';
	}
	
	if (count($err) > 0) {
		echo implode('', $err);
		exit();
	}

	include '../includes/functions.php';

	function template_process($mail_template_path, $mail_directory, $mail_data) {

		$output				= '';
		$mail_template_path	= $mail_directory . $mail_template_path;

		if (file_exists($mail_template_path) && is_readable($mail_template_path)) {

			$output	= file_get_contents($mail_template_path);

		} else {

			echo '4: template (' . $mail_template_path . ') couldn\'t be found/read.';
			exit();

		}

		preg_match_all('/{{ ([A-z0-9#\/ .,]+) }}/', $output, $references);

		for ($i = 0; $i < count($references[0]); $i++) {

			$reference_curly = $references[0][$i];
			$reference		 = $references[1][$i];

			if (substr($reference, 0, 9) == '#include ') {

				$path	= $mail_directory . substr($reference, 9);
				if (file_exists($path) &&
					is_readable($path)) {

					$include = file_get_contents($path);
					$output  = str_replace('{{ ' . $reference . ' }}', $include, $output);

				}

			} else if (isset($mail_data[$reference])) {

				$output	= str_replace('{{ ' . $reference . ' }}', $mail_data[$reference], $output);

			}
			
		}

		return $output;

	}

	# construct email

	## organise and process data

	$mail_data		= [
		'name'		=> htmlentities($_POST['name']),
		'email'		=> htmlentities($_POST['email']),
		'title'		=> htmlentities($_POST['name']) . '\'s message',
		'message'	=> preg_replace('/[\n]+/', '</p><p>', htmlentities($_POST['message'])),
		'time'		=> date('Y-m-d \a\t H:i:s e')
	];

	$mail_directory	= __DIR__ . '/../includes/mail/';
	$mail_template	= 'template.html';

	$mail_message	= template_process($mail_template, $mail_directory, $mail_data);
	$mail_message	= minify($mail_message);

	## other variables for mail() arguments

	$mail_to		= 'Functional Stoneware <inquiries' . '@' . 'functionalstoneware.com>';	// split up to confuse any email collection bots

	$mail_subject	= 'New message from ' . $mail_data['email'];

	$mail_headers	= 'MIME-Version: 1.0' . "\r\n";
	$mail_headers  .= 'Content-Type: text/html; charset=utf-8' . "\r\n";
	$mail_headers  .= 'Reply-To: ' . $_POST['email'] . "\r\n";
	$mail_headers  .= 'From: Blieque.co.uk <postmaster@blieque.co.uk>' . "\r\n";
	$mail_headers  .= 'X-Mailer: PHP/' . phpversion();

	$mail_success	= mail($mail_to, $mail_subject, $mail_message, $mail_headers);

	if (!$mail_success) {
		echo '5';
	} else {
		echo '0';
	}

} else {

	include '../includes/builder.php';
	fs_open('Contact');

?>

<form method="post">
	<input name="name" placeholder="Name" type="text" tabindex="1"><input name="email" placeholder="Email Address" type="text" tabindex="2">
	<textarea name="message" placeholder="Message" rows="12" autocomplete="off" tabindex="3"></textarea>
	<div type="submit" tabindex="4">SUBMIT<svg width="32" height="24"><path id="r" d="M11 3L29 21M29 3L11 21"/><path id="g" d="M3 13L11 21L29 3"/></svg></div>
</form>

<?php

	fs_close();
}

?>