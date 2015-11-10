<?php
	include("Functions/Session.php");
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<div id="dashboardContainer">
			<div id="dashboard">
				<?php
					$query = "SELECT Family_Id FROM Users WHERE username='$username'";
					$result = $database->query($query);
					$row = $result->fetch_assoc();
					$family_id = $row["Family_Id"];
					$query = "SELECT status, Users_elder, timestamp FROM Family WHERE id = $family_id";
					$result = $database->query($query);
					$row = $result->fetch_assoc();
					$status = $row["status"];
					$elderId = $row["Users_elder"];
					$timestamp = $row["timestamp"];
					$query = "SELECT username FROM Users WHERE id = $elderId";
					$result = $database->query($query);
					$row = $result->fetch_assoc();
					$elderName = $row["username"];
					switch ($status) {
						case 1:
							$statusToString = "Doing well!";
							break;
						case 2:
							$statusToString = "requesting a phone call!";
							break;
						case 3:
							$statusToString = "In need of urgent attention!";
							break;
					}

					$formattedTimestamp = @date("M d, h:i:s a", @strtotime($timestamp));

					echo "<div id='elderName'>$elderName is...</div>";
					echo "<div id='status$status'>$statusToString</div>";
					echo "<div id='timestamp'>as of $formattedTimestamp</div>";
				?>
			</div>

			<button class="option" onclick="location.href='chatroom.php'">Chatroom</button>
			<button class="option" onclick="location.href='calendar.php'">Calendar</button>
			<button class="option" onclick="location.href='alertSettings.php'">Alert Settings</button>
			<button class="option" onclick="location.href='Functions/Logout.php'">Log Out</button>
		</div>
	</body>
</html>