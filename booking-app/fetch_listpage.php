<?php

$servername = "";
$username = "";
$password = "";
$dbname = "";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
			$roomtype=0;

			$sql_bookingdate="SELECT * FROM bookings where check_in_date= '{$_POST['from']}' AND check_out_date='{$_POST['to']}' ";
			$result_bookingdate=mysqli_query($conn,$sql_bookingdate)->fetch_assoc();
				
			if (!empty($_POST['City']) && !empty($_POST['Room_Type'])){
				$sql = "SELECT room_id,name,city,photo,short_description,room_type,count_of_guests,area,price FROM room WHERE city='{$_POST['City']}' AND room_type= '{$_POST['Room_Type']}'";

			}elseif (!empty($_POST['City2']) && !empty($_POST['Room_Type2']) && empty($_POST['amount2']) && empty($_POST['amount3'])){
				$sql = "SELECT room_id,name,city,photo,short_description,room_type,count_of_guests,area,price FROM room WHERE city='{$_POST['City2']}' AND room_type= '{$_POST['Room_Type2']}'";

			}elseif (!empty($_POST['City2']) && !empty($_POST['Room_Type2']) && !empty($_POST['amount'])){
				$test2=$_POST['amount2'];
				$test3=$_POST['amount3'];
				$sql = "SELECT room_id,name,city,photo,short_description,room_type,count_of_guests,area,price FROM room WHERE room_type= '{$_POST['Room_Type2']}' AND city='{$_POST['City2']}' AND price>='$test2' AND price<='$test3'";

			}elseif (!empty($_POST['City2']) && !empty($_POST['Count_of_Guests']) && empty($_POST['amount2']) && empty($_POST['amount3'])){
				$sql = "SELECT room_id,name,city,photo,short_description,room_type,count_of_guests,area,price FROM room WHERE count_of_guests='{$_POST['Count_of_Guests']}' AND city='{$_POST['City2']}'";

			}elseif (!empty($_POST['City2']) && !empty($_POST['Count_of_Guests']) && !empty($_POST['amount'])){
				$test2=$_POST['amount2'];
				$test3=$_POST['amount3'];
				$sql = "SELECT room_id,name,city,photo,short_description,room_type,count_of_guests,area,price FROM room WHERE count_of_guests='{$_POST['Count_of_Guests']}' AND city='{$_POST['City2']}' AND price>='$test2' AND price<='$test3'";

			}elseif (!empty($_POST['Count_of_Guests']) && empty($_POST['amount2']) && empty($_POST['amount3'])){
				$sql = "SELECT room_id,name,city,photo,short_description,room_type,count_of_guests,area,price FROM room WHERE count_of_guests='{$_POST['Count_of_Guests']}'";

			}elseif (!empty($_POST['Count_of_Guests']) && !empty($_POST['amount']) ){
				$test2=$_POST['amount2'];
				$test3=$_POST['amount3'];
				$sql = "SELECT room_id,name,city,photo,short_description,room_type,count_of_guests,area,price FROM room WHERE count_of_guests='{$_POST['Count_of_Guests']}' AND price>='$test2' AND price<='$test3'";


			}elseif (!empty($_POST['Count_of_Guests'])){
				$sql = "SELECT room_id,name,city,photo,short_description,room_type,count_of_guests,area,price FROM room WHERE count_of_guests='{$_POST['Count_of_Guests']}'";

		
			}elseif (!empty($_POST['City2'])  && empty($_POST['amount2']) && empty($_POST['amount3'])){
				$sql = "SELECT room_id,name,city,photo,short_description,room_type,count_of_guests,area,price FROM room WHERE city='{$_POST['City2']}'";


			}elseif (!empty($_POST['Room_Type2']) && empty($_POST['amount2']) && empty($_POST['amount3'])){
				$sql = "SELECT room_id,name,city,photo,short_description,room_type,count_of_guests,area,price FROM room WHERE room_type= '{$_POST['Room_Type2']}'";

			}elseif (!empty($_POST['Room_Type2']) && !empty($_POST['amount'])){
				$test2=$_POST['amount2'];
				$test3=$_POST['amount3'];
				$sql = "SELECT room_id,name,city,photo,short_description,room_type,count_of_guests,area,price FROM room WHERE room_type= '{$_POST['Room_Type2']}' AND price>='$test2' AND price<='$test3'";


			}elseif (!empty($_POST['City2']) && !empty($_POST['amount'])){
				$test2=$_POST['amount2'];
				$test3=$_POST['amount3'];
				$sql = "SELECT room_id,name,city,photo,short_description,room_type,count_of_guests,area,price FROM room WHERE city= '{$_POST['City2']}' AND price>='$test2' AND price<='$test3'";


			}elseif (empty($_POST['City2']) && empty($_POST['Room_Type2']) && !empty($_POST['amount'])){
				$test2=$_POST['amount2'];
				$test3=$_POST['amount3'];
				$sql = "SELECT room_id,name,city,photo,short_description,room_type,count_of_guests,area,price FROM room WHERE price>='$test2' AND price<='$test3'";

			}else{
				echo "Oops";
			}

				$result=mysqli_query($conn,$sql);
				if(mysqli_query($conn,$sql)){
					
				}else{
					echo '<div class="alert alert-success"
						role="alert">Error:'.$sql."<br>".mysqli_error($conn).'</div>';
				}
		?>
					<p>Search Results</p>
						<?php 
							if ($result_bookingdate > 0){
								echo "You have already book for this date";	
							}elseif (mysqli_num_rows($result)==0){
								echo "Oops!!!";
							}elseif (mysqli_num_rows($result) > 0) {
								// output data of each row
								while ($row = mysqli_fetch_assoc($result)) {
							?>
							<article id="describe">
								<img src="<?php echo $row['photo'];?>">
								<h4><?php echo $row['name'];?></h4>
								<h6><?php echo $row['city'];?>, <?php echo $row['area'];?></h6>
								<p><?php echo $row['short_description'];?></p>	
									<form id="form2" method="POST" target="_blank" action="room_page.php" style="float:right">
										<input type="hidden" name="Name" value="<?php echo $row['name'];?>">
										<input type="hidden" name="Room_Id" value="<?php echo $row['room_id'];?>">
										<input type="hidden" name="CheckInDate" value="<?php echo $_POST['from'];?>">
                                        <input type="hidden" name="CheckOutDate" value="<?php echo $_POST['to'];?>">

										<button type="submit" class="btn btn-outline-primary" style="float:right">Go to Room Page</button>
									</form>
								<div class="informations">
									<div id="price">
											<p>Per Night: <?php echo $row['price'];?>&euro;</p>
									</div>
									<div id="services">
										<div id="guests">
											<p>Count of Guests: <?php echo $row['count_of_guests'];?></p>
										</div>
										<div id="vert">
											<p>&vert;</p>
										</div>
										<div id='type_of_room'>
											<?php
												if($row['room_type']==1){
													$roomtype='Single';
												}elseif($row['room_type']==2){
													$roomtype='Double';
												}elseif($row['room_type']==3){
													$roomtype='Triple';
												}else{
													$roomtype='Fourfold';
												}
											?>
											<p>Type of Room: <?php echo $roomtype;?> Room</p>
										</div>
										 
									</div>
								</div>
							</article>
							<?php
								}
							}
							?>	
				<div id="border">
				</div>	
<?php

mysqli_close($conn);

?>