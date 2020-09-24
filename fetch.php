<?php

//fetch.php

include("database_connection.php");

$query = "SELECT * FROM tbl_sample";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_row = $statement->rowCount();
$output = '
<table class="table table-striped table-bordered">
	<tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Status</th>
		<th>Role</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
';
if($total_row > 0)
{
	foreach($result as $row)
	{
		
		$role = ($row["role"]==1) ?'Admin':'User';
		$status = ($row["status"]==1)?'Online':'Offline';

		$output .= '
		<tr>
			<td width="40%">'.$row["first_name"].'</td>
			<td width="40%">'.$row["last_name"].'</td>
			<td width="10%" style="text-align:center;">
				<div class = '.$status.'>
					
				</div>
			</td>
			<td width="10%">
				<div class = '.$role.'>
					'.$role.'
				</div>
			</td>
			<td width="10%">
				<button type="button" name="edit" class="btn btn-primary btn-xs edit" id="'.$row["id"].'">Edit</button>
			</td>
			<td width="10%">
				<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Delete</button>
			</td>
		</tr>
		';
	}
}
else
{
	$output .= '
	<tr>
		<td colspan="4" align="center">Data not found</td>
	</tr>
	';
}
$output .= '</table>';
echo $output;
?>