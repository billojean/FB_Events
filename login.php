
<?php
include("connect.php");

if(!empty($_POST['user']) && !empty($_POST['pass'])) {
	$user=$_POST['user'];
	$pass=$_POST['pass'];

	$query=mysqli_query($conn,"SELECT * FROM `admin` WHERE `username`= '$user' ");
	
	$row=mysqli_fetch_assoc($query);
	
	$dbusername=$row['username'];
	$dbpassword=$row['password'];
	

	if($user == $dbusername && $pass == $dbpassword)
	{
	
	header("Location: control.php");
	}
	if($user != $dbusername || $pass != $dbpassword )
	{
	echo "Invalid username or password!";
	}
	

} else {
	echo "All fields are required!";
}

?>
