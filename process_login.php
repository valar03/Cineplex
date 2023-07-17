<?php
include('config.php');
session_start();
$email = $_POST["Email"];
$pass = md5($_POST["Password"]);
$password = mysqli_real_escape_string($con, $pass);
$qry=mysqli_query($con,"select * from tbl_login where username='$email' and password='$password'");
if(mysqli_num_rows($qry))
{
	$usr=mysqli_fetch_array($qry);
	if($usr['user_type']==2)
	{
		$_SESSION['user']=$usr['user_id'];
		if(isset($_SESSION['show']))
		{
			header('location:seat/seat.php');
		}
		else
		{
			header('location:index.php');
		}
	}
	else
	{
		$_SESSION['error']="Login Failed!";
		header("location:login.php");
	}
	
}
else
{
	$_SESSION['error']="Login Failed!";
	header("location:login.php");
}
?>
