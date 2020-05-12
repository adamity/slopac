<?php
include 'dbconnect.php';
session_start();

if(isset($_POST['submit']))
{
	$member_id = $_POST['member_id'];
	$accession_num = $_POST['accession_num'];
	$numOfDay = $_POST['numOfDay'];
	$action = $_POST['action'];

	if($action === 'Borrow')
	{
		$query = "SELECT COUNT(*) AS total FROM borrower WHERE member_id = '$member_id'";
		$result = mysqli_query($link,$query)or die("Query failed!");
		$data = mysqli_fetch_assoc($result);
		$numOfBorrowedBook = $data['total'];

		echo "Admin Choose Borrow Book Process<br>Number Of Borrowed Book : ".$numOfBorrowedBook."<br>";

		if($numOfBorrowedBook < 5)
		{
			if($numOfDay > 0)
			{
				$days = "+".$numOfDay." days";
				$borrow_date = date("Y-m-d");
				$return_date = date("Y-m-d",strtotime($days));
				$query = "INSERT INTO borrower(member_id,accession_num,borrow_date,return_date) VALUES ('$member_id','$accession_num','$borrow_date','$return_date')";
				$result = mysqli_query($link,$query)or die("Query failed!");

				if($result)
				{
					echo "Borrow Book Successful!<br>Return Date : ".$return_date."<br><a href='borrow-return.php'>Back</a>";
				}
				else
				{
					echo "Borrow Book Not Successful! <a href='borrow-return.php'>Back</a>";
				}
			}
			else
			{
				echo "Please Check Your Number Of Day <a href='borrow-return.php'>Back</a>'";
			}
		}
		else
		{
			echo "Sorry, Member Can Borrow Maximum 5 Book At A Time <a href='admin.php'>Back</a>";
		}
	}
	else if($action === 'Return')
	{
		$query = "SELECT * FROM borrower WHERE member_id = '$member_id' AND accession_num = '$accession_num'";
		$result = mysqli_query($link,$query)or die("Query failed!");

		if(mysqli_num_rows($result)>0)
		{
			$row = mysqli_fetch_array($result);

			$borrowId = $row['member_id'];
			$accessionNum = $row['accession_num'];
			$bDate = $row['borrow_date'];
			$rDate = $row['return_date'];

			$now = time();
			$return = strtotime($rDate);
			$diff = $now - $return;
			$days = round($diff / (60 * 60 * 24));
			$total = $days * 0.20;
			$fine = number_format((float)$total, 2, '.', '');

			if($fine < 0.20)
			{
				$fine = 0.00;
			}

			$query = "INSERT INTO returner(member_id,accession_num,borrow_date,return_date,total_fine) VALUES ('$borrowId','$accessionNum','$bDate','$rDate','$fine')";
			$result = mysqli_query($link,$query)or die("Query failed!");

			if($result)
			{
				$query = "DELETE FROM borrower WHERE member_id = '$member_id' AND accession_num = '$accession_num'";
				$result = mysqli_query($link,$query)or die("Query failed!");

				echo "Total Fine to Pay : RM".$fine."<br>Return Book Successful! <a href='borrow-return.php'>Back</a>";
			}
		}
		else
		{
			echo "Return Book Not Successful! <a href='borrow-return.php'>Back</a>";
		}
	}
	else
	{
		header('location:login.html');
	}
}
else
{
	header('location:login.html');
}
?>