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
					<p class="my-2 mx-4" style="color : black ;cursor : pointer" >Home</p>
					<p class="my-2 mx-4" style="color : gray ; cursor : pointer" onclick = "na()">Newly Added</p>
					<p class="my-2" style="color : gray ; cursor : pointer" onclick = "gr()">Graphs</p>
				</div>
			</div>
        </div>
    </div>
	<div class="row">
	  <div class="col-sm-4">
		<div class="">
		  <div class="card-body">
			<div class="">
				<?php 
					$con = getConnection();
					$sql = "SELECT * from harvests";
					$result = $con->query($sql);
					
					if($result->num_rows > 0){
						while($row = $result->fetch_assoc())
						{
							if($row["Status"] == "Accepted"){
								echo "<div class=\"border-bottom\" style=\"cursor : pointer;\" onclick=\"showDetails('".$row["ItemName"]."' , '".$row["report"]."' , '".$row["Name"]."' ,  '".$row["Address"]."' ,  '".$row["contactNumber"]."' , '".$row["flag"]."' , '".$row["ID"]."'  , '".$row["img"]."')\">
										<div class=\"my-2\">
											<h5>" ; echo $row["ItemName"]; echo "</h5>
											<lable><i class=\"fa fa-archive mx-1\"></i>"; 
												echo $row["Quantity"]; 
												echo "&nbsp|&nbsp <i class=\"fa fa-money mx-1\"></i>" ;
												echo $row["Price"]; 
												if($row["flag"] == 0) {
													echo '&nbsp|&nbsp<i class="fa fa-flag text-secondary"> Not Set </i>';
												}
												if($row["flag"] == 1) {
													echo "&nbsp|&nbsp<i class=\"fa fa-flag text-danger mx-1\"> Bad</i>" ;
												}
												if($row["flag"] == 2) {
													echo "&nbsp|&nbsp<i class=\"fa fa-flag text-success mx-1\"> Good</i>" ;
												}
												echo "
											<lable>
										</div>
								</div>";
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
		
		function showDetails(name , report , farmer , location , phone , flag , ID , img) {
			$('#modal_aside_left').modal('show');
			document.getElementById('name').innerHTML = name;
			document.getElementById('report').innerHTML = report;
			document.getElementById('farmer').innerHTML = "&nbsp&nbsp" + farmer;
			document.getElementById('location').innerHTML = "&nbsp&nbsp" + location;
			document.getElementById('phone').innerHTML = "&nbsp&nbsp" + phone;
			document.getElementById('img').src = img;
			
		}
		
		function hm() {
			location.href = "./DoA.php";
		}
		
		function na() {
			location.href = "./newlyAdded.php";
		}
		
		function gr() {
			location.href = "./graph.php";
		}
	</script>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkMPHn6uJ7Qbdlf2vkQFXpOfT0yI1-rbk&callback=myMap"></script>

	
	
	

<div id="modal_aside_left" class="modal fixed-left fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-aside" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
		<img src="" style="width : 100%; height : 20%;" id="img">
		<h6 id="name" style="margin-top : 8%;"></h6>
		<p id="report"></p>
		<p id="farmer" class="fa fa-user"></p> <br>
		<p id="location" class="fa fa-map-marker"></p> <br>
		<p id="phone" class="fa fa-phone"></p>
		
		<hr>
		
      </div>
     
    </div>
  </div> <!-- modal-bialog .// -->
</div> <!-- modal.// -->

	

<script>

	function saetFlag() {
		$('#saetFlag').modal('show');
	}	


</script>

  </body>
</html>