<?php
include 'dbconnect.php';
session_start();

if(isset($_POST['submit']))
{
	$member_id = $_POST['member_id'];
	$phone_num = $_POST['phone_num'];
	$email = $_POST['email'];

	$currPass = $_POST['currPass'];
	$newPass = $_POST['newPass'];
	$confirmNewPass = $_POST['confirmNewPass'];

	$message = "";

	if($currPass=="" && $newPass=="" && $confirmNewPass=="")
	{
		$query = "UPDATE member SET phone_num = '$phone_num', email = '$email' WHERE member_id = '$member_id'";
		$result = mysqli_query($link,$query)or die("Query failed!");

		if($result)
		{
			mysqli_free_result($result);
			mysqli_close($link);
			header('location:home.php');
		}
		else
		{
			mysqli_free_result($result);
			mysqli_close($link);
			echo "Problem Occurred! <a href='login.html'>Go to Login Page<a>";
		}
	}
	else
	{
		$query = "SELECT password FROM member WHERE member_id = '$member_id'";
		$result = mysqli_query($link,$query)or die("Query failed!");

		$info = mysqli_fetch_array($result);
		$correctPassword = $info['password'];

		if(strcmp($currPass, $correctPassword)==0)
		{
			if(strcmp($newPass, $confirmNewPass)==0 && $newPass!="")
			{
				$query = "UPDATE member SET password = '$newPass', phone_num = '$phone_num', email = '$email' WHERE member_id = '$member_id'";
				$result = mysqli_query($link,$query)or die("Query failed!");

				if($result)
				{
					mysqli_free_result($result);
					mysqli_close($link);
					header('location:home.php');
				}
				else
				{
					mysqli_free_result($result);
					mysqli_close($link);
					echo "Problem Occurred! <a href='login.html'>Go to Login Page<a>";
				}
			}
			else
			{
				mysqli_free_result($result);
				mysqli_close($link);
				
				$message = "New Password & Confirm New Password Do Not Match! Do Not Fill Change Password If You Do Not Want To Change Password.";
				echo "<script language='javascript'>alert('".$message."');
					  window.location.href = 'update-profile.php';</script>";
			}
		}
		else
		{
			mysqli_free_result($result);
			mysqli_close($link);

			$message = "Current Password Incorrect! Please Recheck Your Current Password. Do Not Fill Change Password If You Do Not Want To Change Password.";
			echo "<script language='javascript'>alert('".$message."');
				  window.location.href = 'update-profile.php';</script>";
		}
	}
}
else
{
	header('location:home.php');
}
?>