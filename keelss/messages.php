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
					<div class="login my-2" style="cursor : pointer " onclick="farmer()"> <i class="fas fa-home text-white ">&nbsp&nbspHome</i></div><i class="my-2 text-white">&nbsp&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp&nbsp</i>
					
					<div class="login my-2"  onclick="logout()" style="cursor : pointer"> <i class="fa fa-user text-white ">&nbsp&nbsp Log Out</i></div>
				</div>
			</div>
        </div>	
	</div>
	<div class="row  mx-1">
		<div class="col-2">
		
		</div>
		<div class="col-8 my-4">
			<?php
				require_once "./php/database.php";
				$con = getConnection();
				$sql = "SELECT * from message";
				$result = $con->query($sql);
					
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc())
					{
						if($row["userID"] == $_SESSION['ID']) {
							echo '<div class="card mb-3" >
							  <div class="row g-0">
								<div class="col-md-12">
								  <div class="card-body">
									<h5 class="card-title">'; echo $row["sendersName"]; echo'</h5>
									<p class="card-text">'; echo $row["Message"]; echo'</p>';
									if($row["reply"] != ""){
										echo '<p class="mx-4"><i class="fas fa-reply">&nbsp&nbsp'; echo $row["reply"]; echo'</i></p>';
									}
									else{
										echo '<form method="POST">
											<input type="text" class="form-control" name="ID" style="display : none" value="'; echo $row["ID"]; echo'">
											<input type="text" class="form-control"  name="reply" placeholder="your reply here...">
											<button type="submit" class="btn btn-success my-2" name="rp">Send Reply</button>
										</form>';
									}
										
								  echo '</div>
								</div>
							  </div>
							</div>';
						}
					}
				}
				if(isset($_POST["rp"])){	
					$ID = $_POST['ID'];
					$reply = $_POST['reply']  ;
					$con = getConnection();
					$sql = "UPDATE message SET reply = '$reply'  WHERE ID = '$ID'";
					if($con->query($sql)){
						echo '<script>window.location.href = "./messages.php";</script>';
					}
					else {
						die(trigger_error(mysqli_error($con)));
					}
				}
		
			?>
		</div>
		<div class="col-2">
		
		</div>		
	</div>
	
	<script>
		function farmer() {
				window.location.href = "./farmer.php";
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