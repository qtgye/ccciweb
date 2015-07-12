<?php
	
	//vars	
	$db = $data->db;	
	$user_id = $_SESSION['user']->id;	
	$return = (object)[
		'error'=>null		
	];
	
	if (isset($_POST['img_caption']))
	{		
		$c = $_POST['img_caption'];
		$img_id = $_POST['id'];

		$q = "UPDATE photos SET img_caption = ?, date_modified = UNIX_TIMESTAMP(NOW()), user_id = ? WHERE id = ?";
		$stmt = $db->prepare($q);
		$stmt->bind_param('sss',$c,$user_id,$img_id);

		if (!$stmt->execute())		
		{
			if ($db->affected_rows <= 0)
			{
				$return = (object)[
					'error'=>'Unable to update the caption of the image.'
				];
			}				
		}
	}
	else
	{
		$return->error = 'No image selected.';
	}

	echo json_encode($return);