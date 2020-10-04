<?php

//action.php

include('database_connection.php');

if(isset($_POST["action"]))
{
	if ($_POST['role'] == "admin"){
		$role = 1;
	}else{
		$role = 0;
	}
	if ($_POST['status']){
		$status = 1;
	}else{
		$status = 0;
	}
	if($_POST["action"] == "insert")
	{
			$query = "
			INSERT INTO tbl_sample (first_name, last_name,role,status) VALUES ('".$_POST["first_name"]."', '".$_POST["last_name"]."' ,'".$role."','".$status."')
			";
			$statement = $connect->prepare($query);
			$statement->execute();
			echo '<p>Data Inserted...</p>';
	}
	if($_POST["action"] == "fetch_single")
	{
		$query = "
		SELECT * FROM tbl_sample WHERE id = '".$_POST["id"]."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['first_name'] = $row['first_name'];
			$output['last_name'] = $row['last_name'];
			$output['role'] = $row['role'];
			$output['status'] = $row['status'];
		}
		echo json_encode($output);
	}
	if($_POST["action"] == "update")
	{
		$query = "
		UPDATE tbl_sample 
		SET first_name = '".$_POST["first_name"]."', 
		last_name = '".$_POST["last_name"]."' , 
		role = '".$role."' , 
		status = '".$status."' 
		WHERE id = '".$_POST["hidden_id"]."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Updated</p>';
	}
	if($_POST["action"] == "delete")
	{
		$query = "DELETE FROM tbl_sample WHERE id = '".$_POST["id"]."'";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Deleted</p>';
	}
	if($_POST["action"] == "setAct"){
		$trimmed = rtrim($_POST["id"], ",");
		$id  = explode(",", $trimmed );
		foreach ($id as $key => $value) {
			$query = "UPDATE tbl_sample SET status = '1' WHERE id = ".$value."";
		$statement = $connect->prepare($query);
		$statement->execute();
		}
		echo '<p>Data Updated</p>';
	}
	if($_POST["action"] == "setNoAct"){
		$trimmed = rtrim($_POST["id"], ",");
		$id  = explode(",", $trimmed );
		foreach ($id as $key => $value) {
			$query = "UPDATE tbl_sample SET status = '0' WHERE id = ".$value."";
		$statement = $connect->prepare($query);
		$statement->execute();
		}
		echo '<p>Data Updated</p>';
	}
	if($_POST["action"] == "del"){
		$trimmed = rtrim($_POST["id"], ",");
		$id  = explode(",", $trimmed );
		foreach ($id as $key => $value) {
			$query = "DELETE FROM tbl_sample WHERE id = '".$value."'";
			$statement = $connect->prepare($query);
			$statement->execute();
		}
		echo '<p>Data deleted</p>';
	}
}

// ?>