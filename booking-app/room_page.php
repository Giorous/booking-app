<?php

$servername = "";
$username = "";
$password = "";
$dbname = "";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

?>
<!DOCTYPE html>
<html>
	<?php include 'head4.php'; ?>
	<?php include 'body4.php'; ?>
</html>
<?php

mysqli_close($conn);

?>