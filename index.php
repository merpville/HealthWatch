<?php
	include('Functions/Login.php');
	if (isset($_SESSION['username'])) {
		header("Location: dashboard.php");
	}
?>

<html>

	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<form method="post" action="" autocomplete="off">
			<input class="input" type="text" name="username" required>
			<input class="input" type="password" name="password" required>
			<button class="submit" name="button" value="homePageLogin">Login</button>
		</form>
		<?php
			if (isset($error)) {
				echo "<div id='error'>$error</div>";
			}
		?>
	</body>

</html>