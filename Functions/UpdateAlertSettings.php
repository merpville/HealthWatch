<?php
	include("Session.php");
	$textToggle = $_POST["textToggle"];
	$emailToggle = $_POST["emailToggle"];
	$query = "UPDATE Users SET textalert = '$textToggle', emailalert = '$emailToggle' WHERE username = '$username'";
	$result = $database->query($query);
	echo "
		<script>
			alert('Changes have been saved!');
			window.location.href='../alertSettings.php';
		</script>";
?>