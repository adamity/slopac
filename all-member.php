<?php
include 'dbconnect.php';
session_start();

if(empty($_SESSION))
{
	header('location:login.html');
}
else
{
	$query = "SELECT * FROM member";
	$result = mysqli_query($link,$query)or die("Query failed!");

	if(mysqli_num_rows($result)>0)
	{
		$display = "<tr><th>MEMBER ID</th><th>NAME</th><th>PHONE NUMBER</th><th>EMAIL</th></tr>";

		while($row = mysqli_fetch_array($result))
		{
			$member_id = $row['member_id'];
			$name = $row['name'];
			$phone_num = $row['phone_num'];
			$email = $row['email'];

			$display = $display . "<tr><td>".$member_id."</td><td>".$name."</td><td>".$phone_num."</td><td>".$email."</td></tr>";
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>SLOPAC</title>
</head>
<body>
	<h1>School Library Online Public Access Catalogue</h1>
	<ul>
		<li><a href="admin.php">Admin Home</a></li>
		<li><a href="all-book.php">All Book</a></li>
		<li><a href="all-member.php">All Member</a></li>
		<li><a href="borrow-return.php">Borrow & Return</a></li>
		<li><a href="#">Borrowed Book</a></li>
		<li><a href="#">Returned Book</a></li>
		<li><a href="home.php">User Dashboard</a></li>
		<li><a href="logout.php">Logout</a></li>
	</ul>

	<form action="search.php" method="get">
		<input type="text" name="search" placeholder="Search Book or Member">
		<input type="submit" name="submit" value="Search">
	</form><br>

	<fieldset>
		<legend>MEMBER</legend>
		<table>
			<?php echo $display; ?>
		</table>
	</fieldset>
</body>
</html>