<?php
	
	//vars	
	$db = $data->db;
	$album_id = $data->album_id ? $data->album_id : 1;
	$folder = $data->root.'public/img/photos/';
	$user_id = $_SESSION['user']->id;	
	$return = (object)[
		'error'=>null,
		'uploaded'=>null,
		'filename'=>''
	];	
	
	if (isset($_FILES['file']))
	{
		$file = (object)$_FILES['file'];
		if (preg_match('/(.jpg)|(.jpeg)|(.png)|(.gif)|(.bmp)$/i', $file->name))
		{			
			if (move_uploaded_file($file->tmp_name, $folder.str_replace(' ', '_', $file->name)))
			{	
				$url = $data->url.'public/img/photos/'.str_replace(' ', '_', $file->name);
				$filename = str_replace(' ', '_', $file->name);

				$q = "INSERT INTO photos (img_url,album_id,img_filename,date_created,date_modified,status,user_id) VALUES (?,?,?,UNIX_TIMESTAMP(NOW()),UNIX_TIMESTAMP(NOW()),'published',?)";
				$stmt = $db->prepare($q);				
				if ($stmt->bind_param('ssss',$url,$album_id,$filename,$user_id))
				{
					if ($stmt->execute())
					{
						if ($db->affected_rows > 0)
						{
							$res = $db->query("SELECT id FROM photos ORDER BY date_modified DESC LIMIT 1");							
							$row = $res->fetch_assoc();							

							$return->uploaded = (object)[
								'filename'=>$file->name,
								'title'=>$file->name,
								'size'=>$file->size/1000,
								'url'=>$url,	
								'id'=>$row['id'],				
								'album'=>$album_id
							];
						}					
					}
					$return->error = 'Unable to upload. Database error';
				}
				$return->error = $db->error;				
			}
			else
			{
				$return->error = 'Unable to upload the file. The file size might be too large.';
				$return->filename = $file->name;
			}
		}
		else
		{
			$return->error = 'Invalid file format. Must be an image file.';
		}		
	}
	else
	{
		$return->error = 'No file selected.';
	}

	echo json_encode($return);