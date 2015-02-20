<?php

/*
 * Functions script for Functional Stoneware
 * @author    Blieque Mariguan <himself [at] blieque.co.uk>
 * @copyright licensed under GPL v3
 *
 * https://github.com/blieque/functionalstoneware.com/
 * https://gnu.org/licenses/gpl.html
 *
 */

/* html minifier */
function minify($html) {

	// tab indentation
	$html = preg_replace('/[\t]*/', '', $html);
	// newlines
	$html = preg_replace('/[\n]*/', '', $html);
	// HTML comments
	$html = preg_replace('/<!\-\-.*?\-\->/', '', $html);

	return $html;

}

/* gets host with protocol, e.g., 'https://fs.com' */
function get_host() {

	$protocol = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
	return $protocol . $_SERVER['SERVER_NAME'];

}

function mysqli_error_report($errno, $error, $echo = true) {

	if ($errno) {

		if ($echo) {
			echo "Database connection error.\nThe website maintainer will be informed.";
		}
		mail($webmaster_mail,
			 'Failed DB connection on ' . $_SERVER['SERVER_NAME'],
			 "You done buggered up:\n" . $error,
			 "MIME-Version: 1.0\r\nContent-Type: text/html; charset=utf-8\r\n");
		fs_close();

		exit();

	}

}

function format_price($in_cents) {

	$price_div = $in_cents / 100;
	$price = (string) $price_div;

	$length_int = strlen((string) $in_cents);
	$length_div = strlen($price);

	if ($length_div == $length_int - 2) {
		$price .= ".00";
	} elseif ($length_div == $length_int) {
		$price .= "0";
	}

	return '$' . $price;

}

function zero_pad($string, $length) {

	while (strlen($string) < $length) {
		$string = '0' . $string;
	}

	return $string;
	
}
