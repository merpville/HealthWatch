<?
	session_start();
	if(isset($_SESSION['username'])){
		$time = date_create(null,new DateTimeZone("PST"));
		$timeStamp = date_format($time, "(g:i a)");

		$text = $_POST['text'];
		$fp = fopen("../Logs/Chatroom.txt", 'a');
		echo  $time->format("H:i:s");
		fwrite($fp, "<div class='msgln'> <b>" . $_SESSION['username'] . "</b> " . $timeStamp . ": " .stripslashes(htmlspecialchars($text))."<br></div>\n");
		fclose($fp);
	}
?>