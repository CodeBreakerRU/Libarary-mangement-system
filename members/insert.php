<?php

include('../connection.php');

$form_data = json_decode(file_get_contents("php://input"));

$error = '';
$message = '';
$validation_error = '';
$first_name = '';
$last_name = '';

if($form_data->action == 'fetch_single_data')
{
	$query = "SELECT * FROM members WHERE id='".$form_data->id."'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output['name'] = $row['name'];
		$output['address'] = $row['address'];
        $output['phone'] = $row['phone'];
	}
}

else
{
	if(empty($form_data->name))
	{
		$error[] = 'First Name is Required';
	}
	else
	{
		$name = $form_data->name;
	}

	if(empty($form_data->address))
	{
		$error[] = 'Last Name is Required';
	}
	else
	{
		$address = $form_data->address;
	}

    if(empty($form_data->phone))
    {
        $error[] = 'Phone number is Required';
    }
    else
    {
        $phone = $form_data->phone;
    }

	if(empty($error))
	{

		if($form_data->action == 'Edit')
		{
			$data = array(
				':name'	=>	$name,
				':address'	=>	$address,
				':phone' => $phone,
				':id'			=>	$form_data->id
			);

			$query = "
			UPDATE members
			SET name = :name, address = :address , phone =:phone
			WHERE id = :id
			";

			$statement = $connect->prepare($query);
			if($statement->execute($data))
			{
				$message = 'Data Edited';
			}
		}
	}
	else
	{
		$validation_error = implode(", ", $error);
	}

	$output = array(
		'error'		=>	$validation_error,
		'message'	=>	$message
	);

}

echo json_encode($output);

?>