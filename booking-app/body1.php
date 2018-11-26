<body>
	<div id="container">
		<header class="flex-container1_1">
				<div>
					<a id="first-link" href="landing_page.php"> Hotels</a>
				</div>
				<div>
					<i class="fas fa-home"></i>
					<a id="second-link" href="landing_page.php"> Home</a>
				</div>	
		</header>
		<img src="image.jpg" alt="background image" class="bgnone">		
		<img src="image2.jpg" alt="background image" class="bg">
		<div class="flex-container">	
			<form id="form1" autocomplete="off" method="POST" target="_blank" action="list_page.php" onsubmit="return validate_form();">
				<div class="form-flex-container">
					<div id="dropdowns">
						<div id="firstdropdown">
							 <div class="dropdown">
								<select name="City" id="soflow-color">
								  <option value="" disabled selected>City</option>
								  <option value="Athens">Athens</option>
								  <option value="Thessaloniki">Thessaloniki</option>
								  <option value="Santorini">Santorini</option>
								  <option value="Kavala">Kavala</option>
								</select>
							</div>
							<div class="dropdown">
									<input class="form-control" id="from" name="from" placeholder="Check-In Date" type="text"/>
							</div>
						</div>
						<div id="second_dropdown">
							<div class="dropdown">
								<select name="Room_Type" id="soflow-color1">
								<option value="" disabled selected>Room Type</option>
								  <option value="1">Single Room</option>
								  <option value="2">Double Room</option>
								  <option value="3">Triple Room</option>
								  <option value="4">Fourfold Room</option>
								</select>
							</div>
							<div class="dropdown">
									<input class="form-control" id="to" name="to" placeholder="Check-Out Date" type="text"/>
							</div>
						</div>
					</div>
					<div id="button">
						<button type="submit" class="btn btn-outline-primary">Search</button>
					</div>
				</div>
			</form>
		</div>
		<footer id="landscape_footer">
			<p>&copy; George Roussos 2018</p>
		</footer>
	</div>
		<script>
				$(function() {
		    var dates = $("#from, #to").datepicker({
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
        <script>
            function validate_form(){
				var result=true;
				var city= document.getElementById("soflow-color").value;
				var room= document.getElementById("soflow-color1").value;
				var checkin= document.getElementById("from").value;
				var checkout= document.getElementById("to").value;
				if (city=="" || room=="" || checkin=="" || checkout==""){
					result=false;
					$.alert({
                        title: 'Alert!',
                        content: 'Please fill in all the fields!',
                    });
				}
				return result;
            }
        </script>
</body>