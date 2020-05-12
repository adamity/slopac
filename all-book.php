<?php
include 'dbconnect.php'; 
session_start();

if(empty($_SESSION))
{
	header('location:login.html');
}
else
{
	$query = "SELECT * FROM book";
	$result = mysqli_query($link,$query)or die("Query failed!");

	if(mysqli_num_rows($result)>0)
	{
		$display = "<tr><th>TITLE</th><th>AUTHOR</th><th>PUBLISHER</th><th>ACTION</th></tr>";

		while($row = mysqli_fetch_array($result))
		{
			$title = $row['title'];
			$author = $row['author'];
			$publisher = $row['publisher'];
			$accession_num = $row['accession_num'];

			$display = $display . "<tr><td>".$title."</td><td>".$author."</td><td>".$publisher."</td><td><a href='delete-book.php?accession_num=".$accession_num."'>Delete</a></td></tr>";
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
		<li><a href="borrowed.php">Borrowed Book</a></li>
		<li><a href="returned.php">Returned Book</a></li>
		<li><a href="home.php">User Dashboard</a></li>
		<li><a href="logout.php">Logout</a></li>
	</ul>

	<form action="search.php" method="get">
		<input type="text" name="search" placeholder="Search Book or Member">
		<input type="submit" name="submit" value="Search">
	</form><br>

	<a href="add-book.php">Add Book</a><br><br>

	<fieldset>
		<legend>BOOK</legend>
		<table>
			<?php echo $display; ?>
		</table>
	</fieldset>
</body>
</html>