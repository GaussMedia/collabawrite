<?php
	if (isset($_GET['song'])) {
		if (file_exists(stripslashes($_GET[song]))) {
			echo "<embed src=\"".dirname($_SERVER['PHP_SELF'])."/".stripslashes($_GET[song])."\" CONTROLS=\"SMALLCONSOLE\" />";
		}
		else echo "File Not Found";
		}
	else echo "No Song Selected!";
?>
