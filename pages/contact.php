<?php if ($_POST['a'] == "s") {
	echo "gettin' hit up";
	echo $_POST["name"] . $_POST["mail"] . $_POST["text"];
} else { include"../_cgi-bin/builder.php";fs_open("Contact")?>
<form method="post"><input name="name" placeholder="Name" type="text"><input name="mail" placeholder="Email Address" type="text"><textarea name="text" placeholder="Message" rows="12"></textarea><div type="submit">SUBMIT
<svg width="30" height="24">
	<path id="e" d="M8 2L28 22M28 2L8 22"/>
	<path id="s" d="M2 16L8 22L28 2"/>
</svg>
</div></form><?php fs_close();}?>