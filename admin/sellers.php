<?php
    session_start();
	require 'db.php';

    if ( $_SESSION['logged_in'] != 1 )
    {
      $_SESSION['message'] = "You must log in before viewing your profile page!";
      header("location: error.php");
	}
	?>
<!DOCTYPE html>
    <html >
     <head>
        <title>AgroCulture</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="../bootstrap\css\bootstrap.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="../bootstrap\js\bootstrap.min.js"></script>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="../js/jquery.min.js"></script>
		<script src="../js/skel.min.js"></script>
		<script src="../js/skel-layers.min.js"></script>
		<script src="../js/init.js"></script>
		<link rel="stylesheet" href="../css/skel.css" />
		<link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="../css/style-xlarge.css" />

	</head>
	
<body>
	


<?php
 if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $fid=$_POST['fid'];
  

        $sql="DELETE FROM farmer where fid='$fid';";
        

        $result = mysqli_query($conn, $sql);
        if($result)
        {
            echo "Profile deleted successfully !!!";
            $_SESSION['message'] = "Profile deleted successfully !!!";
        }
        else
        {
            echo "There was an error in deleting your profile! Please Try again!";
            $_SESSION['message'] = "There was an error in deleting your profile! Please Try again!";
        }
        $sql="DELETE FROM fproduct where fid='$fid';";
        

        $result = mysqli_query($conn, $sql);

    }

?>

<?php
            require 'menu.php';

            $sql="SELECT * FROM farmer;";
            $result = mysqli_query($conn, $sql);

        ?> 

		<section id="banner" class="wrapper">
            <div class="container">
                <header class="major">
                    <h2>Sellers List</h2>
                </header>
                <?php
?>

 <!-- table-hover,table-bordered,table-condensed  -->
<div class="table-responsive ">
<table class="table table-responsive">   
<thead>
<tr >
        <th style="color:white" scope="col" > id</th>
        <th style="color:white" scope="col" >name</th>
        <th style="color:white" scope="col">action</th>
        <th style="color:white" scope="col">action</th>
        <th style="color:white" scope="col">action</th>

    </tr>
</thead>
<tbody>
<?php

while($row = $result->fetch_array()):
?>
    <tr>
        <td>
<?php echo $row['fid'].'';?>
        </td>
        <td><?php echo $row['fname'].'';?></td>
        <td>
            <a href="profileview.php?fid=<?php echo $row['fid'] ;?>">
            <button>view profile</button></a>
        </td>

        <td>            
            <a href="productmenu.php?fid=<?php echo $row['fid'] ;?>">
            <button>view products</button></a>
        </td>
        <td>
            <form action="sellers.php" method="POST">
                <button style="color:green" value="<?php echo $row['fid'] ;?> " name="fid" type="submit">delete</button>
            </form>
            
            </td>

    </tr>

    						<?php endwhile;	?>

</tbody>
</table>
</div>

      

            </div>
 


</body>


	</html>