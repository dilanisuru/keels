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
	
	
  </head>
  <body>
	<div>
		<div class="bg-success">
            <div class="container p-1" >
				<div class="row">
					<div class="col">
						<h5 class="text-white my-2">Keels.lk</h5>
					</div>
					<div class="col nav justify-content-end">
						<div class="login my-2"  style="cursor : pointer"> <i class="fa fa-user text-white ">&nbsp&nbsp Sign in</i></div>
					</div>
				</div>
            </div>
        </div>
		
	</div>
	<div class="content" style="height : 550px; width : 400px;">
		<h5 class="text-center"><u>Sign Up</u></h5><br>
		<form method="POST" >
			  <div class="mb-3">
				<label for="exampleInputEmail1" class="form-label">Your Name</label>
				<input type="text" class="form-control" name="Name" aria-describedby="emailHelp">
			  </div>
			  <div class="mb-3">
				<label for="exampleInputEmail1" class="form-label">Address</label>
				<input type="text" class="form-control" name="Address" aria-describedby="emailHelp">
			  </div>
			  <div class="mb-3">
				<label for="exampleInputEmail1" class="form-label">NIC</label>
				<input type="text" class="form-control" name="UN" aria-describedby="emailHelp">
			  </div>
			  <div class="mb-3">
				<label for="exampleInputPassword1" class="form-label">Password</label>
				<input type="password" class="form-control" name="PW1">
			  </div>
			  <div class="mb-3">
				<label for="exampleInputPassword1" class="form-label">Re-Enter Password</label>
				<input type="password" class="form-control" name="PW2">
			  </div>
			 
			  <button type="submit" class="btn btn-primary" name="signup">Signup</button>
		</form>
	</div>
	<?php
		require_once "./php/database.php";
		
		if(isset($_POST["signup"])){		
			$Name = $_POST['Name'];
			$Address =  $_POST['Address'];
			$Username = $_POST['UN'];
			$Password1 =  $_POST['PW1'];
			$Password2 =  $_POST['PW2'];
			$Type = "farmer";


			if($Password1 == $Password2){
				$con = getConnection();
				$sql = "INSERT into users (ID , Name , Address , Username , Password , Type ) 
				value(NULL , '$Name' , '$Address' ,  '$Username' , '$Password1'  , '$Type' ) ";
				if($con->query($sql)) {
					$sql2 = "SELECT * from users WHERE Username = '$Username' AND Password = '$Password1'";
					$result = $con->query($sql2);
					
					if($result->num_rows > 0){
						while($row = $result->fetch_assoc())
						{
							$_SESSION['ID'] = $row["ID"];
							$_SESSION['Name'] = $row["Name"];
							$_SESSION['Address'] = $row["Address"];
							$_SESSION['Type'] = $row["Type"];
							
							if($row["Type"] == "farmer"){
								echo '<script>window.location.href = "./farmer.php";</script>';
							}
							if($row["Type"] == "DoA"){
								echo '<script>window.location.href = "./DoA.php";</script>';
							}
							if($row["Type"] == "Keels"){
								echo '<script>window.location.href = "./Keeels.php";</script>';
							}
						}
							 
					}	
				}
				else {
					die(trigger_error(mysqli_error($con)));
				}
				
			}
			else {
				echo '<script>alert("Password does not match");</script>';
				echo '<script>window.location.href = "./signup.php";</script>';
			}
		}

	?>

	<script>
		function signup() {
			window.location.href = "./signup.php";
		}
	</script>

  </body>
</html>