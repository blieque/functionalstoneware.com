<?php

/*
 * Template script for Functional Stoneware
 * @author    Blieque Mariguan <himself@blieque.co.uk>
 * @copyright MIT license
 *
 * https://github.com/blieque/functionalstoneware.com
 *
 */

function fs_open($title = '') { // opener/head function

    $pages_array = ['About',
                    'Contact',
                    'Gallery',
                    'Shop',
                    'Blog'];
    $page_index    = array_search($title, $pages_array);
    $current_class = 'class="current" ';

    if ($title != '') { // if a specific title is given, give it an en-dash
        $title .= ' &ndash; ';
    }

?>
<!DOCTYPE html><html>
<head>
    <title><?php echo $title ?>Functional Stoneware</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <link rel="apple-touch-icon-precomposed" type="image/png" href="/images/icon/180.png" sizes="180x180">
    <link rel="icon" type="image/png" href="/images/icon/192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="/images/icon/096.png" sizes="96x96">
    <link rel="icon" type="image/png" href="/images/icon/048.png" sizes="48x48">
    <link rel="icon" type="image/png" href="/images/icon/032.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/images/icon/016.png" sizes="16x16">
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/tablet.css" media="(max-device-width:27.5cm) or (max-device-width:1100px)">
    <link rel="stylesheet" href="/styles/smartphone.css" media="(max-device-width:16cm) or (max-device-width:720px)">
    <link rel="stylesheet" href="/styles/print.css" media="print">

    <script>if(window.location.host=='functionalstoneware.com'){alert('This website is under development. If you wish to contact Rhiain, please follow the Facebook page link at the top of the page.')}</script>
</head>
<body>
    <header>
        <nav>
            <a id="h" href="/">FUNCTIONAL<br><span>STONEWARE</span></a>
            <a <?php if ($page_index === 0) echo $current_class ?>href="/about">About</a>
            <a <?php if ($page_index === 1) echo $current_class ?>href="/contact">Contact</a>
            <a <?php if ($page_index === 2) echo $current_class ?>href="/gallery">Gallery</a>
            <a <?php if ($page_index === 3) echo $current_class ?>href="/shop">Shop</a>
            <a <?php if ($page_index === 4) echo $current_class ?>href="//blog.functionalstoneware.com">Blog</a>
            <div id="s">
                <a id="t" href="https://twitter.com/functstoneware"><svg width="32" height="32"><path d="M32 6.1c-1.2 0.5-2.4 0.9-3.8 1 1.4-0.8 2.4-2.1 2.9-3.6-1.3 0.8-2.7 1.3-4.2 1.6C25.8 3.8 24 3 22.2 3c-3.6 0-6.6 2.9-6.6 6.6 0 0.5 0.1 1 0.2 1.5C10.3 10.8 5.5 8.2 2.2 4.2c-0.6 1-0.9 2.1-0.9 3.3 0 2.3 1.2 4.3 2.9 5.5-1.1 0-2.1-0.3-3-0.8 0 0 0 0.1 0 0.1 0 3.2 2.3 5.8 5.3 6.4-0.6 0.2-1.1 0.2-1.7 0.2-0.4 0-0.8 0-1.2-0.1 0.8 2.6 3.3 4.5 6.1 4.6-2.2 1.8-5.1 2.8-8.2 2.8-0.5 0-1.1 0-1.6-0.1 2.9 1.9 6.4 3 10.1 3 12.1 0 18.7-10 18.7-18.7 0-0.3 0-0.6 0-0.8C30 8.5 31.1 7.4 32 6.1z"/></svg></a>
                <a id="l" href="https://www.linkedin.com/in/functionalstoneware"><svg width="32" height="32"><path d="M2.4 0C1.1 0 0 1.01 0 2.31l0 27.38C0 30.99 1.1 32 2.4 32l27.11 0C30.8 32 31.9 30.99 32 29.69L32 2.31C32 1.01 30.9 0 29.6 0L2.4 0zm4.67 4.41c1.5 0 2.71 1.18 2.71 2.78 0 1.5-1.22 2.81-2.71 2.81C5.58 10 4.3 8.79 4.3 7.19 4.4 5.59 5.58 4.41 7.07 4.41zm14.46 7.19c4.79 0 5.7 3.21 5.7 7.31l0 8.41-4.7 0 0-7.41c0-1.8 0-4-2.49-4-2.49 0-2.77 1.91-2.77 3.91l0 7.59-4.7 0 0-15.41 4.39 0 0 2.09 0.09 0c0.6-1.2 2.19-2.5 4.49-2.5zM4.67 12l4.7 0 0 15.31-4.7 0 0-15.31z"/></svg></a>
                <a id="f" href="https://www.facebook.com/rhiainnathansonpottery"><svg width="32" height="32"><path d="M30.2 0H1.8C0.8 0 0 0.8 0 1.8v28.5c0 1 0.8 1.8 1.8 1.8H17.1V19.6h-4.2v-4.8h4.2v-3.6c0-4.1 2.5-6.4 6.2-6.4 1.8 0 3.3 0.2 3.7 0.2v4.3l-2.6 0c-2 0-2.4 1-2.4 2.4v3.1h4.8l-0.6 4.8H22V32h8.2c1 0 1.8-0.8 1.8-1.8V1.8C32 0.8 31.2 0 30.2 0z"/></svg></a>
            </div>
        </nav>
    </header>
    <section>

<?php

}

function fs_close() { // close tags opened in the fs_open() function

?>

    </section>
    <footer><p>Content provided under MIT and Creative Commons BY-NC-SA licenses (<a class="reg-link" href="about#license">details</a>)</p></footer>
    <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
    <script src="/scripts/jquery.min.js"></script>
    <script src="/scripts/contact-form.js"></script>
    <script src="/scripts/shop.js"></script>
    <script src="/scripts/main.js"></script>
</body></html>

<?php

}
