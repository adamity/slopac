<!-- DESIGN THIS FILE -->
<?php
include 'dbconnect.php';
session_start();

if(empty($_SESSION))
{
	header('location:login.html');
}
else
{
	$member_id = $_SESSION['member_id'];

	$query = "SELECT * FROM returner WHERE member_id = '$member_id'";
	$result = mysqli_query($link,$query)or die("Query failed!");

	if(mysqli_num_rows($result)>0)
	{
		$display = "<tr><th>ACCESSION NUMBER</th><th>ISBN NUMBER</th><th>TITLE</th><th>EDITION</th><th>AUTHOR</th><th>PUBLISHER</th><th>COUNTRY</th><th>PUBLISH YEAR</th><th>BORROW DATE</th><th>RETURN DATE</th></tr>";

		while($row = mysqli_fetch_array($result))
		{
			$accession_num = $row['accession_num'];
			$borrow_date = $row['borrow_date'];
			$timestamp = $row['timestamp'];

			$queryBook = "SELECT * FROM book WHERE accession_num = '$accession_num'";
			$resultBook = mysqli_query($link,$queryBook)or die("Query failed!");

			$info = mysqli_fetch_array($resultBook);

			$accession_num = $info['accession_num'];
			$isbn_num = $info['isbn_num'];
			$title = $info['title'];
			$edition = $info['edition'];
			$author = $info['author'];
			$publisher = $info['publisher'];
			$country = $info['country'];
			$publish_year = $info['publish_year'];

			$display = $display . "<tr><td>".$accession_num."</td><td>".$isbn_num."</td><td>".$title."</td><td>".$edition."</td><td>".$author."</td><td>".$publisher."</td><td>".$country."</td><td>".$publish_year."</td><td>".$borrow_date."</td><td>".$timestamp."</td></tr>";
		}

		mysqli_free_result($result);
		mysqli_free_result($resultBook);
	}
	else
	{
		$display = "<tr><td>No Record Found</td></tr>";
		mysqli_free_result($result);
	}

	mysqli_close($link);
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
		<li><a href="home.php">My Profile</a></li>
		<li><a href="borrowed-history.php">Borrowed Book History</a></li>
		<li><a href="fine-log.php">Logs</a></li>
		<div id="admin_sign"><li><a href="admin.php">Admin Dashboard</a></li></div>
		<li><a href="logout.php">Logout</a></li>
	</ul>

	<form action="search-book.php" method="get">
		<input type="text" name="search" placeholder="Search Book">
		<input type="submit" name="submit" value="Search">
	</form><br>

	<fieldset>
		<legend>BORROWED HISTORY</legend>
		<table>
			<?php echo $display; ?>
		</table>
	</fieldset>

	<script type="text/javascript">
		var x = document.getElementById("admin_sign");
		var admin = "<?php echo $_SESSION['admin_sign']; ?>";

		if(admin == "Yes")
		{
			x.style.display = "block";
		}
		else
		{
			x.style.display = "none";
		}
	</script>
</body>
</html>