<?php
	$file = fopen("../Logs/Calendar.txt", "a");
	fwrite($file, $_POST["aptDate"] . "<>" . $_POST["aptUser"] . "<>" . $_POST["aptDesc"] . "\n");
	fclose($file);
	header("Location: ../calendar.php");
?>