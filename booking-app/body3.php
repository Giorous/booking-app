<body>
	<div id="container">
		<header class="flex-container1">
				<div>
					<a id="first-link" href="landing_page.php"> Hotels</a>
				</div>
				<div>
					<i class="fas fa-home"></i>
					<a id="second-link" href="landing_page.php"> Home</a>&nbsp;&nbsp;
					<i class="fas fa-ellipsis-v"></i>&nbsp;&nbsp;
					<i class="fas fa-user"></i>
					<a id="second-link" target="_blank" href="profile_page.php"> Profile</a>
				</div>
		</header>
		<div class="flex-container2">
			<main style="order: 2">
					<p>My Bookings</p>		
						<?php 
							$sql = "SELECT room_id,check_in_date,check_out_date FROM bookings";
							$result=mysqli_query($conn,$sql);
							if(mysqli_query($conn,$sql)){
							}else{
								echo '<div class="alert alert-success"
									role="alert">Error:'.$sql."<br>".mysqli_error($conn).'</div>';
							}
							if (mysqli_num_rows($result)==0){
								echo "There are no bookings yet!!";
							}elseif (mysqli_num_rows($result) > 0){
								while($row = mysqli_fetch_assoc($result)){	
									$sql2 = "SELECT room_id,name,city,area,photo,room_type,count_of_guests,price,short_description FROM room WHERE room_id='{$row['room_id']}'";
							$result2=mysqli_query($conn,$sql2);
							if(mysqli_query($conn,$sql2)){
							}else{
								echo '<div class="alert alert-success"
									role="alert">Error:'.$sql2."<br>".mysqli_error($conn).'</div>';
							}
							if (mysqli_num_rows($result2)==0){
								echo "Oops!!!";
							}elseif (mysqli_num_rows($result2) > 0){
								while($row2 = mysqli_fetch_assoc($result2)){
							?>
							<article id="describe">
								<img src="<?php echo $row2['photo'];?>">
								<h4><?php echo $row2['name'];?></h4>
								<h6><?php echo $row2['city'];?>, <?php echo $row2['area'];?></h6>
								<p><?php echo $row2['short_description'];?></p>	
									<form id="form2" method="POST" target="_blank" action="room_page.php" style="float:right">
										<input type="hidden" name="Name" value="<?php echo $row2['name'];?>">
										<input type="hidden" name="Room_Id" value="<?php echo $row2['room_id'];?>">
										<input type="hidden" name="CheckInDate" value="<?php echo $row['Check-In_date'];?>">
                                        <input type="hidden" name="CheckOutDate" value="<?php echo $row['Check-Out_date'];?>">
										<button type="submit" class="btn btn-outline-primary" style="float:right">Go to Room Page</button>
									</form>
								<div class="informations">
									<div id="price">
											<p>Per Night: <?php echo $row2['price'];?>&euro;</p>
									</div>
									<div id="services_profil_page">
										<div id="checkin">
											<p>Check-In Date: <?php echo $row['check_in_date'];?></p>
										</div>
										<div id="vert_profil_page">
											<p>&vert;</p>
										</div>
										<div id="checkout">
											<p>Check-Out Date: <?php echo $row['check_out_date'];?></p>
										</div>
										<div id="vert_profil_page">
											<p>&vert;</p>
										</div>
										<div id='type_of_room_profil_page'>
											<?php
												if($row2['room_type']==1){
													$roomtype='Single';
												}elseif($row2['room_type']==2){
													$roomtype='Double';
												}elseif($row2['room_type']==3){
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
								}
							}
							?>
				<div id="border">
				</div>	
			</main>
			<aside style="order: 1;margin-right: 70px;width: 306px;">
				<div id="text_profile">	
					<p>FAVORITES</p>
				</div>
				<div id="display_favorites">
					<?php 
						$i=0;
						$sql3="SELECT room_id FROM favorites";
						$result3=mysqli_query($conn,$sql3);
							if(mysqli_query($conn,$sql3)){
							}else{
								echo '<div class="alert alert-success"
									role="alert">Error:'.$sql3."<br>".mysqli_error($conn).'</div>';
							}
							if (mysqli_num_rows($result3)==0){
								echo "There are no favorite hotels yet!!";
							}elseif (mysqli_num_rows($result3) > 0){
								while($row3 = mysqli_fetch_assoc($result3)){
									$sql4 = "SELECT name FROM room WHERE room_id='{$row3['room_id']}'";
							$result4=mysqli_query($conn,$sql4);
							if(mysqli_query($conn,$sql4)){
							}else{
								echo '<div class="alert alert-success"
									role="alert">Error:'.$sql4."<br>".mysqli_error($conn).'</div>';
							}
							if (mysqli_num_rows($result4)==0){
								echo "There are no favorite hotels yet!!";
							}elseif (mysqli_num_rows($result4) > 0){
								while($row4 = mysqli_fetch_assoc($result4)){
									$i++;
					?>
						<p><?php echo $i;?>. <?php echo $row4['name'];?></p>
							<?php
					}
				}
					}
				}
				?>
				</div>
				<div id="text_profile">	
					<p>REVIEWS</p>
				</div>
				<div id="display_reviews">
					<?php 
						$i=0;
						$sql5="SELECT room_id,rate FROM reviews";
						$result5=mysqli_query($conn,$sql5);
							if(mysqli_query($conn,$sql5)){
							}else{
								echo '<div class="alert alert-success"
									role="alert">Error:'.$sql5."<br>".mysqli_error($conn).'</div>';
							}
							if (mysqli_num_rows($result5)==0){
								echo "There are no reviews yet!!";
							}elseif (mysqli_num_rows($result5) > 0){
								while($row5 = mysqli_fetch_assoc($result5)){
									$sql6 = "SELECT name FROM room WHERE room_id='{$row5['room_id']}'";
							$result6=mysqli_query($conn,$sql6);
							if(mysqli_query($conn,$sql6)){
							}else{
								echo '<div class="alert alert-success"
									role="alert">Error:'.$sql6."<br>".mysqli_error($conn).'</div>';
							}
							if (mysqli_num_rows($result6)==0){
								echo "There are no reviews yet!!";
							}elseif (mysqli_num_rows($result6) > 0){
								while($row6 = mysqli_fetch_assoc($result6)){
									$i++;
					?>
						<p><?php echo $i;?>. <?php echo $row6['name'];?></p>
						<?php
							if ($row5['rate']==0){?>
							<div id="reviews">
								<span class="fa fa-star unchecked"></span>
								<span class="fa fa-star unchecked"></span>
								<span class="fa fa-star unchecked"></span>
								<span class="fa fa-star unchecked"></span>
								<span class="fa fa-star unchecked"></span>
							</div>
						<?php
							}elseif ($row5['rate']==1) {?>
							<div id="reviews">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star unchecked"></span>
								<span class="fa fa-star unchecked"></span>
								<span class="fa fa-star unchecked"></span>
								<span class="fa fa-star unchecked"></span>
							</div>
							<?php	
							}elseif ($row5['rate']==2) {?>
							<div id="reviews">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star unchecked"></span>
								<span class="fa fa-star unchecked"></span>
								<span class="fa fa-star unchecked"></span>
							</div>
							<?php
						}elseif ($row5['rate']==3) {?>
							<div id="reviews">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star unchecked"></span>
								<span class="fa fa-star unchecked"></span>
							</div>
							<?php	
						}elseif ($row5['rate']==4) {?>
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
							<?php
					}
				}
					}
				}
				?>
				</div>
			</aside>
		</div>
			<footer id="profile_page_footer">
				<p>&copy; George Roussos 2018</p>
			</footer>
	</div>
</body>