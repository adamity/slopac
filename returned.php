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

		$query = "SELECT * FROM returner WHERE member_id LIKE '%$search%' OR accession_num LIKE '%$search%' OR borrow_date LIKE '%$search%' OR return_date LIKE '%$search%'";
		$result = mysqli_query($link,$query)or die("Query failed!");

		if(mysqli_num_rows($result)>0)
		{
			$displayBook = "<tr><th>MEMBER ID</th><th>ACCESSION NUMBER</th><th>BORROW DATE</th><th>RETURN DATE</th><th>TOTAL FINE</th><th>RETURN TIMESTAMP</th></tr>";

			while($row = mysqli_fetch_array($result))
			{
				$member_id = $row['member_id'];
				$accession_num = $row['accession_num'];
				$borrow_date = $row['borrow_date'];
				$return_date = $row['return_date'];
				$total_fine = $row['total_fine'];
				$timestamp = $row['timestamp'];

				$displayBook = $displayBook . "<tr><td>".$member_id."</td><td>".$accession_num."</td><td>".$borrow_date."</td><td>".$return_date."</td><td>".$total_fine."</td><td>".$timestamp."</td></tr>";
			}

			mysqli_free_result($result);
		}
		else
		{
			$displayBook = "<tr><td>No Record Found</td></tr>";
			mysqli_free_result($result);
		}

		mysqli_close($link);
	}
	else
	{
		$query = "SELECT * FROM returner";
		$result = mysqli_query($link,$query)or die("Query failed!");

		if(mysqli_num_rows($result)>0)
		{
			$displayBook = "<tr><th>MEMBER ID</th><th>ACCESSION NUMBER</th><th>BORROW DATE</th><th>RETURN DATE</th><th>TOTAL FINE</th><th>RETURN TIMESTAMP</th></tr>";

			while($row = mysqli_fetch_array($result))
			{
				$member_id = $row['member_id'];
				$accession_num = $row['accession_num'];
				$borrow_date = $row['borrow_date'];
				$return_date = $row['return_date'];
				$total_fine = $row['total_fine'];
				$timestamp = $row['timestamp'];

				$displayBook = $displayBook . "<tr><td>".$member_id."</td><td>".$accession_num."</td><td>".$borrow_date."</td><td>".$return_date."</td><td>".$total_fine."</td><td>".$timestamp."</td></tr>";
			}

			mysqli_free_result($result);
		}
		else
		{
			$displayBook = "<tr><td>No Record Found</td></tr>";
			mysqli_free_result($result);
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

	<form action="borrowed.php" method="get">
		<input type="text" name="search" placeholder="Search Borrowed">
		<input type="submit" name="submit" value="Search">
	</form><br>

	<fieldset>
		<legend>BORROWED BOOK</legend>
		<table>
			<?php echo $displayBook; ?>
		</table>
	</fieldset>
</body>
</html>