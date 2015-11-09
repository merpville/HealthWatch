<?php
	session_start();
	require("ConnectToDatabase.php");

	if (isset($_POST['button'])) {
		$error = "";

		if (!isset($_POST["username"]) || !isset($_POST["password"])) {
			$error .= "<div class='error'>Username or password is missing.</div>";
		}
		else {
			define("MAX_STRLEN", 25);
			$username = stripslashes($_POST["username"]);
			$password = stripslashes($_POST["password"]);

			if (strlen($username) > MAX_STRLEN || strlen($password) > MAX_STRLEN) {
				$error .= "<div class='error'>Username or password is longer than " . MAX_STRLEN . ".</div>";
			}
			else {
				$query = "SELECT * FROM Users WHERE username = '$username' AND password='$password'";
				$result = $database->query($query);
				if ($result->num_rows == 1) {
					$row = $result->fetch_assoc();
					$_SESSION["username"] = $row["username"];
					header("Location: ../dashboard.php");
				}
				else {
					$error .= "<div class='error'>Username or password is incorrect.</div>";
				}
			}
		}
	}
?>