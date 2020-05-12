<!-- DESIGN THIS FILE -->
<?php
session_start();

if(empty($_SESSION))
{
	header('location:login.html');
}
else
{
	$name = $_SESSION['name'];
	$display = "<tr><td>MEMBER ID </td><td>: <input type='text' name='member_id' value=".$_SESSION['member_id']." readonly></td></tr>
				<tr><td>NAME </td><td>: <input type='text' name='name' value=\"$name\" readonly></td></tr>
				<tr><td>PHONE NUMBER </td><td>: <input type='number' name='phone_num' value=".$_SESSION['phone_num']." required></td></tr>
				<tr><td>IC NUMBER </td><td>: <input type='number' name='ic_num' value=".$_SESSION['ic_num']." readonly></td></tr>
				<tr><td>EMAIL </td><td>: <input type='email' name='email' value=".$_SESSION['email']." required></td></tr>
				<tr><td>DATE OF BIRTH </td><td>: <input type='date' name='dob' value=".$_SESSION['dob']." readonly></td></tr>
				<tr><td>STATUS </td><td>: <input type='text' name='status' value=".$_SESSION['status']." readonly></td></tr>
				<tr><td>ADMIN SIGN </td><td>: <input type='text' name='admin_sign' value=".$_SESSION['admin_sign']." readonly></td></tr>";

	$display2 = "<tr><td>CURRENT PASSWORD </td><td>: <input type='password' name='currPass'></td></tr>
				 <tr><td>NEW PASSWORD </td><td>: <input type='password' name='newPass'></td></tr>
				 <tr><td>CONFIRM NEW PASSWORD </td><td>: <input type='password' name='confirmNewPass'></td></tr>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>SLOPAC</title>
</head>
<body>
	<form action="update.php" method="post">
		<fieldset>
			<legend>UPDATE PROFILE</legend>
			<table>
				<?php echo $display; ?>
			</table>
		</fieldset>

		<fieldset>
			<legend>CHANGE PASSWORD</legend>
			<table>
				<?php echo $display2; ?>
			</table>
		</fieldset>

		<input type="submit" name="submit" value="Save">
		<a href="home.php">Cancel</a>
	</form>
</body>
</html>