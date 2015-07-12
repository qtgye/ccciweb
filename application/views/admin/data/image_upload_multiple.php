<?php
	
	//vars	
	$db = $data->db;
	$album_id = $data->album_id ? $data->album_id : 1;
	$folder = $data->root.'public/img/photos/';
	$user_id = $_SESSION['user']->id;
	$errors = [];	
	$return = (object)[
		'error'=>null,
		'uploaded'=>[],
		'filenames'=>[],
		'error_files'=>[],
		'files'=>''
	];
	
	if (isset($_FILES['file']))
	{
		$files = $_FILES['file'];	
		//$return->files = print_r($_FILES['file']);	

		if (is_array($files)) {
			foreach ($files['name'] as $key => $name) {
				$file = (object)[
					'name' => $name,
				    'type' => $files['type'][$key],
				    'tmp_name' => $files['tmp_name'][$key],
				    'error' => $files['error'][$key],
				    'size' => $files['size'][$key]
				];
				if (preg_match('/(.jpg)|(.jpeg)|(.png)|(.gif)|(.bmp)$/i', $file->name))
				{			
					if (move_uploaded_file($file->tmp_name, $folder.str_replace(' ', '_', $file->name)))
					{	
						$url = $data->url.'public/img/photos/'.str_replace(' ', '_', $file->name);
						$filename = str_replace(' ', '_', $file->name);

						$q = "INSERT INTO photos (img_url,album_id,img_filename,date_created,date_modified,status,user_id) VALUES (?,?,?,UNIX_TIMESTAMP(NOW()),UNIX_TIMESTAMP(NOW()),'published',?)";
						$stmt = $db->prepare($q);
						//print_r($db);
						if ($stmt->bind_param('ssss',$url,$album_id,$filename,$user_id))
						{
							if ($stmt->execute())
							{
								if ($db->affected_rows > 0)
								{
									$res = $db->query("SELECT id FROM photos ORDER BY date_modified DESC LIMIT 1");							
									$row = $res->fetch_assoc();							

									$return->uploaded[] = (object)[
										'filename'=>$file->name,
										'title'=>$file->name,
										'size'=>$file->size/1000,
										'url'=>$url,	
										'id'=>$row['id'],				
										'album'=>$album_id
									];

									continue;
								}					
							}
							else
							{
								$return->error .= 'Unable to upload '.$file->name.'. Database error.<br>';
								$return->filenames[] = $file->name;
							}
						}
						else
						{
							$return->error .= $db->error.'<br>';	
						}									
					}
					else
					{
						$return->error .= 'Unable to upload the '.$file->name.'. The file size might be too large.<br>';						
					}
				}
				else
				{
					$return->error = $file->name.' cannot be uploaded. Must be an image file.<br>';					
				}				
			}			
		}						
	}
	else
	{
		$return->error = 'No file selected.';
	}	

	echo json_encode($return);