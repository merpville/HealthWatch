<?php
	include("Functions/Session.php");
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<?php
			$query = "SELECT textalert, emailalert FROM Users WHERE username = '$username'";
			$result = $database->query($query);
			$row = $result->fetch_assoc();
			$emailAlert = $row["emailalert"];
			$textAlert = $row["textalert"];
		?>

		<form method="post" action="Functions/UpdateAlertSettings.php">
			<div id="alertPanel">
				<div class="alertBox">
					<div class="alertName">Text Alerts</div>
					<div class="onoff">
						<input type="radio" id="textToggleOn" name="textToggle" value="1" <?php if($textAlert == 1) {echo "checked";}?>>
						<label for="textToggleOn"> On</label> | <label for="textToggleOff">Off </label>
						<input type="radio" id="textToggleOff" name="textToggle" value="0" <?php if($textAlert == 0) {echo "checked";}?>>
					</div>
				</div>
				<div class="alertBox">
					<div class="alertName">Email Alerts</div>
					<div class="onoff">
						<input type="radio" id="emailToggleOn" name="emailToggle" value="1" <?php if($emailAlert == 1) {echo "checked";}?>>
						<label for="emailToggleOn"> On</label> | <label for="emailToggleOff">Off </label>
						<input type="radio" id="emailToggleOff" name="emailToggle" value="0" <?php if($emailAlert == 0) {echo "checked";}?>>
					</div>
				</div>
				<button type="submit" class="submit">Update</button>
			</div>
		</form>

		<button class="option" onclick="location.href='dashboard.php'">Dashboard</button>
		<button class="option" onclick="location.href='chatroom.php'">Chatroom</button>
		<button class="option" onclick="location.href='calendar.php'">Calendar</button>
		<button class="option" onclick="location.href='Functions/Logout.php'">Log Out</button>
	</body>
</html>