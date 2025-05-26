<?php
session_start();
include('includes/config.php');
if(isset($_POST['signin']))
{
	$email=$_POST['email'];
	$password=md5($_POST['password']);

	$sql ="SELECT * FROM register where email ='$email' AND password ='$password'";
	$query= mysqli_query($conn, $sql);
	$count = mysqli_num_rows($query);
	if($count > 0)
	{
		while ($row = mysqli_fetch_assoc($query)) {
		   $_SESSION['alogin']=$row['user_ID'];
            header("Location: notebook.php");
            exit();
    
        }
    } else {
        // Handle if email or password is not set
        echo "<script>alert('Please provide both email and password');</script>";
    }
}
?>

