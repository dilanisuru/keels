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

    <title>Keels.lk</title>
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
	
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
	
	
    <title>Keels</title>
  </head>
  <body class="">
	<div class="bg-success" >
        <div class="container p-1" >
			<div class="row">
				<div class="col">
					<h5 class="text-white my-2">Keels.lk</h5>
				</div>
				<div class="col nav justify-content-end">
					<div class="login my-2" style="cursor : pointer " onclick="home()"> <i class="fas fa-home text-white ">&nbsp&nbspHome</i></div><i class="my-2 text-white">&nbsp&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp&nbsp</i>
					<div class="login my-2" style="cursor : pointer" onclick="newlyAdded()"> <i class="fas fa-plus text-white ">&nbsp&nbspNewly Added</i></div><i class="my-2 text-white">&nbsp&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp&nbsp</i>
					<div class="login my-2" style="cursor : pointer ; border-bottom : 5px solid yellow" onclick="wasted()"> <i class="fas fa-times text-white ">&nbsp&nbspWasted</i></div><i class="my-2 text-white">&nbsp&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp&nbsp</i>
					
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
	
	</script>
	
	<div class="row mx-1 my-4">
		<div class="col-sm-4">
			<div class="card">
			  <div class="card-body">
				<h5 class="card-title" style="text-decoration : underline">Wasted Products(Harvests)</h5>
				<p class="card-text">
					<form method="POST">
					  <div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Product Name</label>
						<select name="itemName" id="items" style="width : 100%;">
							<option value="s">--Select the product--</option>
							<?php
								$con = getConnection();
								$sql = "SELECT * from buyproducts";
								$result = $con->query($sql);
								
								if($result->num_rows > 0){
									while($row = $result->fetch_assoc())
									{
										echo ' <option value=" ' ; echo $row["itemName"] ; echo '">'; echo $row["itemName"] ; echo '</option>';
										
									}
								}
							?>
						</select>
					  </div>
					  <div class="mb-3">
						<label for="exampleInputPassword1" class="form-label">Wasted Quantity</label>
						<input type="text" class="form-control" id="qty" name="qty" >
					  </div>
					 
					  
					  <div class="text-center">
						<button type="submit" class="btn btn-success" name="saveWasted">Save Data</button>
					  </div>
					 
					</form>
				
				</p>
			  </div>
			</div>
		</div>
		
		<?php
			if(isset($_POST["saveWasted"])){	
				$ProductName = $_POST['itemName'];
				$qty =  $_POST['qty'];


				$con = getConnection();
				$sql2 = "INSERT into wasteditems (ID , ItemName , Qty ) 
				value(NULL , '$ProductName'  , '$qty') ";
				if($con->query($sql2)) {
					echo '<script>alert("Record Saved Successfully");</script>';
					echo '<script>window.location.href = "./wasted.php";</script>';			
				}
				else {
					die(trigger_error(mysqli_error($con)));
				}
			}
		
		?>
		<div class="col-sm-8">
			<table class="table table-bordered">
			  <thead>
				<tr>
				  <th scope="col">ID</th>
				  <th scope="col">Item Name</th>
				  <th scope="col">Quantity</th>
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
						
						echo '<tr>
								<th scope="row">' ; echo $row["ID"] ; echo '</th>
								<td>' ; echo $row["ItemName"] ; echo '</td>
								<td>' ; echo $row["Qty"] ; echo '</td>
							</tr>';										
					}
				}	
				
				?>
				
				
			  </tbody>
			</table>
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