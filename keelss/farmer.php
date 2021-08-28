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
						<div class="login my-2" style="cursor : pointer ;"  onclick="msg()"> <i class="fas fa-comments text-white ">&nbsp&nbspMessage</i></div><i class="my-2 text-white">&nbsp&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp&nbsp</i>
					
						<div class="login my-2" onclick="logout()" style="cursor : pointer"> <i class="fa fa-user text-white ">&nbsp&nbsp Sign Out</i></div>
					</div>
				</div>
            </div>
        </div>
		
	</div>
	<script>
		function msg() {
				window.location.href = "./messages.php";
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
	<div class="row my-4 mx-2">
		<div class="col">
			<label>
				<i class="text-secondary">---&nbsp&nbspPending</i>&nbsp&nbsp&nbsp&nbsp
				<i class="text-success">---&nbsp&nbspAccepted</i>&nbsp&nbsp&nbsp&nbsp
				<i class="text-danger">---&nbsp&nbspRejected</i>
			</label>
		</div>
		<div class="col nav justify-content-end">
			<button type="button" class="btn btn-success" onclick="openAddNew()"><i class="fas fa-plus mx-2"></i>Add New Item</button>
		</div>
	</div>	

	<div class="mx-2 my-4">
		<div class="row row-cols-1 row-cols-md-5 g-4">
			<?php
				require_once "./php/database.php";
				$con = getConnection();
				$sql = "SELECT * from products";
				$result = $con->query($sql);
					
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc())
					{
						if($row["userID"] == $_SESSION['ID']) {
							if($row["status"] == "Accepted"){
								echo '<div class="col">
										<div class="bg-success p-1"></div>
										<div class="card h-100">
										  <img src="'; echo $row["image"]; echo'" class="card-img-top" alt="..." style="height: 200px">
										  <div class="card-body">
											<h5 class="card-title">'; echo $row["itemName"]; echo'</h5>
											<label class="text-success">
												<i class="fas fa-money-check-alt"></i>&nbsp&nbsp'; echo $row["price"]; echo'&nbspLKR
											</label>
											<p class="card-text">'; echo $row["report"]; echo"</p>
											<button type=\"submit\" class=\"btn btn-success\" name=\"edit\"  onclick=\"updateDialogDisplay('".$row["ID"]."')\" >Edit</button>
											<button type=\"submit\" class=\"btn btn-danger\" name=\"dlt\"  onclick=\"deleteDialogDisplay('".$row["ID"]."')\">Delete</button>
										  </div>
										</div>
									  </div>";
							}
							if($row["status"] == "Pending"){
								echo '<div class="col">
										<div class="bg-secondary p-1"></div>
										<div class="card h-100">
										  <img src="'; echo $row["image"]; echo'" class="card-img-top" alt="..." style="height: 200px">
										  <div class="card-body">
											<h5 class="card-title">'; echo $row["itemName"]; echo'</h5>
											<label class="text-success">
												<i class="fas fa-money-check-alt"></i>&nbsp&nbsp'; echo $row["price"]; echo'&nbspLKR
											</label>
											<p class="card-text">'; echo $row["report"]; echo"</p>
											<button type=\"submit\" class=\"btn btn-success\" name=\"edit\"  onclick=\"updateDialogDisplay('".$row["ID"]."')\" >Edit</button>
											<button type=\"submit\" class=\"btn btn-danger\" name=\"dlt\"  onclick=\"deleteDialogDisplay('".$row["ID"]."')\">Delete</button>
										  </div>
										</div>
									  </div>";
							}
							if($row["status"] == "Rejected"){
								echo '<div class="col">
										<div class="bg-danger p-1"></div>
										<div class="card h-100">
										  <img src="'; echo $row["image"]; echo'" class="card-img-top" alt="...">
										  <div class="card-body">
											<h5 class="card-title">'; echo $row["itemName"]; echo'</h5>
											<label class="text-success">
												<i class="fas fa-money-check-alt"></i>&nbsp&nbsp'; echo $row["price"]; echo'&nbspLKR
											</label>
											<p class="card-text">'; echo $row["report"]; echo'</p>
										  </div>
										</div>
									  </div>';
							}
						}
					}
				}
			?>
	</div>

<!-- Modal -->
	<div class="modal fade bd-example-modal-lg" id="addNew" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="p-4">
			<form method="POST">
				  <div class="mb-3">
					<label for="exampleInputEmail1" class="form-label">Your Name</label>
					<input type="text" class="form-control" name="name"  aria-describedby="emailHelp" >
				  </div>
				  <div class="mb-3">
					<label for="exampleInputPassword1" class="form-label">Your Address</label>
					<input type="text" class="form-control" name="location" >
				  </div>				  
				  <div class="mb-3">
					<label for="exampleInputPassword1" class="form-label">Nearest City</label>
					<select name="City"  style="width : 100%;">
						 <option value="s">--Select the City--</option>
						 <option value="Ampara">Ampara</option>
						 <option value="Anuradhapura">Anuradhapura</option>
						 <option value="Badulla">Badulla</option>
						  <option value="Batticaloa">Batticaloa</option>
						 <option value="Colombo">Colombo</option>
						  <option value="Galle">Galle</option>
						  <option value="Gampaha">Gampaha</option>
						 <option value="Hambantota">Hambantota</option>
						  <option value="Jaffna">Jaffna</option>
						 <option value="Kalutara">Kalutara</option>
						  <option value="Kandy">Kandy</option>
						 <option value="Kegalle">Kegalle</option>
						 <option value="Kilinochchi">Kilinochchi</option>
						 <option value="Kurunegala">Kurunegala</option>
						  <option value="Mannar">Mannar</option>
						 <option value="Matale">Matale</option>
						  <option value="Matara">Matara</option>
						 <option value="Monaragala">Monaragala</option>
						 <option value="Mullaitivu">Mullaitivu</option>
						  <option value="Nuwara Eliya">Nuwara Eliya</option>
						 <option value="Polonnaruwa">Polonnaruwa</option>
						  <option value="Puttalam">Puttalam</option>
						 <option value="Ratnapura">Ratnapura</option>
						  <option value="Trincomalee">Trincomalee</option>
						  <option value="Vavuniya">Vavuniya</option>
						 
					</select>
				  </div>
				  
				   <div class="mb-3">
					<label for="exampleInputPassword1" class="form-label">Type</label>
					<select name="Type"  style="width : 100%;">
						 <option value="s">--Select the product--</option>
						 <option value="Fruit">Fruit</option>
						 <option value="Vegitable">Vegitable</option>
					</select>
				  </div>
				  
				  
				  <div class="mb-3">
					<label for="exampleInputPassword1" class="form-label">Name of the Item</label>
					<input type="text" class="form-control" name="NameOTheProduct" >
				  </div>
				  <div class="mb-3">
					<label for="exampleInputPassword1" class="form-label">Quantity</label>
					<input type="text" class="form-control" name="Quantity" >
				  </div>
				  <div class="mb-3">
					<label for="exampleInputPassword1" class="form-label">Price</label>
					<input type="text" class="form-control" name="Price" >
				  </div>
				  <div class="mb-3">
					<label for="exampleInputPassword1" class="form-label">Contact Number</label>
					<input type="text" class="form-control" name="ContactNumber" >
				  </div>
				  <div class="mb-3">
					<label for="exampleInputPassword1" class="form-label">Your Report</label>
					 <textarea class="form-control"  name="Report" style="height: 100px"></textarea>
				  </div>
				  
				  <div class="mb-3">
					<label for="exampleInputPassword1" class="form-label">
						Image 1
						<div class="spinner-border text-primary mx-2" id="loader" role="status" style="display : none;">
						  <span class="visually-hidden">Loading...</span>
						</div>
					</label>
					<input type="file" class="form-control" id="file1"  onchange="fileUpload()">
					<input for="exampleInputPassword1" id="img1" name="imgLink" class="bordern form-label" style="display : none;" readonly></input>
				  </div>
				  <div class="text-center">
					<button type="submit" class="btn btn-success" name="add" >Add Product</button>
				  </div>
				 
			</form>
			<?php
				require_once "./php/database.php";
				if(isset($_POST["add"])) {
					$farmerName = $_POST['name'];
					$userID = $_SESSION['ID'] ;
					$farmerAddress =  $_POST['location'];
					$City = $_POST['City'];
					$Type = $_POST['Type'];
					$itemName = $_POST['NameOTheProduct'];
					$Qty = $_POST['Quantity'];
					$price = $_POST['Price'];
					$contactNumber = $_POST['ContactNumber'];
					$report = $_POST['Report'];
					$img = $_POST['imgLink'];
					$status = "Pending";
					$flag = 0;

					$con = getConnection();
					$sql2 = "INSERT into products (ID , userID , farmerName , farmerAddress , City , Type , itemName  , Qty , price , contactNumber , report ,  image , status , flag) 
					value(NULL , $userID , '$farmerName'  , '$farmerAddress' , '$City' , '$Type' , '$itemName' , '$Qty' , '$price' , '$contactNumber' , '$report' , '$img' , '$status' , '$flag') ";
					if($con->query($sql2)) {
						echo '<script>alert("Record Saved Successfully");</script>';
						echo '<script>window.location.href = "./farmer.php";</script>';			
					}
					else {
						die(trigger_error(mysqli_error($con)));
					}
				}
			?>
		  </div>
		  
		</div>
	  </div>
	</div>
	
	<!-- The core Firebase JS SDK is always required and must be listed first -->
		<script src="https://www.gstatic.com/firebasejs/7.22.1/firebase-app.js"></script>

		<!-- TODO: Add SDKs for Firebase products that you want to use
			 https://firebase.google.com/docs/web/setup#available-libraries -->
		<script src="https://www.gstatic.com/firebasejs/7.22.1/firebase-analytics.js"></script>

		<script>
		  // Your web app's Firebase configuration
		  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
		  var firebaseConfig = {
			apiKey: "AIzaSyBQPUCOILiSUbdEQaa7iYwrDkpxytNO8BU",
			authDomain: "images-9f28a.firebaseapp.com",
			databaseURL: "https://images-9f28a.firebaseio.com",
			projectId: "images-9f28a",
			storageBucket: "images-9f28a.appspot.com",
			messagingSenderId: "362505226905",
			appId: "1:362505226905:web:90c4df6186f969c6288608",
			measurementId: "G-XKZGYRXL2Y"
		  };
		  // Initialize Firebase
		  firebase.initializeApp(firebaseConfig);
		  firebase.analytics();
		</script>



		<script src="https://www.gstatic.com/firebasejs/7.22.0/firebase-storage.js"></script>
		
		
		<script>
		
			function fileUpload() {
				document.getElementById("loader").style.display = "block";
				console.log("caled");
				var file = document.getElementById("file1").files[0];
				var filename = file.name;
				 var storageRef = firebase.storage().ref(filename)
				 storageRef.put(file).then(function () {
					 storageRef.getDownloadURL().then(function (result) {
						 console.log(result);
						 document.getElementById("img1").value = result;
						 document.getElementById("loader").style.display = "none";
					 });

				 });
			}
			

			function openAddNew() {
				$('#addNew').modal('show');
			}
			function updateDialogDisplay(id) {
				$('#update').modal('show');
				document.getElementById("uidid").value = id;
			}
			function deleteDialogDisplay(id) {
				$('#delete').modal('show');
				document.getElementById("deleteid").value = id;
			}
		</script>
<!-- Modal -->
<div class="modal fade" id="update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Updating Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" >
			<input type="text" class="form-control" style="display : none" name="uid" id="uidid">
			<input type="text" class="form-control" name="updatedReport" >
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success" name="updt">Save changes</button>
		</form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deleting Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <form method="POST" >
			<input type="text" class="form-control" style="display : none" name="did" id="deleteid">
			Are you sure want to delete this report?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-danger" name="dlt">Yes , Delete</button>
		</form>
      </div>
    </div>
  </div>
</div>
	<?php
		if(isset($_POST["updt"])) {
			$ID = $_POST['uid'];
			$report =  $_POST['updatedReport'];

			$con = getConnection();
			$sql = "UPDATE products SET report = '$report'  WHERE ID = '$ID'";
					
			if($con->query($sql)){
				echo '<script>window.location.href = "./farmer.php";</script>';
			}
			else {
				die(trigger_error(mysqli_error($con)));
			}
		}
		if(isset($_POST["dlt"])) {
			$ID = $_POST['did'];
			$report =  "";

			$con = getConnection();
			$sql = "UPDATE products SET report = '$report'  WHERE ID = '$ID'";
					
			if($con->query($sql)){
				echo '<script>window.location.href = "./farmer.php";</script>';
			}
			else {
				die(trigger_error(mysqli_error($con)));
			}
		}
	?>
  </body>
</html>