<?php

$servername = "";
$username = "";
$password = "";
$dbname = "";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}


	$rate=$_POST['ratestars'];
	$description=$_POST['description'];
	date_default_timezone_set("Europe/Athens");
	$datecreated = date("Y-m-d H:i:s");
	$roomid = $_POST['roomid'];
	$userid= $_POST['userid'];


	$sql = "
		INSERT INTO reviews (
			rate,
			description,
			date_created,
			room_id,
			user_id
		) VALUES (
			'$rate',
			'$description',
			'$datecreated',
			'$roomid',
			'$userid'
		)";
		


	if (mysqli_query($conn, $sql)) {
	} else {
		echo '<div class="alert alert-success" role="alert">Error: ' . $sql . "<br>" . mysqli_error($conn).'</div>';
	}

?>
<?php

mysqli_close($conn);

?>