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
        $pid=$_POST['pid'];
  

        $sql="DELETE FROM fproduct where pid='$pid';";
        

        $result = mysqli_query($conn, $sql);
        if($result)
        {
            echo "product deleted successfully !!!";
            $_SESSION['message'] = "product deleted successfully !!!";
        }
        else
        {
            echo "There was an error in deleting the product! Please Try again!";
            $_SESSION['message'] = "There was an error in deleting the product! Please Try again!";
        }


    }

?>

<?php
            require 'menu.php';

            $sql="SELECT * FROM transaction ;";
            $result = mysqli_query($conn, $sql);

        ?> 

		<section id="banner" class="wrapper">
            <div class="container">
                <header class="major">
                    <h2>Transaction List</h2>
                </header>
                <?php
?>
<table class="table">
<thead>
<tr >
        <th style="color:white"> transaction id</th>
        <th style="color:white"> buyer id</th>
        <th style="color:white">product it</th>
        <th style="color:white">name</th>
        <th style="color:white">mobile</th>
        <th style="color:white">email</th>
        <th style="color:white">Address</th>
        <th style="color:white">pincode</th>






        
    </tr>
</thead>
<tbody>
<?php

while($row = $result->fetch_array()):
?>
    <tr>
        <td>
        <?php echo $row['tid'].'';?>
        </td>
        <td>
        <?php echo $row['bid'].'';?>
        </td>
        <td>
        <?php echo $row['pid'].'';?>
        </td>            
        <td>
        <?php echo $row['name'].'';?>
        </td>
        <td>
        <?php echo $row['mobile'].'';?>
        </td>
        <td>
        <?php echo $row['email'].'';?>
        </td>
        <td>
        <?php echo $row['addr'].'';?>
        </td>
        <td>
        <?php echo $row['pincode'].'';?>
        </td>
            

    </tr>

    						<?php endwhile;	?>

</tbody>
</table>

      

            </div>
 


</body>


	</html>