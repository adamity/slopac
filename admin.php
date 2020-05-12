<?php
include 'dbconnect.php';
session_start();

if(empty($_SESSION))
{
	header('location:login.html');
}
else
{
	#NumOfBook
	$query = "SELECT COUNT(*) AS total FROM book";
	$result = mysqli_query($link,$query)or die("Query failed!");
	$data = mysqli_fetch_assoc($result);
	$numOfBook = $data['total'];

	#NumOfBorrowedBook
	$query = "SELECT COUNT(*) AS total FROM borrower";
	$result = mysqli_query($link,$query)or die("Query failed!");
	$data = mysqli_fetch_assoc($result);
	$numOfBorrowedBook = $data['total'];

	#NumOfStudent
	$query = "SELECT COUNT(*) AS total FROM member WHERE status = 'Student'";
	$result = mysqli_query($link,$query)or die("Query failed!");
	$data = mysqli_fetch_assoc($result);
	$numOfStudent = $data['total'];

	#NumOfTeacher
	$query = "SELECT COUNT(*) AS total FROM member WHERE status = 'Teacher'";
	$result = mysqli_query($link,$query)or die("Query failed!");
	$data = mysqli_fetch_assoc($result);
	$numOfTeacher = $data['total'];

	#NumOfAdmin
	$query = "SELECT COUNT(*) AS total FROM member WHERE admin_sign = 'Yes'";
	$result = mysqli_query($link,$query)or die("Query failed!");
	$data = mysqli_fetch_assoc($result);
	$numOfAdmin = $data['total'];
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
		<li><a href="borrowed.php">Borrowed Book</a></li>
		<li><a href="returned.php">Returned Book</a></li>
		<li><a href="home.php">User Dashboard</a></li>
		<li><a href="logout.php">Logout</a></li>
	</ul>

	<form action="search.php" method="get">
		<input type="text" name="search" placeholder="Search Book or Member">
		<input type="submit" name="submit" value="Search">
	</form><br>

	<fieldset>
		<legend>BOOK</legend>
		<table>
			<tr>
				<td>NUMBER OF BOOK</td>
				<td>: <?php echo $numOfBook; ?></td>
			</tr>
			<tr>
				<td>NUMBER OF BORROWED BOOK</td>
				<td>: <?php echo $numOfBorrowedBook; ?></td>
			</tr>
		</table>
	</fieldset>

	<fieldset>
		<legend>MEMBER</legend>
		<table>
			<tr>
				<td>STUDENT</td>
				<td>: <?php echo $numOfStudent; ?></td>
			</tr>
			<tr>
				<td>TEACHER</td>
				<td>: <?php echo $numOfTeacher; ?></td>
			</tr>
			<tr>
				<td colspan="2">TOTAL : <?php echo ($numOfStudent + $numOfTeacher); ?></td>
			</tr>
		</table>
	</fieldset>

	<fieldset>
		<legend>ADMIN</legend>
		<table>
			<tr>
				<td>NUMBER OF ADMIN</td>
				<td>: <?php echo $numOfAdmin; ?></td>
			</tr>
		</table>
	</fieldset>
</body>
</html>