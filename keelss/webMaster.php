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
        <div class="container p-2" >
			<div class="row">
				<div class="col">
					<h6 class="my-1 text-white">Web Master</h6>
				</div>
				<div class="col nav justify-content-end"></div>
					<div class="login" onclick="logout()" style="cursor : pointer"> <i class="fa fa-user text-white ">&nbsp&nbsp Log Out</i></div>
				</div>
			</div>
        </div>	
	</div>
	
	<div class="row mx-1 my-1">
		<div class="col-sm-4">
			<div class="card">
			  <div class="card-body">
				<h5 class="card-title" style="text-decoration : underline">Create New Login</h5>
				<p class="card-text">
					<form method="POST">
					  <div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Account Name</label>
						<input type="text" class="form-control" id="name" name="Name"  aria-describedby="emailHelp" >
					  </div>
					  <div class="mb-3">
						<label for="exampleInputPassword1" class="form-label">Location(Address)</label>
						<input type="text" class="form-control" id="location" name="Location" >
					  </div>
					  <div class="mb-3">
						<label for="exampleInputPassword1" class="form-label">Account Type</label>
							<select name="Type" id="items" style="width : 100%;">
								<option value="s">--Select the product--</option>
								<option value="Keels">Keels</option>
								<option value="DoA">DoA</option>
							</select>
					  </div>
					  <div class="mb-3">
						<label for="exampleInputPassword1" class="form-label">Username</label>
						<input type="text" class="form-control" id="username" name="Username"  >
					  </div>
					  <div class="mb-3">
						<label for="exampleInputPassword1" class="form-label">Password</label>
						<input type="password" class="form-control"  name="Password1"  >
					  </div>
					  <div class="mb-3">
						<label for="exampleInputPassword1" class="form-label">Re-Eenter Password</label>
						<input type="password" class="form-control"  name="Password2"   >
					  </div>
					 
					  
					  <div class="text-center">
						<button type="submit" class="btn btn-success" name="createAccount">Create Account</button>
					  </div>
					 
					</form>
				
				</p>
			  </div>
			</div>
		</div>
		
		<?php
			if(isset($_POST["createAccount"])){	
				$Name = $_POST['Name'];
				$Add =  $_POST['Location'];
				$UN = $_POST['Username'];
				$Password1 =  $_POST['Password1'];
				$Password2 =  $_POST['Password2'];
				$AccType = $_POST['Type'];


				if($Password1 == $Password2){
					$con = getConnection();
					$sql = "INSERT into users (ID , Name , Address , Username , Password , Type ) 
					value(NULL , '$Name' , '$Add' ,  '$UN' , '$Password1'  , '$AccType' ) ";
					if($con->query($sql)) {
						echo '<script>alert("Account Created Successfully");</script>';
						echo '<script>window.location.href = "./webMaster.php";</script>';
					}
					else {
						die(trigger_error(mysqli_error($con)));
					}
					
				}
				else {
					echo '<script>alert("Password does not match");</script>';
					echo '<script>window.location.href = "./webMaster.php";</script>';
				}
			}
		
		?>
		<div class="col-sm-8">
			<table class="table table-bordered my-5">
			  <thead>
				<tr>
				  <th scope="col">ID</th>
				  <th scope="col">Name</th>
				  <th scope="col">Address</th>
				   <th scope="col">Account Type</th>
				  <th scope="col">Username</th>
				   <th scope="col">password</th>
				</tr>
			  </thead>
			  <tbody>
				<?php 
				$con = getConnection();
				$sql = "SELECT * from users";
				$result = $con->query($sql);
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc())
					{
						if( $row["Type"] == "Keels"){
							echo '<tr class="bg-primary">
							  <th scope="row">' ; echo $row["ID"] ; echo '</th>
							  <td>' ; echo $row["Name"] ; echo '</td>
							  <td>' ; echo $row["Address"] ; echo '</td>
							   <td>' ; echo $row["Type"] ; echo '</td>
							    <td>' ; echo $row["Username"] ; echo '</td>
								 <td >' ; echo $row["Password"] ; echo '</td>
							</tr>';	
						}
						if( $row["Type"] == "DoA"){
							echo '<tr class="bg-warning">
							  <th scope="row">' ; echo $row["ID"] ; echo '</th>
							  <td>' ; echo $row["Name"] ; echo '</td>
							  <td>' ; echo $row["Address"] ; echo '</td>
							   <td>' ; echo $row["Type"] ; echo '</td>
							    <td>' ; echo $row["Username"] ; echo '</td>
								 <td >' ; echo $row["Password"] ; echo '</td>
							</tr>';	
						}
						if( $row["Type"] == "farmer"){
							echo '<tr>
							  <th scope="row">' ; echo $row["ID"] ; echo '</th>
							  <td>' ; echo $row["Name"] ; echo '</td>
							  <td>' ; echo $row["Address"] ; echo '</td>
							   <td>' ; echo $row["Type"] ; echo '</td>
							    <td>' ; echo $row["Username"] ; echo '</td>
								 <td >' ; echo $row["Password"] ; echo '</td>
							</tr>';	
						}
									
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