<?php

/*
 * Shop for Functional Stoneware
 * @author    Blieque Mariguan <himself [at] blieque.co.uk>
 * @copyright licensed under GPL v3
 *
 * https://github.com/blieque/functionalstoneware.com/
 * https://gnu.org/licenses/gpl.html
 *
 */

include __DIR__ . '/../includes/builder.php';
include __DIR__ . '/../../../../common/private.php';

fs_open('Shop');

function zero_pad($string, $length) {

	while (strlen($string) < $length) {
		$string = '0' . $string;
	}

	return $string;
	
}

$mysqli = new mysqli('localhost', $mysql_read_un, $mysql_read_pw, 'functionalstoneware');

if ($mysqli->connect_errno) {
    echo "Database connection error.\nThe website maintainer will be informed.";
    mail($webmaster_mail,
    	 'Failed DB connection on ' . $_SERVER['SERVER_NAME'],
    	 "You done buggered up:\n" . $mysqli->connect_error,
    	 "MIME-Version: 1.0\r\nContent-Type: text/html; charset=utf-8\r\n");
	fs_close();
    exit();
}

$inventory_q = $mysqli->query('SELECT * FROM `shop`');
$inventory   = $inventory_q->fetch_all();
$item_count  = $inventory_q->num_rows;
$item_count_digits = strlen((string) $item_count);
$last_img_digits   = end($inventory)[4]; // avoids variables-in-reference notices
$last_img_digits   = explode(',', $last_img_digits);
$last_img_digits   = end($last_img_digits);
$last_img_digits   = strlen($last_img_digits);
$img_dir = '/assets/img/thumb/';

foreach ($inventory as $item) {

	# zero-pad the id for images

	$id_string = (string) $item[0];
	$id_string = zero_pad($id_string, $item_count_digits);

	# format price

	$price_float = $item[2] / 100;
	$price = '$' . (string) $price_float;

	# create thumbnail url

	$images = explode(',', $item[4]);
	$first_image = zero_pad($images[0], $last_img_digits);
	$img_src = $img_dir . 'no-img.svg';

	if (file_exists('..' . $img_dir . $first_image . '.jpg')) {
		$img_src = $img_dir . $first_image . '.jpg';
	}

	if (empty($_SERVER['HTTPS'])) {
		$img_src = 'http://'  . $_SERVER['SERVER_NAME'] . $img_src;
	} else {
		$img_src = 'https://' . $_SERVER['SERVER_NAME'] . $img_src;
	}


	echo "<div class=\"si\"><img src=\"$img_src\"><article><h2>$item[1]</h2><em>$price</em><p>$item[3]</p><button>ADD TO BASKET</button></article></div>";

}

$inventory_q->free();

fs_close();

?>