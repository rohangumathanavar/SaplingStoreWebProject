<?php
	session_start();
    $_SESSION['message']="";

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
            require 'menu.php';
		?>
		
		<section id="banner" class="wrapper">
            <div class="container">
                <header class="major">
                    <h2>Welcome</h2>
                </header>
                <p>
                <?php
                    if ( isset($_SESSION['message']) )
                    {
                        echo $_SESSION['message'];
                        unset( $_SESSION['message'] );
                    }
                ?>
                </p>

 
                  <h2>Hello ADMIN!</h2>

                    <div class="row uniform">
                        <div class="6u 12u$(xsmall)">
                            <a href=sellers.php class="button special">Sellers</a>
						</div>
						<div class="6u 12u$(xsmall)">
                            <a href=buyers.php class="button special">Buyers</a>
						</div>
						<div class="6u 12u$(xsmall)">
                            <a href=productlist.php class="button special">Products</a>
                        </div>
                        <div class="6u 12u$(xsmall)">
                            <a href=transactionlist.php class="button special">transactions</a>
                        </div>
                        <div class="12u 12u$(xsmall)">
                            <a href="logout.php" class="button special">LOG OUT</a>
                        </div>
                    </div>





</body>


	</html>