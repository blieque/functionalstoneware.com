<?php

/*
 * Shop item page (head) for Functional Stoneware
 * @author    Blieque Mariguan <himself [at] blieque.co.uk>
 * @copyright licensed under GPL v3
 *
 * https://github.com/blieque/functionalstoneware.com/
 * https://gnu.org/licenses/gpl.html
 *
 */

# if the item has a name, use it

$item = $inventory[strval($_GET['id'])];

if (strlen($item[1]) > 0) {
	fs_open($item[1] . ' &ndash; Shop');
} else {
	fs_open('Shop');
}
