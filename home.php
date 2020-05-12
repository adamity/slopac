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

	$query = "SELECT * FROM member WHERE member_id = '$member_id'";
	$result = mysqli_query($link,$query)or die("Query failed!");

	if(mysqli_num_rows($result)>0)
	{
		$info = mysqli_fetch_array($result);

		$_SESSION['name'] = $info['name'];
		$_SESSION['phone_num'] = $info['phone_num'];
		$_SESSION['ic_num'] = $info['ic_num'];
		$_SESSION['email'] = $info['email'];
		$_SESSION['dob'] = $info['dob'];
		$_SESSION['status'] = $info['status'];
		$_SESSION['admin_sign'] = $info['admin_sign'];

		$displayInfo = "<tr><td>MEMBER ID </td><td>: ".$_SESSION['member_id']."</td></tr>
						<tr><td>NAME </td><td>: ".$_SESSION['name']."</td></tr>
						<tr><td>PHONE NUMBER </td><td>: ".$_SESSION['phone_num']."</td></tr>
						<tr><td>IC NUMBER </td><td>: ".$_SESSION['ic_num']."</td></tr>
						<tr><td>EMAIL </td><td>: ".$_SESSION['email']."</td></tr>
						<tr><td>DATE OF BIRTH </td><td>: ".$_SESSION['dob']."</td></tr>
						<tr><td>STATUS </td><td>: ".$_SESSION['status']."</td></tr>";

		mysqli_free_result($result);
	}
	else
	{
		echo "Problem Occurred! <a href='login.html'>Go to Login Page<a>";
		mysqli_free_result($result);
	}

	$queryBorrow = "SELECT * FROM borrower WHERE member_id = '$member_id'";
	$resultBorrow = mysqli_query($link,$queryBorrow)or die("Query failed!");

	if(mysqli_num_rows($resultBorrow)>0)
	{
		$display = "<tr><th>BOOK TITLE</th><th>BORROW DATE</th><th>RETURN DATE</th></tr>";

		while($row = mysqli_fetch_array($resultBorrow))
		{
			$accession_num = $row['accession_num'];
			$borrow_date = $row['borrow_date'];
			$return_date = $row['return_date'];

			$queryBook = "SELECT title FROM book WHERE accession_num = '$accession_num'";
			$resultBook = mysqli_query($link,$queryBook)or die("Query failed!");

			$info = mysqli_fetch_array($resultBook);

			$title = $info['title'];

			$display = $display . "<tr><td>".$title."</td><td>".$borrow_date."</td><td>".$return_date."</td></tr>";
		}

		mysqli_free_result($resultBorrow);
		mysqli_free_result($resultBook);
	}
	else
	{
		$display = "<tr><td>No Record Found</td></tr>";
		mysqli_free_result($resultBorrow);
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
		<legend>MY PROFILE</legend>
		<table>
			<?php echo $displayInfo; ?>
			<tr>
				<td colspan="2"><a href="update-profile.php">Update Profile</a></td>
			</tr>
		</table>
	</fieldset>

	<fieldset>
		<legend>BORROWED BOOK</legend>
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