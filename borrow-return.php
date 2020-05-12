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

	<form action="book-process.php" method="post">
		<fieldset>
			<legend>BORROW BOOK & RETURN BOOK</legend>
			<table>
				<tr>
					<td>MEMBER ID </td>
					<td>: <input type="text" name="member_id" required></td>
				</tr>
				<tr>
					<td>BOOK ACCESSION NUMBER </td>
					<td>: <input type="text" name="accession_num" required></td>
				</tr>
				<tr>
					<td>ACTION </td>
					<td>: 
						<input type="radio" name="action" value="Borrow" required>Borrow Book
						<input type="radio" name="action" value="Return">Return Book
					</td>
				</tr>
				<tr>
					<td>NUMBER OF DAY </td>
					<td>: 
						<input type="number" name="numOfDay">
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Next">
						<input type="reset" value="Clear">
					</td>
				</tr>
			</table>
		</fieldset>
	</form>
</body>
</html>