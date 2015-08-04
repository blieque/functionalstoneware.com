<?php

/*
 * Shop item page (head) for Functional Stoneware
 * @author    Blieque Mariguan <himself@blieque.co.uk>
 * @copyright MIT license
 *
 * https://github.com/blieque/functionalstoneware.com
 *
 */

# if the item has a name, use it

// var_dump($inventory);
$item = $inventory[strval($_GET['id']) - 1];

if (strlen($item[1]) > 0) {
	fs_open($item[1] . ' &ndash; Shop');
} else {
	fs_open('Shop');
}
