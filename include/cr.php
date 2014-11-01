<?php

function copyright($single_line, $created) {

	if (($year = date("Y")) == $created) {
		$p[1] = $year;
	} else {
		$p[1] = $created . "&ndash" . ($year - 2000);
	}

	$p[0] = "Copyright &copy; ";

	if ($single_line == 1) {
		$p[2] = " &mdash ";
	} else {
		$p[2] = "<br>";
	}

	$p[3] = "Licenced under Creative Commons <a href=\"http://creativecommons.org/licenses/by-nc-sa/3.0/deed.en_GB\">BY-NC-SA 3.0</a>";

	for ($i=1; $i < 4; $i++) { 
		$p[0] .= $p[$i];
	}
}

?>