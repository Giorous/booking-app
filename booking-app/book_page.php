<?php

$servername = "";
$username = "";
$password = "";
$dbname = "";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

	$checkin_date = $_POST['checkin_date'];
	$checkout_date = $_POST['checkout_date'];
	date_default_timezone_set("Europe/Athens");
	$datecreated = date("Y-m-d H:i:s");
	$roomid = $_POST['roomid'];
	$userid= $_POST['userid'];


	$sql = "
		INSERT INTO bookings (
			check_in_date,
			check_out_date,
			date_created,
			room_id,
			user_id
		) VALUES (
			'$checkin_date',
			'$checkout_date',
			'$datecreated',
			'$roomid',
			'$userid'
		)";
		
	if (mysqli_query($conn, $sql)) {
		echo '<div class="alert alert-success" role="alert">New record created successfully</div>';
	} else {
		echo '<div class="alert alert-success" role="alert">Error: ' . $sql . "<br>" . mysqli_error($conn).'</div>';
	}
?>
<?php

mysqli_close($conn);

?>