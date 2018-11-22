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
	<?php include 'head3.php'; ?>
	<?php include 'body3.php'; ?>
</html>
<?php

mysqli_close($conn);

?>