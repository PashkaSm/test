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
		<th><input type = "checkbox" id="checkbox"></th>
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
			<td style="text-align:center;" class="controls">
				<input type="checkbox" id='.$row["id"].'>
			</td>
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
?><script >
	$('#checkbox').click(function(){
	if ($(this).is(':checked')){
		$('.controls input:checkbox').prop('checked', true);
	} else {
		$('.controls input:checkbox').prop('checked', false);
	}
});
	$('#test').click(function(){
		$('#test_dialog').attr('title', 'Add Data');
		$('#action').val('insert');
		$('#form_action').val('Insert');
		$('#user_form')[0].reset();
		$('#form_action').attr('disabled', false);
		$("#user_dialog").dialog('open');
		if ($('.controls input:checkbox').is(':checked')){
		$("#first_name").val($('.controls input:checkbox').val());
		}
	});
</script>