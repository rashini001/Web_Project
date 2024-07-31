<?php

//delete reservations

if(isset($_POST['delete-submit']))
{
	require 'db.con.php';

	$reservation_id = $_POST['reserv_id'];
	$sql = "DELETE FROM reservations WHERE reserv_id =$reservation_id";

	if(mysqli_query($con,$sql))
	{
		 header("Location: ../view_reservations.php?delete=success");
	}
	else
	{
		header("Location: ../view_reservations.php?delete=error");
	}
	 mysqli_close($con);
}

//delete tables

if(isset($_POST['delete-table']))
{
	require 'db.con.php';

	$tables_id = $_POST['tables_id'];
    $sql = "DELETE FROM tables WHERE tables_id =$tables_id";

    if(mysqli_query($con, $sql))
    {
    	header("Location: ../view_tables.php?delete=success");
    }
    else
    {
    	header("Location: ../view_tables.php?delete=error");
    }
     mysqli_close($con); 
}
 
?>