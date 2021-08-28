<?php
		require_once "./php/database.php";
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
	
	
  </head>
  <body>	
	<div class="bg-success" >
        <div class="container p-1" >
			<div class="row">
				<div class="col">
					<h5 class="text-white my-2">Keels.lk</h5>
				</div>
				<div class="col nav justify-content-end">
					<div class="login my-2" style="cursor : pointer " onclick="DoA()"> <i class="fas fa-home text-white ">&nbsp&nbspHome</i></div><i class="my-2 text-white">&nbsp&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp&nbsp</i>
					<div class="login my-2" style="cursor : pointer" onclick="newlyAdded()"> <i class="fas fa-plus text-white ">&nbsp&nbspNewly Added</i></div><i class="my-2 text-white">&nbsp&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp&nbsp</i>
					<div class="login my-2" style="cursor : pointer ; border-bottom : 5px solid yellow" onclick="graph()"> <i class="fas fa-chart-bar text-white ">&nbsp&nbspGraph</i></div><i class="my-2 text-white">&nbsp&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp&nbsp</i>
					
					<div class="login my-2"  onclick="logout()" style="cursor : pointer"> <i class="fa fa-user text-white ">&nbsp&nbsp Log Out</i></div>
				</div>
			</div>
        </div>	
	</div>
	<script>
		function newlyAdded() {
				window.location.href = "./newlyAdded.php";
		}
		function DoA() {
				window.location.href = "./DoA.php";
		}
		function graph() {
				window.location.href = "./graph.php";
		}
		
	</script>
	
	<div class="row mx-2 my-4">
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
									$sql = "SELECT * from products";
									$result = $con->query($sql);
									$category1 = 0;
									$category2 = 0;
									
									$finalResultForFruits = "";
									$finalResultForVegitables = "";
									if($result->num_rows > 0){
										while($row = $result->fetch_assoc())
										{
											if($row["Type"] == "Fruit") {
												$category1 = $category1 + 1 ;
											}
											else {
												$category2 = $category2 + 1 ;
											}
										}
										$category1 = ($category1 / ($category1 + $category2) ) * 100 ;
										$category2 =  ( $category2 / ($category1 + $category2) ) * 100; 
										
										echo '<p>Fruits</p><div class="progress">
												  <div class="progress-bar bg-warning" role="progressbar" style="width: '; echo $category1; echo '%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
												</div>';	
										echo '<p class="my-4">Vegitables</p><div class="progress">
												  <div class="progress-bar bg-warning" role="progressbar" style="width: '; echo $category2; echo '%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
												</div>';	
										
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
								$sql = "SELECT * from buyproducts";
								$result = $con->query($sql);
								
								if($result->num_rows > 0){
									while($row = $result->fetch_assoc())
									{
											echo '	<tr>
												  <td> ' ; echo $row["itemName"]; echo '</td>
												  <td>' ; echo $row["Qty"] ; echo '</td>
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
								$sql = "SELECT * from wasteditems";
								$result = $con->query($sql);
								
								if($result->num_rows > 0){
									while($row = $result->fetch_assoc())
									{
										echo '	<tr>
											  <td> ' ; echo $row["ItemName"]; echo ' </td>
											  <td>' ; echo $row["Qty"] ;  echo '</td>
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
							$D1 = 0;
							$D2 = 0;
							$D3 = 0;
							$D4 = 0;
							$D5 = 0;
							$D6 = 0;
							$D7 = 0;
							$D8 = 0;
							$D9 = 0;
							$D10 = 0;
							$D11 = 0;
							$D12 = 0;
							$D13 = 0;
							$D14 = 0;
							$D15 = 0;
							$D24 = 0;
							$D16 = 0;
							$D17 = 0;
							$D18 = 0;
							$D19 = 0;
							$D20 = 0;
							$D21 = 0;
							$D22 = 0;
							$D23 = 0;
							$D25 = 0;
							
							$con = getConnection();
							$sql = "SELECT * from products";
							$result = $con->query($sql) ;
							if($result->num_rows > 0){
								while($row = $result->fetch_assoc())
								{
									if($row["status"] == "Accepted"){
										if($row["City"] == "Anuradhapura") {
											$D1 = $D1 + 1;
										}
										if($row["City"] == "Ampara") {
											$D2 = $D2 + 1;
										}
										if($row["City"] == "Badulla") {
											$D3 = $D3 + 1;
										}
										if($row["City"] == "Batticaloa") {
											$D4 = $D4 + 1;
										}
										if($row["City"] == "Colombo") {
											$D5 = $D5 + 1;
										}
										if($row["City"] == "Galle") {
											$D6 = $D6 + 1;
										}
										if($row["City"] == "Gampaha") {
											$D7 = $D7 + 1;
										}
										if($row["City"] == "Hambantota") {
											$D8 = $D8 + 1;
										}
										if($row["City"] == "Jaffna") {
											$D9 = $D9 + 1;
										}
										if($row["City"] == "Kalutara") {
											$D10 = $D10 + 1;
										}
										if($row["City"] == "Kandy") {
											$D11 = $D11 + 1;
										}
										if($row["City"] == "Kegalle") {
											$D12 = $D12 + 1;
										}
										if($row["City"] == "Kilinochchi") {
											$D13 = $D13 + 1;
										}
										if($row["City"] == "Kurunagala") {
											$D24 = $D24 + 1;
										}
										if($row["City"] == "Mannar") {
											$D14 = $D14 + 1;
										}
										if($row["City"] == "Matale") {
											$D15 = $D15 + 1;
										}
										if($row["City"] == "Matara") {
											$D16 = $D16 + 1;
										}
										if($row["City"] == "Monaragala") {
											$D17 = $D17 + 1;
										}
										if($row["City"] == "Mullaitivu") {
											$D25 = $D25 + 1;
										}
										if($row["City"] == "NuwaraEliya") {
											$D18 = $D18 + 1;
										}
										if($row["City"] == "Polonnaruwa") {
											$D19 = $D19 + 1;
										}
										if($row["City"] == "Puttalam") {
											$D20 = $D20 + 1;
										}
										if($row["City"] == "Ratnapura") {
											$D21 = $D21 + 1;
										}
										if($row["City"] == "Trincomalee") {
											$D22 = $D22 + 1;
										}
										if($row["City"] == "Vavuniya") {
											$D23 = $D23 + 1;
										}
									}
								}
								echo '<tr>
										  <td>Anuradhapura</td>
										  <td>'; echo $D1 ; echo'</td>
										</tr>';
								echo '<tr>
										  <td>Ampara</td>
										  <td>'; echo $D2  ; echo'</td>
										</tr>';
								echo '<tr>
										  <td>Badulla </td>
										  <td>'; echo $D3  ; echo'</td>
										</tr>';
								echo '<tr>
										  <td>Batticaloa </td>
										  <td>'; echo $D4  ; echo'</td>
										</tr>';
								echo '<tr>
										  <td>Colombo </td>
										  <td>'; echo $D5  ; echo'</td>
										</tr>';
								echo '<tr>
										  <td>Galle </td>
										  <td>'; echo $D6  ; echo'</td>
										</tr>';
								echo '<tr>
										  <td>Gampaha </td>
										  <td>'; echo $D7  ; echo'</td>
										</tr>';
								echo '<tr>
										  <td>Hambantota </td>
										  <td>'; echo $D8  ; echo'</td>
										</tr>';
								echo '<tr>
										  <td>Jaffna </td>
										  <td>'; echo $D9  ; echo'</td>
										</tr>';
								echo '<tr>
										  <td>Kalutara </td>
										  <td>'; echo $D10  ; echo'</td>
										</tr>';
								echo '<tr>
										  <td>Kandy </td>
										  <td>'; echo $D11  ; echo'</td>
										</tr>';
								echo '<tr>
										  <td>Kegalle </td>
										  <td>'; echo $D12  ; echo'</td>
										</tr>';
								echo '<tr>
										  <td>Kilinochchi </td>
										  <td>'; echo $D13  ; echo'</td>
										</tr>';
								echo '<tr>
										  <td>Kurunegala </td>
										  <td>'; echo $D24 ; echo'</td>
										</tr>';
								echo '<tr>
										  <td>Mannar </td>
										  <td>'; echo $D14  ; echo'</td>
										</tr>';
								echo '<tr>
										  <td>Matale </td>
										  <td>'; echo $D15  ; echo'</td>
										</tr>';
								echo '<tr>
										  <td>Matara </td>
										  <td>'; echo $D16  ; echo'</td>
										</tr>';
								echo '<tr>
										  <td>Monaragala</td>
										  <td>'; echo $D17 ; echo'</td>
										</tr>';
								echo '<tr>
										  <td>Mullaitivu</td>
										  <td>'; echo $D25 ; echo'</td>
										</tr>';
								echo '<tr>
										  <td>NuwaraEliya </td>
										  <td>'; echo $D18  ; echo'</td>
										</tr>';
								echo '<tr>
										  <td>Polonnaruwa </td>
										  <td>'; echo $D19  ; echo'</td>
										</tr>';
								echo '<tr>
										  <td>Puttalam </td>
										  <td>'; echo $D20  ; echo'</td>
										</tr>';
								echo '<tr>
										  <td>Ratnapura </td>
										  <td>'; echo $D21  ; echo'</td>
										</tr>';
								echo '<tr>
										  <td>Trincomalee </td>
										  <td>'; echo $D22  ; echo'</td>
										</tr>';
								echo '<tr>
										  <td>Vavuniya </td>
										  <td>'; echo $D23 ; echo'</td>
										</tr>';
							}
						?>
						
						
					  </tbody>
					</table>
				  </div>
				</div>
			  </div>
			</div>
		</div>
	
		<script>
			
			function logout(){
				 $.ajax({
					url: './php/logout.php',
					type: 'POST',
					
					success: function(data) {
						window.location.href = "./index.php";				
					} 
				});
			}
		
			
		</script>
  </body>
</html>