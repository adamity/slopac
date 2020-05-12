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
	if(isset($_GET['search']))
	{
		$search = $_GET['search'];

		$query = "SELECT * FROM book WHERE accession_num LIKE '%$search%' OR isbn_num LIKE '%$search%' OR title LIKE '%$search%' OR edition LIKE '%$search%' OR author LIKE '%$search%' OR publisher LIKE '%$search%' OR country LIKE '%$search%' OR publish_year LIKE '%$search%'";
		$result = mysqli_query($link,$query)or die("Query failed!");

		if(mysqli_num_rows($result)>0)
		{
			$display = "<tr><th>ACCESSION NUMBER</th><th>ISBN NUMBER</th><th>TITLE</th><th>EDITION</th><th>AUTHOR</th><th>PUBLISHER</th><th>COUNTRY</th><th>PUBLISH YEAR</th></tr>";

			while($row = mysqli_fetch_array($result))
			{
				$accession_num = $row['accession_num'];
				$isbn_num = $row['isbn_num'];
				$title = $row['title'];
				$edition = $row['edition'];
				$author = $row['author'];
				$publisher = $row['publisher'];
				$country = $row['country'];
				$publish_year = $row['publish_year'];

				$display = $display . "<tr><td>".$accession_num."</td><td>".$isbn_num."</td><td>".$title."</td><td>".$edition."</td><td>".$author."</td><td>".$publisher."</td><td>".$country."</td><td>".$publish_year."</td></tr>";
			}

			mysqli_free_result($result);
		}
		else
		{
			$display = "<tr><td>No Record Found</td></tr>";
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

	<p>Result for Search Keyword : <?php echo $search; ?></p><br>

	<fieldset>
		<legend>BOOKS</legend>
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