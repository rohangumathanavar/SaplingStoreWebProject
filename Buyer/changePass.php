<?php
    session_start();
   // $name =  $_SESSION['Name'];
    $user =  $_SESSION['Username'];
    $email =  $_SESSION['Email'];
    echo"$email";
     require 'db.php';


    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
    //    $user = dataFilter($_POST['uname']);
    //    echo"$user";
        $currPass = $_POST['currPass'];
        echo"$currPass";
        $newPass = $_POST['newPass'];
        echo"$newPass";
       $conNewPass = $_POST['conNewPass'];
       echo"$conNewPass";
        $newHash = dataFilter( md5( rand(0,1000) ) );
        echo"$newHash";
    }

    $sql = "SELECT bpassword FROM buyer WHERE bname='$user'";
    //echo"$sql";
    $result = mysqli_query($conn, $sql);
    //echo"$result";
    echo"\n";
    $num_rows = mysqli_num_rows($result);
    //echo"\t";
echo"$num_rows";

    if($num_rows == 0)
    {
        $_SESSION['message'] = "Invalid User Credentials!";
        header("location: Login/error.php");
    }
   else
    {
        $User = $result->fetch_assoc();
        // $a=$User["bhash"];
        // echo"$a";
        if(password_verify($_POST['currPass'], $User['bpassword']))
        {
            if($newPass == $conNewPass)
            {
                $conNewPass = dataFilter(password_hash($_POST['conNewPass'], PASSWORD_BCRYPT));
                echo"$conNewPass";
                // $currHash = $_SESSION['bhash'];
                // echo"$currHash";
                $sql = "UPDATE buyer SET bpassword='$conNewPass', bhash='$newHash' WHERE bemail='$email'";
                echo"$sql";
               $result = mysqli_query($conn, $sql);

                if($result)
                {
                    $_SESSION['message'] = "Password changed Successfully!";
                    header("location: Login/success.php");
                }
                else
                {
                    $_SESSION['message'] = "Error occurred while changing password<br>Please try again!";
                    header("location: Login/error.php");
                }
            }
        }
        else
        {
            $_SESSION['message'] = "Invalid current User Credentials!";
            header("location: Login/error.php");
        }
    }

    function dataFilter($data)
    {
    	$data = trim($data);
     	$data = stripslashes($data);
    	$data = htmlspecialchars($data);
      	return $data;
    }

?>
