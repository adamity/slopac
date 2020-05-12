<!DOCTYPE html>
<html>
<head>
	<title>SLOPAC</title>
</head>
<body>
	<h1>School Library Online Public Access Catalogue</h1>
	<form action="new-book.php" method="post">
		<fieldset>
			<legend>ADD BOOK</legend>
			<table>
				<tr>
					<td>Accession Number </td>
					<td>: <input type="text" name="accession_num" required></td>
				</tr>
				<tr>
					<td>ISBN Number </td>
					<td>: <input type="text" name="isbn_num" required></td>
				</tr>
				<tr>
					<td>Title </td>
					<td>: <input type="text" name="title" required></td>
				</tr>
				<tr>
					<td>Edition </td>
					<td>: <input type="number" name="edition" required></td>
				</tr>
				<tr>
					<td>Author </td>
					<td>: <input type="text" name="author" required></td>
				</tr>
				<tr>
					<td>Publisher </td>
					<td>: <input type="text" name="publisher" required></td>
				</tr>
				<tr>
					<td>Country </td>
					<td>: <input type="text" name="country" required></td>
				</tr>
				<tr>
					<td>Publish Year </td>
					<td>: <input type="number" name="year" required></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add New Book">
						<input type="reset" value="Clear">
						<input type="button" onclick="window.location.href = 'all-book.php'" value="Cancel">
					</td>
				</tr>
			</table>
		</fieldset>
	</form>
</body>
</html>