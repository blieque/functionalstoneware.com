<?php

/*
 * Gallery for Functional Stoneware
 * @author    Blieque Mariguan <himself@blieque.co.uk>
 * @copyright MIT license
 *
 * https://github.com/blieque/functionalstoneware.com
 *
 */

include __DIR__ . '/includes/builder.php';
fs_open('Gallery');

for ($i = 1; $i <= 83; $i++) {

    $id;

    if ($i < 10) {
        $id = '0' . $i;
    } else {
        $id = $i;
    }

    echo "<a href=\"/images/full/$id.jpg\"><img src=\"/images/thumb/$id.jpg\"></a>";

}

fs_close();
