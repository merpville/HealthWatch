<?php
	/**
	 * Created by PhpStorm.
	 * User: richard
	 * Date: 11/7/15
	 * Time: 1:50 PM
	 */
	define("databaseHost", "127.0.0.1");
	define("databaseName", "csuci");
	define("databaseUser", "red100");
	define("databasePassword", "red100");

	$database = new mysqli(databaseHost, databaseUser, databasePassword, databaseName);
	if ($database->connect_error) {
		$error .= "<div class='error'>Connection failed: $connection->connect_error</div>";
	}
?>