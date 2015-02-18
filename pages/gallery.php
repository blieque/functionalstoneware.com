<?php

/*
 * Gallery for Functional Stoneware
 * @author    Blieque Mariguan <himself [at] blieque.co.uk>
 * @copyright licensed under GPL v3
 *
 * https://github.com/blieque/functionalstoneware.com/
 * https://gnu.org/licenses/gpl.html
 *
 */

include '../includes/builder.php';
fs_open('Gallery');

for ($i = 1; $i <= 85; $i++) {

	$id;

	if ($i < 10) {
		$id = '0' . $i;
	} else {
		$id = $i;
	}

	echo "<a href=\"/assets/img/full/$id.jpg\"><img src=\"/assets/img/thumb/$id.jpg\"></a>";

}

fs_close();

?>