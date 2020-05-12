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
		$display = "<tr><th>BOOK ACCESSION NUMBER</th><th>BORROW DATE</th><th>RETURN DATE</th><th>RETURN TIMESTAMP</th><th>TOTAL FINE</th></tr>";

		while($row = mysqli_fetch_array($result))
		{
			$accession_num = $row['accession_num'];
			$borrow_date = $row['borrow_date'];
			$return_date = $row['return_date'];
			$timestamp = $row['timestamp'];
			$total_fine = $row['total_fine'];

			$display = $display . "<tr><td>".$accession_num."</td><td>".$borrow_date."</td><td>".$return_date."</td><td>".$timestamp."</td><td>".$total_fine."</td></tr>";
		}

		mysqli_free_result($result);
	}
	else
	{
		$display = "<tr><td>No Record Found</td></tr>";
		mysqli_free_result($result);
	}

	$query = "SELECT * FROM borrower WHERE member_id = '$member_id'";
	$result = mysqli_query($link,$query)or die("Query failed!");

	if(mysqli_num_rows($result)>0)
	{
		$display2 = "<tr><th>BOOK ACCESSION NUMBER</th><th>BORROW DATE</th><th>RETURN DATE</th><th>FINE TO PAY (RM)</th></tr>";

		while($row = mysqli_fetch_array($result))
		{
			$accession_num = $row['accession_num'];
			$borrow_date = $row['borrow_date'];
			$return_date = $row['return_date'];

			$now = time();
			$return = strtotime($return_date);
			$diff = $now - $return;
			$days = round($diff / (60 * 60 * 24));
			$total = $days * 0.20;
			$fine = number_format((float)$total, 2, '.', '');

			if($fine < 0.20)
			{
				$fine = 0.00;
			}

			$display2 = $display2 . "<tr><td>".$accession_num."</td><td>".$borrow_date."</td><td>".$return_date."</td><td>".$fine."</td></tr>";
		}

		mysqli_free_result($result);
	}
	else
	{
		$display2 = "<tr><td>No Record Found</td></tr>";
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
		<legend>FINE LOG</legend>
		<table>
			<?php echo $display2; ?>
		</table>
	</fieldset>

	<fieldset>
		<legend>PAID LOG</legend>
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