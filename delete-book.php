<?php
include 'dbconnect.php';
session_start();

if(isset($_GET['accession_num']))
{
	$delete_book = $_GET['accession_num'];

	$query = "DELETE FROM book WHERE accession_num = '$delete_book'";
	$result = mysqli_query($link,$query);

	if($result)
	{
		header('location:all-book.php');
	}
	else
	{
		echo "Problem occured! <a href='all-book.php'>Back</a>";
	}
}
else
{
	header('location:home.php');
}
?>