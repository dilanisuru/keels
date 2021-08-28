<?php
		require_once "../php/database.php";
	?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./css/style.css">

    <title>KeelsSuper</title>
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
	
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	
	
  </head>
  <body>	
	<div class="bg-primary" >
        <div class="container p-2" >
			<div class="row">
				<div class="col">
					<a href="" class=" "><i class="fa fa-phone text-white ">&nbsp&nbsp 0112303500</i></a>
					<a href="" class="mx-5"><i class="	fa fa-envelope-o text-white">&nbsp&nbsp keelonline@gmail.com</i></a>
				</div>
				<div class="col nav justify-content-end">
					<div class="login" onclick="login()" style="cursor : pointer"> <i class="fa fa-user text-white ">&nbsp&nbsp Sign in</i></div>
				</div>
			</div>
        </div>	
	</div>
	<div class="bg-light" >
        <div class="container p-2" >
			<div class="row">
				<div class="col">
					<h5 class="text-dark my-2">KeelsOnline</h5>
				</div>
				<div class="col nav justify-content-end">
					<p class="my-2 mx-4" style="color : gray ;cursor : pointer" onclick = "hm()">Home</p>
					<p class="my-2 mx-4" style="color : gray ; cursor : pointer" onclick = "na()">Newly Added</p>
					<p class="my-2" style="color : black ; cursor : pointer" >Graph</p>
				</div>
			</div>
        </div>
    </div>
	<div class="row mx-2 my-4">
		  <div class="col-sm-6">
			<div class="">
			  <div class="card-body">
				<div id="percentagechart" class=" text-center">
					<div class="" style="margin-top : 5%;">
						<h6 class="text-center">Harvests</h6>
						<table class="table table-bordered">
						  <thead>
							<tr>
							  <th scope="col">Item</th>
							  <th scope="col">Percentage</th>
							</tr>
						  </thead>
						  <tbody>
							<?php
								$con = getConnection();
								$sql = "SELECT * from harvests";
								$result = $con->query($sql);
								$Fruit = 0;
								$Vegitable = 0;
								if($result->num_rows > 0){
									while($row = $result->fetch_assoc())
									{
										if($row["Type"] == "Fruit") {
											$Fruit = $Fruit + 1 ;
										}
										else {
											$Vegitable = $Vegitable + 1 ;
										}
									}
									$Fruit = ($Fruit / ($Fruit + $Vegitable) ) * 100;
									$Vegitable =  ( $Vegitable / ($Fruit + $Vegitable) ) * 100; 
									echo '	<tr>
											  <td> Fruit </td>
											  <td>' ; echo $Fruit;  echo '%</td>
											</tr>';
									echo '	<tr>
											  <td> Vegitable </td>
											  <td>' ; echo $Vegitable;  echo '%</td>
											</tr>';											
								}
							
							
							?>
							
						  </tbody>
						</table>
					</div>
				</div>
				
				<div class=""  style="margin-top : 15%;">
					<h6 class="text-center">Succesfull transactions</h6>
					<table class="table table-bordered ">
					  <thead>
						<tr>
						  <th scope="col">Item Name</th>
						  <th scope="col">Quantity</th>
						</tr>
					  </thead>
					  <tbody>
						<?php
							$con = getConnection();
							$sql = "SELECT * from buy";
							$result = $con->query($sql);
							
							if($result->num_rows > 0){
								while($row = $result->fetch_assoc())
								{
										echo '	<tr>
											  <td> ' ; echo $row["ItemName"]; echo '</td>
											  <td>' ; echo $row["Quantity"] ; echo 'Kg</td>
											</tr>';	
										
								}
							}
							
						
						?>
					
						
					  </tbody>
					</table>
				</div>
				
				<div class="" style="margin-top : 15%;">
					<h6 class="text-center">Wasted Harvests</h6>
					<table class="table table-bordered">
					  <thead>
						<tr>
						  <th scope="col">District</th>
						  <th scope="col">No of Harvests</th>
						</tr>
					  </thead>
					  <tbody>
						<?php
							$con = getConnection();
							$sql = "SELECT * from wasted";
							$result = $con->query($sql);
							
							if($result->num_rows > 0){
								while($row = $result->fetch_assoc())
								{
									echo '	<tr>
										  <td> ' ; echo $row["ItemName"]; echo ' </td>
										  <td>' ; echo $row["Quantity"] ;  echo 'Kg</td>
										</tr>';	
									
								}
							}
						
						
						?>
						
					  </tbody>
					</table>
				</div>
			  </div>
			</div>
		  </div>
		  <div class="col-sm-6">
			<div class="">
			  <div class="card-body">
				<table class="table table-bordered">
				  <thead>
					<tr>
					  <th scope="col">District</th>
					  <th scope="col">No of Harvests</th>
					</tr>
				  </thead>
				  <tbody>
					<?php
						$Anuradhapura = 0;
						$Ampara = 0;
						$Badulla = 0;
						$Batticaloa = 0;
						$Colombo = 0;
						$Galle = 0;
						$Gampaha = 0;
						$Hambantota = 0;
						$Jaffna = 0;
						$Kalutara = 0;
						$Kandy = 0;
						$Kegalle = 0;
						$Kilinochchi = 0;
						$Mannar = 0;
						$Matale = 0;
						$Matara = 0;
						$Monaragala = 0;
						$NuwaraEliya = 0;
						$Polonnaruwa = 0;
						$Puttalam = 0;
						$Ratnapura = 0;
						$Trincomalee = 0;
						$Vavuniya = 0;
						
						$con = getConnection();
						$sql = "SELECT * from harvests";
						$result = $con->query($sql) ;
						if($result->num_rows > 0){
							while($row = $result->fetch_assoc())
							{
								if($row["City"] == "Anuradhapura") {
									$Anuradhapura = $Anuradhapura + 1;
								}
								if($row["City"] == "Ampara") {
									$Ampara = $Ampara + 1;
								}
								if($row["City"] == "Badulla") {
									$Badulla = $Badulla + 1;
								}
								if($row["City"] == "Batticaloa") {
									$Batticaloa = $Batticaloa + 1;
								}
								if($row["City"] == "Colombo") {
									$Colombo = $Colombo + 1;
								}
								if($row["City"] == "Galle") {
									$Galle = $Galle + 1;
								}
								if($row["City"] == "Gampaha") {
									$Gampaha = $Gampaha + 1;
								}
								if($row["City"] == "Hambantota") {
									$Hambantota = $Hambantota + 1;
								}
								if($row["City"] == "Jaffna") {
									$Jaffna = $Jaffna + 1;
								}
								if($row["City"] == "Kalutara") {
									$Kalutara = $Kalutara + 1;
								}
								if($row["City"] == "Kandy") {
									$Kandy = $Kandy + 1;
								}
								if($row["City"] == "Kegalle") {
									$Kegalle = $Kegalle + 1;
								}
								if($row["City"] == "Kilinochchi") {
									$Kilinochchi = $Kilinochchi + 1;
								}
								if($row["City"] == "Mannar") {
									$Mannar = $Mannar + 1;
								}
								if($row["City"] == "Matale") {
									$Matale = $Matale + 1;
								}
								if($row["City"] == "Matara") {
									$Matara = $Matara + 1;
								}
								if($row["City"] == "Monaragala") {
									$Monaragala = $Monaragala + 1;
								}
								if($row["City"] == "NuwaraEliya") {
									$NuwaraEliya = $NuwaraEliya + 1;
								}
								if($row["City"] == "Polonnaruwa") {
									$Polonnaruwa = $Polonnaruwa + 1;
								}
								if($row["City"] == "Puttalam") {
									$Puttalam = $Puttalam + 1;
								}
								if($row["City"] == "Ratnapura") {
									$Ratnapura = $Ratnapura + 1;
								}
								if($row["City"] == "Trincomalee") {
									$Trincomalee = $Trincomalee + 1;
								}
								if($row["City"] == "Vavuniya") {
									$Vavuniya = $Vavuniya + 1;
								}
								
							}
							echo '<tr>
									  <td>Anuradhapura</td>
									  <td>'; echo $Anuradhapura ; echo'</td>
									</tr>';
							echo '<tr>
									  <td>Ampara</td>
									  <td>'; echo $Ampara  ; echo'</td>
									</tr>';
							echo '<tr>
									  <td>Badulla </td>
									  <td>'; echo $Badulla  ; echo'</td>
									</tr>';
							echo '<tr>
									  <td>Batticaloa </td>
									  <td>'; echo $Batticaloa  ; echo'</td>
									</tr>';
							echo '<tr>
									  <td>Colombo </td>
									  <td>'; echo $Colombo  ; echo'</td>
									</tr>';
							echo '<tr>
									  <td>Galle </td>
									  <td>'; echo $Galle  ; echo'</td>
									</tr>';
							echo '<tr>
									  <td>Gampaha </td>
									  <td>'; echo $Gampaha  ; echo'</td>
									</tr>';
							echo '<tr>
									  <td>Hambantota </td>
									  <td>'; echo $Hambantota  ; echo'</td>
									</tr>';
							echo '<tr>
									  <td>Jaffna </td>
									  <td>'; echo $Jaffna  ; echo'</td>
									</tr>';
							echo '<tr>
									  <td>Kalutara </td>
									  <td>'; echo $Kalutara  ; echo'</td>
									</tr>';
							echo '<tr>
									  <td>Kandy </td>
									  <td>'; echo $Kandy  ; echo'</td>
									</tr>';
							echo '<tr>
									  <td>Kegalle </td>
									  <td>'; echo $Kegalle  ; echo'</td>
									</tr>';
							echo '<tr>
									  <td>Kilinochchi </td>
									  <td>'; echo $Kilinochchi  ; echo'</td>
									</tr>';
							echo '<tr>
									  <td>Mannar </td>
									  <td>'; echo $Mannar  ; echo'</td>
									</tr>';
							echo '<tr>
									  <td>Matale </td>
									  <td>'; echo $Matale  ; echo'</td>
									</tr>';
							echo '<tr>
									  <td>Matara </td>
									  <td>'; echo $Matara  ; echo'</td>
									</tr>';
							echo '<tr>
									  <td>Monaragala</td>
									  <td>'; echo $Monaragala ; echo'</td>
									</tr>';
							echo '<tr>
									  <td>NuwaraEliya </td>
									  <td>'; echo $NuwaraEliya  ; echo'</td>
									</tr>';
							echo '<tr>
									  <td>Polonnaruwa </td>
									  <td>'; echo $Polonnaruwa  ; echo'</td>
									</tr>';
							echo '<tr>
									  <td>Puttalam </td>
									  <td>'; echo $Puttalam  ; echo'</td>
									</tr>';
							echo '<tr>
									  <td>Ratnapura </td>
									  <td>'; echo $Ratnapura  ; echo'</td>
									</tr>';
							echo '<tr>
									  <td>Trincomalee </td>
									  <td>'; echo $Trincomalee  ; echo'</td>
									</tr>';
							echo '<tr>
									  <td>Vavuniya </td>
									  <td>'; echo $Vavuniya ; echo'</td>
									</tr>';
						}
					?>
					
					
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>
		</div>
	
		<script>
			function hm() {
				location.href = "./DoA.php";
			}
			
			function na() {
				location.href = "./newlyAdded.php";
			}
			
		</script>
  </body>
</html>