<?php
	session_start();
	require 'db.php';
    $pid = $_GET['pid'];
    $order1=$_GET['order1'];
   
    //echo"$order1";
    if($_SERVER['REQUEST_METHOD'] == "POST")
    { 
        //echo"$order1";
        $name = $_POST['name'];
        $city = $_POST['city'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $pincode = $_POST['pincode'];
        $addr = $_POST['addr'];
        $bid = $_SESSION['id'];
        $sql = "SELECT stock from fproduct where pid='$pid';";
        //echo"$sql";
        $result = mysqli_query($conn, $sql);
        $User = $result->fetch_assoc();
        $a=$User['stock'];
        $a=$a-$order1;
        $sql="UPDATE fproduct set stock='$a' where pid='$pid' ";
        $result = mysqli_query($conn, $sql);



        $sql = "INSERT INTO transaction (bid, pid, name, city, mobile, email, pincode, addr)
                VALUES ('$bid', '$pid', '$name', '$city', '$mobile', '$email', '$pincode', '$addr')";
        $result = mysqli_query($conn, $sql);
        if($result)
        {
            $_SESSION['message'] = "Order Succesfully placed! <br /> Thanks for shopping with us!!!";
            header('Location: Login/success.php');
        }
        else {
            echo $result->mysqli_error();
            //$_SESSION['message'] = "Sorry!<br />Order was not placed";
            //header('Location: Login/error.php');
        }
    }
?>