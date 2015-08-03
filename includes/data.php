<?php

/*
 * Backend data-fetching script for Functional Stoneware
 * @author    Blieque Mariguan <himself@blieque.co.uk>
 * @copyright MIT license
 *
 * https://github.com/blieque/functionalstoneware.com
 *
 */

include __DIR__ . '/functions.php';
include __DIR__ . '/../../../../common/private.php';

if (!isset($_GET['id'])) {
	exit();
}

$id = intval($_GET['id']);

if ($id == 0) {
	exit();
}

$mysqli = new mysqli('localhost', $mysql_read_un, $mysql_read_pw, 'functionalstoneware');
mysqli_error_report($mysqli->connect_errno, $mysqli->connect_error, false);

$item_q = $mysqli->query('SELECT name,price FROM `shop` WHERE `id` = ' . $_GET['id']);
$item   = $item_q->fetch_all();

$item_q->free();

$item = $item[0];

echo "[\"$item[0]\",\"$item[1]\"]";
