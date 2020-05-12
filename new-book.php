<?php
include 'dbconnect.php';
session_start();

if(isset($_POST['submit']))
{
	$accession_num = $_POST['accession_num'];
	$isbn_num = $_POST['isbn_num'];
	$title = $_POST['title'];
	$edition = $_POST['edition'];
	$author = $_POST['author'];
	$publisher = $_POST['publisher'];
	$country = $_POST['country'];
	$year = $_POST['year'];

	$query = "INSERT INTO book(accession_num,isbn_num,title,edition,author,publisher,country,publish_year) VALUES ('$accession_num','$isbn_num','$title','$edition','$author','$publisher','$country','$year')";

	$result = mysqli_query($link,$query)or die("Query failed!");

	if($result)
	{
		echo "Insert New Book Successful! <a href='add-book.php'>Back</a><br>";
	}
	else
	{
		echo "Insert New Book Not Successful! <a href='add-book.php'>Back</a><br>";
	}

	echo "accession_num = ".$accession_num."
	<br>isbn_num = ".$isbn_num."
	<br>title = ".$title."
	<br>edition = ".$edition."
	<br>author = ".$author."
	<br>publisher = ".$publisher."
	<br>country = ".$country."
	<br>year = ".$year;
}
else
{
	header('location:login.html');
}
?>