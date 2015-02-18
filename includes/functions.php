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

function minify($input) {

	$output	= $input;

	$output	= preg_replace('/[\t]*/', '', $output);						// tab indentation
	$output	= preg_replace('/[\n]*/', '', $output);						// newlines
	$output	= preg_replace('/<!\-\-.*?\-\->/', '', $output);			// HTML comments

	return $output;

}
