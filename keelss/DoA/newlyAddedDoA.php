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
					<p class="my-2 mx-4" style="color : black ; cursor : pointer" >Newly Added</p>
					<p class="my-2" style="color : gray ; cursor : pointer" onclick = "gr()">buyAndWasted</p>
				</div>
			</div>
        </div>
    </div>
	
	
	
	<div class="row row-cols-1 row-cols-md-4 g-4 mx-1 my-1">
		<?php
			$con = getConnection();
			$sql = "SELECT * from harvests";
			$result = $con->query($sql);
			
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc())
				{
					if($row["Status"] == "Pending"){
						echo '
							  <div class="col" >
								<div class="card h-100" >
								   <img src=" ' ; echo $row["img"] ; echo '" class="card-img-top" alt="..." style=" max-height : 18rem;" >
								  <div class="card-body">
									<h5 class="card-title">' ; echo $row["Name"] ; 
									echo '
									</h5>
									<p class="card-text">' ; echo $row["report"] ; echo '</p>
									<lable><i class="fa fa-archive mx-1"></i>'; 
										echo $row["Quantity"]; 
										echo '&nbsp|&nbsp <i class="fa fa-money mx-1"></i>' ;
										echo $row["Price"]; 
										
										echo '
									<lable>
									<lable>&nbsp|&nbsp<i class="fa fa-user mx-1"></i>'; 
										echo $row["Name"]; 
										echo '&nbsp|&nbsp <i class="fa fa-map-marker mx-1"></i>' ;
										echo $row["Address"]; 
										
										echo "
									<lable>
								  </div>
								  <div class=\"card-footer\">
									<div class=\"row\">
										<div class=\"col\">
											<button type=\"button\" class=\"btn btn-success\" onclick=\"cofirmAccept('".$row["ID"]."');\">Accept</button>

										</div>
										<div class=\"col nav justify-content-end\">
											<button type=\"button\" class=\"btn btn-danger\" onclick=\"cofirmReject('".$row["ID"]."');\">Reject</button>
										</div>
									</div>						
								  </div>
								</div>
							  </div>
							";
					}
							
				}
			}
		
		?>
					 
					</div>
					
			

<!-- Modal -->
<div class="modal fade" id="AcceptAndReject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Please confirm</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		<label id="msg"></label>
		<form action="./php/updateHarvest.php" method="POST">
			<input type="text" id="id" style="display : none;" name="id"></input>
			<input type="text" id="status" style="display : none;" name="Status"></input>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<button type="submit" id="btn" class="btn btn-success">Confirm</button>
		</form>
      </div>
    </div>
  </div>
</div>			


	<script>
		function hm() {
			location.href = "./DoA.php";
		}
		
		function gr() {
			location.href = "./graph.php";
		}
		function cofirmAccept(id) {
			document.getElementById('id').value = id;
			document.getElementById('status').value = "Accepted";
			document.getElementById('msg').innerHTML = "Are you sure want to accept the request...?";
			$('#AcceptAndReject').modal('show');
			document.getElementById('btn').className = "btn btn-success";
		}

		function cofirmReject(id) {
			document.getElementById('id').value = id;
			document.getElementById('status').value = "Rejected";
			document.getElementById('msg').innerHTML = "Are you sure want to reject the request...?";
			$('#AcceptAndReject').modal('show');
			document.getElementById('btn').className = "btn btn-danger";
		}		
	</script>

  </body>
</html>