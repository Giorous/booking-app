<?php

$servername = "";
$username = "";
$password = "";
$dbname = "";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}


	$status = $_POST['status'];
	date_default_timezone_set("Europe/Athens");
	$datecreated = date("Y-m-d H:i:s");
	$roomid = $_POST['roomid'];
	$userid= $_POST['userid'];


	$sql = "
		INSERT INTO favorites (
			status,
			date_created,
			room_id,
			user_id
		) VALUES (
			'$status',
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
