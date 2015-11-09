<?php
	include("Functions/Session.php");
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	</head>

	<body>
        <?php
			function draw_calendar($month, $year) {
				$aptsContents = file_get_contents("Logs/Calendar.txt");
				$aptsRows = explode("\n", $aptsContents);
				$calendar = '<table id="calendarTable">';
				$headings = array(
						'Sunday',
						'Monday',
						'Tuesday',
						'Wednesday',
						'Thursday',
						'Friday',
						'Saturday'
				);
				$calendar .= '<tr><td class="calendarDayHead">' . implode('</td><td class="calendarDayHead">', $headings) . '</td></tr>';
				$running_day       = @date('w', mktime(0, 0, 0, $month, 1, $year));
				$days_in_month     = @date('t', mktime(0, 0, 0, $month, 1, $year));
				$days_in_this_week = 1;
				$day_counter       = 0;
				$calendar .= '<tr>';

				for ($x = 0; $x < $running_day; $x++) {
					$calendar .= '<td> </td>';
					$days_in_this_week++;
				}

				for ($list_day = 1; $list_day <= $days_in_month; $list_day ++){
					$print = "";

                    foreach ($aptsRows as $row) {
                        $info = explode("<>", $row);
                        $date = @date(strtotime($info[0]));
                        if (@date('j', $date) == $list_day) {
                            $print .= "<p class='output'><b>" . $info[1] . "</b> <i>" . $info[2] . "</i></p>";
                        }
                    }

						$calendar .= "<td class='dayOnCalendar'> <div class='calendarNumber'>$list_day " . $print . "</div> </td>";

					if ($running_day == 6):
						$calendar .= '</tr>';
						if (($day_counter + 1) != $days_in_month):
							$calendar .= '<tr>';
						endif;
						$running_day       = -1;
						$days_in_this_week = 0;
					endif;
					$days_in_this_week++;
					$running_day++;
					$day_counter++;
				}
				$calendar .= '</tr>';
				$calendar .= '</table>';
				return $calendar;
			}

			$date = @date("F Y");
			$month = @date("n");
			$year = @date("Y");
			echo "<div id='date'>$date</div>";
			echo draw_calendar($month, $year);
		?>
		<form method="post" action="Functions/UpdateCalendar.php">
			<input class="input" placeholder="Enter a date..." name="aptDate" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" required>
			<select class="input" name="aptUser" required>
                <option disabled selected> Select a person...</option>
				<?php
					$query = "SELECT Family_id FROM Users WHERE username = '$username'";
					$result = $database->query($query);
					$row = $result->fetch_assoc();
					$familyId = $row["Family_id"];
					$query = "SELECT username FROM Users WHERE Family_id = $familyId";
					$result = $database->query($query);
					while ($row = $result->fetch_assoc()) {
						$option = $row["username"];
						echo "<option value='$option'>$option</option>";
					}
				?>
			</select>
			<input class="input" type="text" name="aptDesc" placeholder="Description..." required>
			<button class="submit" type="submit" name="button">Update</button>
		</form>
        <?php
            include("Constants/Navigation.php")
        ?>
	</body>
</html>