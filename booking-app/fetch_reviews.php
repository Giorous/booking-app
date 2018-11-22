<?php

$servername = "";
$username = "";
$password = "";
$dbname = "";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$Room_Id= $_POST['Room_Id'];
$i=0;

						$sql4="SELECT  review_id,user_id,rate,description,date_created FROM reviews WHERE room_id='{$_POST['Room_Id']}'";
						$result4=mysqli_query($conn,$sql4);
						if(mysqli_query($conn,$sql4)){
							
						}else{
							echo '<div class="alert alert-success"
								role="alert">Error:'.$sql4."<br>".mysqli_error($conn).'</div>';
						}

						if (mysqli_num_rows($result4)==0){?>
							<div id="noreviews"><p><?php echo "There are no reviews yet!!!";?></p></div>
						<?php
						}elseif (mysqli_num_rows($result4) > 0){
							// output data of each row
							while ($row4 = mysqli_fetch_assoc($result4)) {	
									$i++;
						?>
					<div id="user_and_rate">
						<div id="user_and_rate">
							<p><?php echo $i;?>.<?php echo $_POST['username'];?></p>
						</div>
						<?php
							if ($row4['rate']==0){?>
							<div id="reviews">
								<span class="fa fa-star unchecked"></span>
								<span class="fa fa-star unchecked"></span>
								<span class="fa fa-star unchecked"></span>
								<span class="fa fa-star unchecked"></span>
								<span class="fa fa-star unchecked"></span>
							</div>
						<?php
							}elseif ($row4['rate']==1) {?>
							<div id="reviews">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star unchecked"></span>
								<span class="fa fa-star unchecked"></span>
								<span class="fa fa-star unchecked"></span>
								<span class="fa fa-star unchecked"></span>
							</div>
							<?php	
							}elseif ($row4['rate']==2) {?>
							<div id="reviews">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star unchecked"></span>
								<span class="fa fa-star unchecked"></span>
								<span class="fa fa-star unchecked"></span>
							</div>
							<?php
						}elseif ($row4['rate']==3) {?>
							<div id="reviews">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star unchecked"></span>
								<span class="fa fa-star unchecked"></span>
							</div>
							<?php	
						}elseif ($row4['rate']==4) {?>
							<div id="reviews">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star unchecked"></span>
							</div>
							<?php	
						}else{?>
							<div id="reviews">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
							</div>
							<?php	
							}?>
					</div>
					<div id="date_time">
						<p> Add time: <?php echo $row4['date_created'];?></p>
					</div>
					<div id="text">
						<p><?php echo $row4['description'];?></p>
					</div>
					<?php	
					}
					
					}
					?>



<?php

mysqli_close($conn);

?>