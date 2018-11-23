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
		<?php
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
		<div class="flex-container2">
			<main style="order: 2">
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
			</main>
			<aside style="order: 1">
				<div id="text">	
					<p>FIND THE PERFECT<br>HOTEL</p>
				</div>
				<form id="filterform" autocomplete="off" method="POST">
					<div class="dropdown">
						  <select name="Count_of_Guests" class="selectpicker" id="Count_of_Guests">
						  	<option value="">Count of Guests</option>
							<option value="1">1 Guest</option>
							<option value="2">2 Guests</option>
							<option value="3">3 Guests</option>
							<option value="4">4 Guests</option>
						</select>
					</div>
					<div class="dropdown">
						 <select name="Room_Type2" class="selectpicker" id="Room_Type2">
						 	<option value="">Room_Type</option>
							<option value="1">Single Room</option>
							<option value="2">Double Room</option>
							<option value="3">Triple Room</option>
							<option value="4">Fourfold Room</option>
						</select>
					</div>
					<div class="dropdown">
						<select name="City2" class="selectpicker" id="City2">
							<option value="">City</option>
							<option value="Athens">Athens</option>
							<option value="Thessaloniki">Thessaloniki</option>
							<option value="Santorini">Santorini</option>
							<option value="Kavala">Kavala</option>
						</select>
					</div>
					<div id="prices">
						<p>Min-Max Price: 0&euro; - 500&euro;</p>
						<label for="amount">Price range:</label>
						<input type="text" name="amount" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
						<input type="text" name="amount2" id="amount2" readonly style="border:0; color:#f6931f; font-weight:bold;">
						<input type="text" name="amount3" id="amount3" readonly style="border:0; color:#f6931f; font-weight:bold;">
					</div>
					<div id="slider-range"></div>
					<div id="maxminprice">
						<p>MIN PRICE</p>
						<p>MAX PRICE</p>
					</div>
					<div id="dropdown">
						   <input type="text" id="from" name="from" placeholder="Check-In Date">
					</div>
					<div id="dropdown">
						  <input type="text" id="to" name="to" placeholder="Check-Out Date">	    
					</div>
					<button type="submit" class="btn btn-outline-primary">FIND HOTEL</button>
				</form>
			</aside>
		</div>
		<footer>
			<p>&copy; George Roussos 2018</p>
		</footer>
	</div>
    <script>
		$(document).ready(function () {
			$('#filterform').on('submit', function(event){
				event.preventDefault();
				var form_data = $(this).serialize();
				form_data+='&ajax=1';
                if($('#from').val()=='' || $('#to').val()=='' ){
                    $.alert({
                        title: 'Alert!',
                        content: 'Please choose Check-in and Check-out day!',
                    });
                    return false;
                }
				//console.log(form_data);
				$.ajax({
					url:"fetch_listpage.php",
					method: "POST",
					data: form_data,
					dataType: "html",
					success:function(d)
					{
						$('main').html('<img class="spinner" alt="" src="ajax-loader.gif" width="100" height="100" margin="0" align="center" />');
						setTimeout(function () {
							$('main').html(d);
								}, 2000);
					}
						//console.log(d);
				});
			});
		});
	</script>
	<script>
		$( function() {
			$( "#slider-range" ).slider({
				range: true,
				min: 0,
				max: 500,
				values: [ 0, 500],
				slide: function( event, ui ) {
				$("#amount").val( "\u20ac" + ui.values[ 0 ] + " - \u20ac" + ui.values[ 1 ] );
				$("#amount2").val(ui.values[ 0 ]);
				$("#amount3").val(ui.values[ 1 ]);
				}
			});
			$( "#amount" ).val( "\u20ac" + $( "#slider-range" ).slider( "values", 0 ) +
				" - \u20ac" + $( "#slider-range" ).slider( "values", 1 ) );
		} );
	</script>
	<script>
		$(function() {
			var dates = $("#from, #to").datepicker({
			defaultDate: "+1w",
			minDate: 0,
			changeMonth: true,
			numberOfMonths: 1,
			onSelect: function(dateText, inst) {
				var option = this.id == "from" ? "minDate" : "maxDate",
					actualDate = new Date(dateText);
				var newDate = new Date(actualDate.getFullYear(), actualDate.getMonth(), actualDate.getDate() + 1);
				dates.not(this).datepicker("option", option, newDate);
				}
			});
		});
	</script>
</body>