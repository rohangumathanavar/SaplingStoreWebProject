<?php
	session_start();
	require 'db.php';
    $pid = $_SESSION['pid'];

  
    
?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $productType = $_POST['type'];
    $productName = dataFilter($_POST['pname']);
	$productInfo = $_POST['pinfo'];
	$stock = $_POST['stock'];
    $productPrice = dataFilter($_POST['price']);
    $fid = $_SESSION['id'];

    $sql = "UPDATE fproduct SET product='$productName', pcat='$productType', pinfo='$productInfo', price='$productPrice', stock='$stock'
          where pid='$pid'";
          
          
    $result = mysqli_query($conn, $sql);
    if(!$result)
    {
        $_SESSION['message'] = "Unable to upload Product !!!";
        header("Location: error.php");
    }
    else {
        $_SESSION['message'] = "update successfull !!!";
    }
}

?>

<?php
	function dataFilter($data)
	{
	    $data = trim($data);
	    $data = stripslashes($data);
	    $data = htmlspecialchars($data);
	    return $data;
	}

?>



<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>AgroCulture</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="bootstrap\js\bootstrap.min.js"></script>
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="login.css"/>
		<link rel="stylesheet" type="text/css" href="indexFooter.css">
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
		<script src="https://cdn.ckeditor.com/4.8.0/full/ckeditor.js"></script>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<style>
			input[type="number"]{
				-moz-appearance: none;
		-webkit-appearance: none;
		-o-appearance: none;
		-ms-appearance: none;
		appearance: none;
		background: rgba(144, 144, 144, 0.075);
		border-radius: 4px;
		border: none;
		border: solid 1px rgba(144, 144, 144, 0.25);
		color: inherit;
		display: block;
		outline: 0;
		padding: 0 1em;
		height: 50px;
		text-decoration: none;
		width: 100%;
			}
		</style>


	</head>
	<body>


				<?php
					require 'menu.php';

					$sql="SELECT * FROM fproduct WHERE pid = '$pid'";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($result);

					$fid = $row['fid'];
					$sql = "SELECT * FROM farmer WHERE fid = '$fid'";
					$result = mysqli_query($conn, $sql);
					$frow = mysqli_fetch_assoc($result);

					$picDestination = "images/productImages/".$row['pimage'];

					?>

					<form method="POST" action="editproduct.php" enctype="multipart/form-data">
						<h2>edit the Product Information here..!!</h2>
						<br>
				<!-- <center>
					<input type="file" name="productPic"></input>
					<br />
				</center> -->
				<div class="row">
					  <div class="col-sm-6">
						  <div class="select-wrapper" style="width: auto" >
							  <select name="type" id="type"  required style="background-color:white;color: black;">
								  <option value="<?= $row['pcat']; ?>" style="color: black;"><?= $row['pcat']; ?></option>
								  <option value="Fruit" style="color: black;">Fruit</option>
								  <option value="Vegetable" style="color: black;">Vegetable</option>
								  <option value="Grains" style="color: black;">Grains</option>
							  </select>
						</div>
					  </div>
					  <div class="col-sm-6">
						<input type="text" name="pname" id="pname" value="<?= $row['product']; ?>" placeholder="Product Name" style="background-color:white;color: black;" />
					  </div>
				</div>
				<br>
				<p>Product description</p>
				<div>
					<textarea  name="pinfo"  rows="12"><?= $row['pinfo']; ?></textarea>
				</div>
			<br>
			<div class="row">
				<div class="col-sm-6">
					  <input type="text" name="price" id="price" value="<?= $row['price']; ?>" placeholder="Price" style="background-color:white;color: black;" />
				</div>
				<div class="col-sm-6">
					  <input type="number" name="stock" id="stock" value="<?= $row['stock']; ?>" placeholder="stock" style="background-color:white;color: black;" />
				</div>

			</div>
			<div class="row">

				<div class="col-sm-12">
					<button class="button fit" style="width:auto; color:black;">Submit</button>
				</div>
			</div>
			</form>

		</div>
	</section>
    <script>
			 CKEDITOR.replace( 'pinfo' );
		</script>
</body>
</html>