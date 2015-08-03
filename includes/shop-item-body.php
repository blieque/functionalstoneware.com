<?php

/*
 * Shop item page (body) for Functional Stoneware
 * @author    Blieque Mariguan <himself@blieque.co.uk>
 * @copyright MIT license
 *
 * https://github.com/blieque/functionalstoneware.com
 *
 */

$item_name = strlen($item[1]) > 0 ? $item[1] : 'Shop item';
$img_path  = '/assets/img/combined/' . zero_pad((string) $item[0], $item_count_digits) . '.jpg';
$price     = format_price($item[2]);

echo "<h1>$item_name</h1><div id=\"sip-i\" style=\"background-image:url($img_path)\"></div><p>$item[3]</p><div id=\"sip-p\">$price</div><a id=\"sip-a\" class=\"b\">ADD TO BASKET</a>";

fs_close();
