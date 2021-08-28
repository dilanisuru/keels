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
	
	<style>
	.modal .modal-dialog-aside{ 
		width: 350px; max-width:80%; height: 100%; margin:0;transform: translate(0); transition: transform .2s;
	}
	.modal .modal-dialog-aside .modal-content{  height: inherit; border:0; border-radius: 0;}
	.modal .modal-dialog-aside .modal-content .modal-body{ overflow-y: auto }
	.modal.fixed-left .modal-dialog-aside{ margin-left:auto;  transform: translateX(100%); }
	.modal.fixed-right .modal-dialog-aside{ margin-right:auto; transform: translateX(-100%); }
	.modal.show .modal-dialog-aside{ transform: translateX(0);  }
		
	
	</style>
	
  </head>
  <body>	
	<div class="bg-success" >
        <div class="container p-1" >
			<div class="row">
				<div class="col">
					<h5 class="text-white my-2">Keels.lk</h5>
				</div>
				<div class="col nav justify-content-end">
					<div class="login my-2" style="cursor : pointer ; border-bottom : 5px solid yellow" onclick="DoA()"> <i class="fas fa-home text-white ">&nbsp&nbspHome</i></div><i class="my-2 text-white">&nbsp&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp&nbsp</i>
					<div class="login my-2" style="cursor : pointer" onclick="newlyAdded()"> <i class="fas fa-plus text-white ">&nbsp&nbspNewly Added</i></div><i class="my-2 text-white">&nbsp&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp&nbsp</i>
					<div class="login my-2" style="cursor : pointer" onclick="graph()"> <i class="fas fa-chart-bar text-white ">&nbsp&nbspGraph</i></div><i class="my-2 text-white">&nbsp&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp&nbsp</i>
					
					<div class="login my-2" onclick="logout()" style="cursor : pointer"> <i class="fa fa-user text-white ">&nbsp&nbsp Log Out</i></div>
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
	
	<div class="row">
	  <div class="col-sm-4">
		<div class="">
		  <div class="card-body">
			<div class="">
				<?php 
					$con = getConnection();
					$sql = "SELECT * from products";
					$result = $con->query($sql);
					
					if($result->num_rows > 0){
						while($row = $result->fetch_assoc())
						{
							if($row["status"] == "Accepted"){
								echo "<div class=\"border-bottom\" style=\"cursor : pointer;\" onclick=\"showDetails( '".$row["ID"]."' , '".$row["userID"]."' , '".$row["itemName"]."' , '".$row["report"]."' , '".$row["farmerName"]."' ,  '".$row["farmerAddress"]."' ,  '".$row["contactNumber"]."' , '".$row["image"]."' , '".$row["flag"]."' )\">
								";
				
								echo '<div class="card mb-3" style="max-width: 500px;">
										  <div class="row g-0">
											<div class="col-md-4">
											  <img src="'; echo $row["image"]; echo'" alt="..." style="width: 100%; height : 100%;">
											</div>
											<div class="col-md-8">
											  <div class="card-body">
												<label>
													<h5 class="card-title">'; echo $row["itemName"]; echo'</h5>';
													if($row["flag"] == 1){
														echo '<i class="fas fa-flag text-danger">&nbsp&nbspBad</i>';
													}
													if($row["flag"] == 2) {
														echo '<i class="fas fa-flag text-success">&nbsp&nbspGood</i>';
													}
												echo '</label>
												<p class="card-text">'; echo $row["report"]; echo'</p>
												<div class="row">
													<div class="col text-success">
														<p class="card-text"><i class="fas fa-hand-holding-usd"></i>'; echo $row["price"]; echo'</p>
													</div>
													<div class="col text-warning">
														<p class="card-text"><i class="fas fa-cubes"></i>'; echo $row["Qty"]; echo'</p>
													</div>
												</div>
											  </div>
											</div>
										  </div>
										</div>';
								echo "</div>";
							}
						}
					}
				?>
			</div>
		  </div>
		</div>
	  </div>
	  <div class="col-sm-8">
		<div class="">
		  <div class="card-body">
			<div id="googleMap" style="width:100%;height:700px;"></div>
		  </div>
		</div>
	  </div>
	</div>	

	<script>
		function myMap() {
			var mapProp= {
			  center:new google.maps.LatLng( 6.932898537443131, 79.85038375540171),
			  zoom:14,
			};
			var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
		}
		
		function showDetails(ID , userID , name , report , farmer , location , phone , image , flag ) {
			$('#modal_aside_left').modal('show');
			document.getElementById('img').src = image;
			document.getElementById('name').innerHTML = name;
			document.getElementById('report').innerHTML = report;
			document.getElementById('farmer').innerHTML = "&nbsp&nbsp" + farmer;
			document.getElementById('location').innerHTML = "&nbsp&nbsp" + location;
			document.getElementById('phone').innerHTML = "&nbsp&nbsp" + phone;
			
			
		}
		
	
    
	</script>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkMPHn6uJ7Qbdlf2vkQFXpOfT0yI1-rbk&callback=myMap"></script>

	
	
	

<div id="modal_aside_left" class="modal fixed-left fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-aside" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
		<div class="nav justify-content-center">
			<img src="" id="img" style="width : 60%; height : 20%;" >
		</div>
		<h5 id="name" style="margin-top : 8%;"></h5>
		<p id="report"></p>
		<p id="farmer" class="fas fa-user"></p> <br>
		<p id="location" class="fas fa-map-marker-alt"></p> <br>
		<p id="phone" class="fas fa-phone-alt"></p>
		
		
      </div>
     
    </div>
  </div> <!-- modal-bialog .// -->
</div> <!-- modal.// -->


<!-- Modal -->
<div class="modal fade" id="saetFlag" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Please confirm</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		<label id="msg"></label>
		
      </div>
    </div>
  </div>
</div>		
	<?php
		require_once "./php/database.php";
		
		if(isset($_POST["sf"])){	
			$flag = $_POST['flag'];
			$id = $_POST['id'] ;

			$con = getConnection();
			$sql = "UPDATE products SET flag = '$flag'  WHERE ID = '$id'";
			if($con->query($sql)){
				echo '<script>window.location.href = "./Keels.php";</script>';
			}
			else {
				die(trigger_error(mysqli_error($con)));
			}
		}
		if(isset($_POST["bn"])){	
			$ProductName = $_POST['pName'];
			$qty =  $_POST['pQty'];

			$con = getConnection();
			$sql2 = "INSERT into buyproducts (ID , itemName , Qty ) 
			value(NULL , '$ProductName'  , '$qty')";
			if($con->query($sql2)) {
				echo '<script>alert("Record Saved Successfully");</script>';
				echo '<script>window.location.href = "./keels.php";</script>';			
			}
			else {
				die(trigger_error(mysqli_error($con)));
			}
		}
	?>
<script>

	function saetFlag() {
		$('#saetFlag').modal('show');
	}	


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