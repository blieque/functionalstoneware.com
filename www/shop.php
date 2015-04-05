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
include __DIR__ . '/../includes/functions.php';
include __DIR__ . '/../../../common/private.php';

$mysqli = new mysqli('localhost',
			$mysql_read_un,
			$mysql_read_pw,
			'functionalstoneware');
mysqli_error_report($mysqli->connect_errno, $mysqli->connect_error);

$inventory_q = $mysqli->query('SELECT * FROM `shop`'); // select all the things
$inventory   = $inventory_q->fetch_all(); // fetch all the things
$item_count  = $inventory_q->num_rows; // count all the things

$inventory_q->free(); // free all the things (from memory)

$item_count_digits = strlen((string) $item_count);
$last_img_digits = end($inventory)[4]; // avoids variables-in-reference notices
$last_img_digits = explode(',', $last_img_digits);
$last_img_digits = end($last_img_digits);
$last_img_digits = strlen($last_img_digits);

if (isset($_GET['id'])) {
	include __DIR__ . '/../includes/shop-item-head.php';
} else {
	fs_open('Shop');
}

?>

<div id="sb">
	<a class="b">
		<svg width="24" height="14">
			<path d="M2 12L12 2L22 12"/>
		</svg>BASKET<span>0 items</span>
	</a>
	<div>
		<a id="sb-p" class="sb-pi">PROCEED<svg width="9" height="14">
			<path d="M2 2l5 5l-5 5"/>
		</svg></a>
		<ul>
			<li id="sb-n">No items</li>
		</ul>
	</div>
</div>

<?php

if (isset($_GET['id'])) {
	include __DIR__ . '/../includes/shop-item-body.php';
	exit();
}

$img_dir = 'assets/img/thumb/';

foreach ($inventory as $item) {

	# zero-pad the id for images

	$id_string = (string) $item[0];
	$id_string = zero_pad($id_string, $item_count_digits);

	# format price

	$price = format_price($item[2]);

	# format thumbnail and item urls

	$images = explode(',', $item[4]);
	$first_image = zero_pad($images[0], $last_img_digits);
	$img_src = $img_dir . 'no-img.svg';

	if (file_exists($img_dir . $first_image . '.jpg')) {
		$img_src = $img_dir . $first_image . '.jpg';
	}

	$host     = get_host();
	$img_src  = $host . '/' . $img_src;
	$item_url = $host . "/shop/$item[0]";

	echo "<a class=\"si\" href=\"$item_url\"><img src=\"$img_src\"><article><" .
		 "h2>$item[1]</h2><em>$price</em><p>$item[3]</p></article></a>";

}

fs_close();
