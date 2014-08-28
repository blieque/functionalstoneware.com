<?php
/*
	Template script for Functional Stoneware
	Created by Blieque Mariguan
	Licensed under GNU GPL v2
*/

include "cr.php"; // copyright

function fs_open($title = "") { // opener/head function, declare recieved variable
	$cr = copyright(0,2014,0);
	if ($title != "") { // if a specific title is passed to function, process it
		$title .= " &ndash; ";
	}
	?>
	<!DOCTYPE html><html><head>
		<title><?php echo $title ?>Functional Stoneware</title>
		<link rel="shortcut icon" href="/images/favicon.ico" />
		<link rel="stylesheet" href="/m.css">
		<link rel="stylesheet" href="/t.css" media="(max-device-width:27.5cm) or (max-device-width:1100px)">
		<link rel="stylesheet" href="/sp.css" media="(max-device-width:16cm) or (max-device-width:720px)">
		<link rel="stylesheet" href="/p.css" media="print">
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script src="jquery.fs.js"></script>
	</head><body>
		<header>
			<ul>
				<li>
					<a href="">
						<h1><span>Rhiain</span><br>Nathanson</h1>
						<h2>Functional stoneware</h2>
					</a>
				</li>
				<li><a href="about">ABOUT</a></li>
				<li><a href="gallery">GALLERY</a></li>
				<li><a href="shop">SHOP</a></li>
				<li><a href="//blog.functionalstoneware.com">BLOG</a></li>
				<li id="s">
					<ul>
						<li><a id="fb" href="//facebook.com/functionalstoneware">Facebook</a></li>
						<li><a id="li" href="//linkedin.com/functionalstoneware">LinkedIn</a></li>
						<li><a id="tw" href="//twitter.com/funcstoneware">Twitter</a></li>
					</ul>
				</li>
			</ul>
		</header>
		<section>
<?php
}
function fs_close() { // close tags opened in the fs_open() function
?>
</section></body></html>
<?php
}
?>
