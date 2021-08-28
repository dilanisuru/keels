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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
					<?php
						if($_SESSION['Type'] == "DoA"){
							echo '<div class="login my-2" style="cursor : pointer ;" onclick="DoA()"> <i class="fas fa-home text-white ">&nbsp&nbspHome</i></div><i class="my-2 text-white">&nbsp&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp&nbsp</i>';
						}
						else {
							echo '<div class="login my-2" style="cursor : pointer ; " onclick="home()"> <i class="fas fa-home text-white ">&nbsp&nbspHome</i></div><i class="my-2 text-white">&nbsp&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp&nbsp</i>';
						}
					?>
					<div class="login my-2" style="cursor : pointer ;  border-bottom : 5px solid yellow" onclick="newlyAdded()"> <i class="fas fa-plus text-white ">&nbsp&nbspNewly Added</i></div><i class="my-2 text-white">&nbsp&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp&nbsp</i>
					<?php
						if($_SESSION['Type'] == "DoA"){
							echo '<div class="login my-2" style="cursor : pointer" onclick="graph()"> <i class="fas fa-chart-bar text-white ">&nbsp&nbspGraph</i></div><i class="my-2 text-white">&nbsp&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp&nbsp</i>';
						}
						else {
							echo '<div class="login my-2" style="cursor : pointer" onclick="wasted()"> <i class="fas fa-times text-white ">&nbsp&nbspWasted</i></div><i class="my-2 text-white">&nbsp&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp&nbsp</i>';
						}
					?>
					<div class="login my-2" onclick="logout()" style="cursor : pointer"> <i class="fa fa-user text-white ">&nbsp&nbsp Log Out</i></div>
				</div>
			</div>
        </div>	
	</div>
	
	<script>
		function home() {
				window.location.href = "./keels.php";
		}
		function newlyAdded() {
				window.location.href = "./newlyAdded.php";
		}
		function wasted() {
				window.location.href = "./wasted.php";
		}
		function DoA() {
				window.location.href = "./DoA.php";
		}
		function graph() {
				window.location.href = "./graph.php";
		}
	</script>
	
	
	<div class="row row-cols-1 row-cols-md-5 g-4 mx-1 my-1">
		<?php
			$con = getConnection();
			$sql = "SELECT * from products";
			$result = $con->query($sql);
			
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc())
				{
					if($row["status"] == "Pending"){
						echo '
							  <div class="col" >
								<div class="card h-100" >
								   <img src=" ' ; echo $row["image"] ; echo '" class="card-img-top" alt="..." style="height : 200px;" >
								  <div class="card-body">
									<h5 class="card-title">' ; echo $row["farmerName"] ; 
									echo '
									</h5>
									<p class="card-text">' ; echo $row["report"] ; echo '</p>
									<lable><i class="fas fa-cubes mx-1"></i>'; 
										echo $row["Qty"]; 
										echo '&nbsp|&nbsp <i class="fas fa-hand-holding-usd mx-1"></i>' ;
										echo $row["price"]; 
										
										echo '
									<lable>
									<lable>'; 
										echo '&nbsp|&nbsp <i class="fas fa-map-marker-alt mx-1"></i>' ;
										echo $row["farmerAddress"]; 
										
										echo "
									<lable> <br>
									<button type=\"button\" class=\"btn btn-success my-2\" onclick=\"Accept('".$row["ID"]."');\">Accept</button>
									<button type=\"button\" class=\"btn btn-danger my-2\" onclick=\"Reject('".$row["ID"]."');\">Reject</button>
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
		<form  method="POST">
			<input type="text" id="id" style="display : none;" name="id"></input>
			<input type="text" id="status" style="display : none;" name="Status"></input>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<button type="submit" id="btn" class="btn btn-success" name="cnfrm">Confirm</button>
		</form>
      </div>
    </div>
  </div>
</div>			
<?php
		require_once "./php/database.php";
		
		if(isset($_POST["cnfrm"])){	
			$ID = $_POST['id'];
			$Status =  $_POST['Status'];

			$con = getConnection();
			$sql = "UPDATE products SET status = '$Status'  WHERE ID = '$ID'";
				
			if($con->query($sql)){
				echo '<script>window.location.href = "./newlyAdded.php";</script>';
			}
			else {
				die(trigger_error(mysqli_error($con)));
			}
		}
	?>
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
	<script>
		function Accept(id) {
			$('#AcceptAndReject').modal('show');
			document.getElementById('id').value = id;
			document.getElementById('btn').className = "btn btn-success";
			document.getElementById('status').value = "Accepted";
			document.getElementById('msg').innerHTML = "Are you sure want to accept the request...?";
		}

		function Reject(id) {
			$('#AcceptAndReject').modal('show');
			document.getElementById('id').value = id;
			document.getElementById('btn').className = "btn btn-danger";
			document.getElementById('status').value = "Rejected";
			document.getElementById('msg').innerHTML = "Are you sure want to reject the request...?";
		}	

		
				
	</script>

  </body>
</html>