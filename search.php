<?php
include 'dbconnect.php';
session_start();

if(empty($_SESSION))
{
	header('location:login.html');
}
else
{
	if(isset($_GET['search']))
	{
		$search = $_GET['search'];

		$query = "SELECT * FROM book WHERE accession_num LIKE '%$search%' OR isbn_num LIKE '%$search%' OR title LIKE '%$search%' OR edition LIKE '%$search%' OR author LIKE '%$search%' OR publisher LIKE '%$search%' OR country LIKE '%$search%' OR publish_year LIKE '%$search%'";
		$result = mysqli_query($link,$query)or die("Query failed!");

		if(mysqli_num_rows($result)>0)
		{
			$displayBook = "<tr><th>TITLE</th><th>AUTHOR</th><th>PUBLISHER</th><th>ACTION</th></tr>";

			while($row = mysqli_fetch_array($result))
			{
				$title = $row['title'];
				$author = $row['author'];
				$publisher = $row['publisher'];

				$displayBook = $displayBook . "<tr><td>".$title."</td><td>".$author."</td><td>".$publisher."</td><td><a href='#'>View</a></td></tr>";
			}

			mysqli_free_result($result);
		}
		else
		{
			$displayBook = "<tr><td>No Record Found</td></tr>";
			mysqli_free_result($result);
		}

		$query = "SELECT * FROM member WHERE member_id LIKE '%$search%' OR name LIKE '%$search%' OR phone_num LIKE '%$search%' OR ic_num LIKE '%$search%' OR email LIKE '%$search%' OR status LIKE '%$search%' OR admin_sign LIKE '%$search%'";
		$result = mysqli_query($link,$query)or die("Query failed!");

		if(mysqli_num_rows($result)>0)
		{
			$displayMember = "<tr><th>MEMBER ID</th><th>NAME</th><th>PHONE NUMBER</th><th>EMAIL</th></tr>";

			while($row = mysqli_fetch_array($result))
			{
				$member_id = $row['member_id'];
				$name = $row['name'];
				$phone_num = $row['phone_num'];
				$email = $row['email'];

				$displayMember = $displayMember . "<tr><td>".$member_id."</td><td>".$name."</td><td>".$phone_num."</td><td>".$email."</td></tr>";
			}

			mysqli_free_result($result);
		}
		else
		{
			$displayMember = "<tr><td>No Record Found</td></tr>";
			mysqli_free_result($result);
		}

		mysqli_close($link);
	}
	else
	{
		header('location:home.php');
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
		<legend>BOOK</legend>
		<table>
			<?php echo $displayBook; ?>
		</table>
	</fieldset><br>

	<fieldset>
		<legend>MEMBER</legend>
		<table>
			<?php echo $displayMember; ?>
		</table>
	</fieldset>
</body>
</html>