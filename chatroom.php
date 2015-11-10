<?php
	include("Functions/Session.php");
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<div id="chatbox">
			<?php
				$handle = fopen("Logs/Chatroom.txt", "r");
				$contents = fread($handle, filesize("Logs/Chatroom.txt"));
				fclose($handle);
				echo $contents;
			?>
		</div>

		<form name="message" action="" autocomplete="off">
			<input class="input" name="usermsg" type="text" id="usermsg" placeholder="Say something...">
			<button class="submit" name="submitmsg" type="submit"  id="submitmsg" value="Send">Send</button>
		</form>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#submitmsg").click(function(){
					var clientmsg = $("#usermsg").val();
					$.post("Functions/UpdateChat.php", {text: clientmsg});
					$("#usermsg").attr("value", "");
					return false;
				});

				function loadLog(){
					var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
					$.ajax({
						url: "Logs/Chatroom.txt",
						cache: false,
						success: function(html){
							$("#chatbox").html(html); //Insert chat log into the #chatbox div
							var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
							if(newscrollHeight > oldscrollHeight){
								$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
							}
						},
					});
				}
				setInterval (loadLog, 1000);
			});
		</script>

		<button class="option" onclick="location.href='dashboard.php'">Dashboard</button>
		<button class="option" onclick="location.href='calendar.php'">Calendar</button>
		<button class="option" onclick="location.href='alertSettings.php'">Alert Settings</button>
		<button class="option" onclick="location.href='Functions/Logout.php'">Log Out</button>
	</body>
</html>