<?php
include "dbconnect.php";
session_start();

if(isset($_POST['submit']))
{
	$member_id = $_POST['member_id'];
	$password = $_POST['password'];

	$query = "SELECT * FROM member WHERE member_id = '$member_id' AND password = '$password'";
	$result = mysqli_query($link,$query)or die("Query failed!");

	if(mysqli_num_rows($result)>0)
	{
		$info = mysqli_fetch_array($result);

		$_SESSION['member_id'] = $info['member_id'];

		mysqli_free_result($result);
		mysqli_close($link);
		header('location:home.php');
	}
	else
	{
		mysqli_free_result($result);
		mysqli_close($link);
		header('location:login.html');
	}
}
else
{
	header('location:login.html');
}
?>