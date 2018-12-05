<body>
	<div id="container">
		<header class="flex-container1">
				<div>
					<a id="first-link" href="landing_page.php"> Hotels</a>
				</div>
				<div>
					<i class="fas fa-home"></i>
					<a id="second-link"  href="landing_page.php"> Home</a>&nbsp;&nbsp;
					<i class="fas fa-ellipsis-v"></i>&nbsp;&nbsp;
					<i class="fas fa-user"></i>
					<a id="second-link" href="profile_page.php" target="_blank"> Profile</a>
				</div>
		</header>
		<?php 
			$Name=$_POST['Name'];
			$Room_Id= $_POST['Room_Id'];				
			$CheckInDate= $_POST['CheckInDate'];
			$CheckOutDate= $_POST['CheckOutDate'];
			$sql = "SELECT room_id,name,city,photo,short_description,room_type,count_of_guests,area,price,parking,wifi,pet_friendly,long_description,lat_location,lng_location FROM room WHERE name='$Name'";
			$sql2="SELECT user_id,username FROM user";
				$result=mysqli_query($conn,$sql);
				$result_script=mysqli_query($conn,$sql)->fetch_assoc();
				if(mysqli_query($conn,$sql)){

				}else{
					echo '<div class="alert alert-success"
						role="alert">Error:'.$sql."<br>".mysqli_error($conn).'</div>';
				}
				$result2=mysqli_query($conn,$sql2);
				if(mysqli_query($conn,$sql2)){
					
				}else{
					echo '<div class="alert alert-success"
						role="alert">Error:'.$sql2."<br>".mysqli_error($conn).'</div>';
				}
				if (mysqli_num_rows($result2)==0){
					echo "Oops!!!";
				}elseif (mysqli_num_rows($result2) > 0){
					$row2 = mysqli_fetch_assoc($result2)
					?>	
				<?php
				}
				?>
		<div class="flex-container2">
			<main id="roompage">
				<?php 
					if (mysqli_num_rows($result)==0)
						echo "Oops!!!";
					elseif (mysqli_num_rows($result) > 0) {
						// output data of each row
						while ($row = mysqli_fetch_assoc($result)) {		
				?>
				<div id="name-review-favorite-price">
					<div id="name">
						<p><?php echo $row['name'];?> - <?php echo $row['city'];?>, <?php echo $row['area'];?></p>
					</div>
					<div id="vert2">
						<p>&vert;</p>
					</div>
					<div id="reviews_stars" style="flex-grow: 36">	
						<span>Reviews:</span>
						<?php
							$sql3 = "SELECT AVG(rate) FROM reviews WHERE room_id='{$_POST['Room_Id']}'";
							$result3=mysqli_query($conn,$sql3);
							if(mysqli_query($conn,$sql3)){
								
							}else{
								echo '<div class="alert alert-success"
									role="alert">Error:'.$sql3."<br>".mysqli_error($conn).'</div>';
							}	

							if (mysqli_num_rows($result3)==0){
									echo "Oops!!!";
							}elseif (mysqli_num_rows($result3) > 0){
								$row3 = mysqli_fetch_assoc($result3)
							?>
							<?php	
							}
							?>
						<span class="stars-outer"><span class="stars-inner"></span></span>
						<span>&nbsp;&vert;&nbsp;</span>
						<iframe name="frame" style="display:none;"></iframe>
						<?php 
							$sql_favorite="SELECT * FROM favorites where user_id= ".$row2["user_id"]." AND room_id=".$Room_Id." ";
							$result_favorite=mysqli_query($conn,$sql_favorite)->fetch_assoc();
							
							if ($result_favorite > 0){ ?>
								<span id="favorite" title="heart"><i class="fa fa-heart"></i></span>			
								<?php }else{
						?>
						<form id="form5" method="POST" action="favorite_page.php" target="frame">
                        	<input type="hidden" name="roomid" value="<?php echo $Room_Id;?>">
                        	<input type="hidden" name="userid" value="<?php echo $row2["user_id"];?>">
                        	<input type="hidden" name="status" value="1">
							<button type="submit" id="favorite_button" class="button_favorite"><i class="far fa-heart"></i></button>
						</form>
						<?php } ?>
					</div>
					<div id="roompage_price" style="float:right">
						<p>Per Night: <?php echo $row['price'];?>&euro;</p>
					</div>
				</div>
				<div id="image">
					<img src="rooms/<?php echo $row['photo'];?>" alt="<?php echo $row['name'];?>">
				</div>
				<div id="hotel-amenities">
					<div id="count_of_guests">
						<i class="fas fa-user"> <?php echo $row['count_of_guests'];?></i>
						<p>COUNT OF GUESTS</p>
					</div>
					<div id="borderlines"></div>
					<div id="type_of_room_2">
						<i class="fas fa-bed"> <?php echo $row['room_type'];?></i>
						<p>TYPE OF ROOM</p>
					</div>
					<div id="borderlines"></div>
					<div id="parking">
						<i class="fas fa-car"></i>
						<?php if($row['parking']==0){?>
						<p> NO PARKING</p>
						<?php }else{?>
							<p>PARKING</p>
						<?php
						}?>
					</div>
					<div id="borderlines"></div>
					<div id="wifi">
						<i class="fas fa-wifi"></i>
						<?php if($row['wifi']==0){?>
						<p> NO WIFI</p>
						<?php }else{?>
							<p>WIFI</p>
						<?php
						}?>
					</div>
					<div id="borderlines"></div>
					<div id="pet">
						<i class="fas fa-paw"></i>
						<?php if($row['pet_friendly']==0){?>
						<p> NO PET FRIENDLY</p>
						<?php }else{?>
							<p>PET FRIENDLY</p>
						<?php
						}?>
					</div>
				</div>
				<div id="room-description">
						<h5>Room Description</h5>
						<p><?php echo $row['long_description'];?></p>
				</div>
				<div id="book_now">
					<iframe name="votar" style="display:none;"></iframe>
					<?php 
						$sql_booking="SELECT * FROM bookings where user_id= ".$row2["user_id"]." AND room_id=".$Room_Id." ";
						$result_booking=mysqli_query($conn,$sql_booking)->fetch_assoc();
						
						if ($result_booking > 0){ ?>
							<span id="booked">Already booked</span>			
							<?php }else{
					?>
					<form id="form3" method="POST" action="book_page.php" target="votar">
						<input type="hidden" name="checkin_date" value="<?php echo $CheckInDate;?>">
						<input type="hidden" name="checkout_date" value="<?php echo $CheckOutDate;?>">
                        <input type="hidden" name="roomid" value="<?php echo $Room_Id;?>">
                        <input type="hidden" name="userid" value="<?php echo $row2["user_id"];?>">
						<button type="submit" id="button" class="btn btn-outline-primary" style="float:right;background-color: red;">Book Now</button>
					</form>
				<?php } ?>
					<!-- The Modal -->
					<div id="myModal" class="modal">

					  <!-- Modal content -->
					  <div class="modal-content">
					    <div class="modal-header">
					      <span class="close">&times;</span>
					    </div>
					    <div class="modal-body">
					    	<img src="tick.png" class="center">
					    	<p>Your booking at <?php echo $row['name'];?> in <br><?php echo $row['city'];?>-<?php echo $row['area'];?> is confirmed</p>
					    	<a href="profile_page.php" target="_blank"><button class="button" style="vertical-align:middle"><span>My bookings </span></button></a>
					    </div>
					  </div>
					</div>
				</div>
				<div id="map"></div>
				<div id="border"></div>
				<div id="reviewslist">
					<h3>Reviews</h3>
					<?php
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
							<p><?php echo $i;?>.<?php echo $row2['username'];?></p>
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

				</div>
				<div id="ratings-review">
					<h3>Add a Review</h3>
				    <div id="response"></div>
					<form method="POST" id="form4">
						<select id="ratestars" name="ratestars">
							<option value=""></option>
						  <option value="1">1</option>
						  <option value="2">2</option>
						  <option value="3">3</option>
						  <option value="4">4</option>
						  <option value="5">5</option>
						</select>
						<input type="hidden" id="roomid" name="roomid" value="<?php echo $Room_Id;?>">
						<input type="hidden" id="userid" name="userid" value="<?php echo $row2["user_id"];?>">
						<input type="hidden" id="username" name="username" value="<?php echo $row2["username"];?>">
		                <textarea rows="3" id="description" name="description" class="input-block-level" placeholder="Review"></textarea>
		                <button type="submit" id="submitbutton" class="btn btn-warning pull-right">Submit</button>
			        </form>
				</div>
			</main>
		</div>
		<?php
								}
							}
							?>
		<footer>
			<p>&copy; George Roussos 2018</p>
		</footer>
	</div>


	<script>
		$(document).ready(function () {
			$('#form4').on('submit', function(event){
				event.preventDefault();
				var form_data = $(this).serialize();
				form_data+='&ajax=1';
                if($('#description').val()==''){
                    $.alert({
                        title: 'Alert!',
                        content: 'Please write a comment or make a review!',
                    });
                    return false;
                }
				console.log(form_data);
				$.ajax({
					url:"reviews_page.php",
					method: "POST",
					data: form_data,
					dataType: "html",
					success:function(d)
					{
						//console.log(d);
						$('#response').html(d);
					}
				});
				$.ajax({
				   url:"fetch_reviews.php",
				   method:"POST",
				   data: form_data + '&Room_Id='+ $('#roomid').val() + '&row2["username"]=' + $('#username').val(),
				   success:function(data)
				   {
				    	$('#reviewslist').html(data);
				    	$('#description').val(' ');
				    	$('#mystar').val(' ');
				   }
			  	});
			});
		});
	</script>

	<script>
		$("button").click(function(){
    		$(this).find("i").removeClass("far fa-heart").addClass("fa fa-heart");
		});
	</script>
	<script>
		  var rate="<?php echo $row3['AVG(rate)']; ?>";
		  var starTotal = 5;
		  var starPercentage = (rate / starTotal) * 100;
		  var starPercentageRounded = `${(Math.round(starPercentage / 10) * 10)}%`;
		  document.querySelector(".stars-inner").style.width = starPercentageRounded;
	</script>
	 <script>
      function initMap() {
        var lat = parseFloat("<?php echo $result_script['lat_location']; ?>");
        var lng = parseFloat("<?php echo $result_script['lng_location']; ?>");
        var uluru = {lat, lng};
        console.log(uluru);
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 17,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFMfKc-C-tj_yyn8gHKRuCYShjZhvRx-w&callback=initMap">
    </script>
	<script src="jquery.barrating.min.js"></script>
	<script type="text/javascript">
	   $(function() {
	      $('#ratestars').barrating({
	        theme: 'fontawesome-stars'
	      });
	   });
	</script>
    
	<script>
	// Get the modal
	var modal = document.getElementById('myModal');

	// Get the button that opens the modal
	var btn = document.getElementById("button");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks the button, open the modal
	if (btn){
		btn.onclick = function() {
		    modal.style.display = "block";
		}
	} 
	

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	    modal.style.display = "none";
	    window.location.reload();
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	    if (event.target == modal) {
	        modal.style.display = "none";
	        window.location.reload();
	    }
	}
	</script>
</body>