<?php
	$db = $data;
	$method = $_POST['method'];
	$id = $_POST['id'];
	$src = $_POST['src'];
	$result = (object)['error'=>null, 'data'=>null];
	switch ($method) {		
		case 'view':			
			$q = $src == 'users'?
				"SELECT * FROM ".$src." WHERE id='".$id."' LIMIT 1":				
				"SELECT p.*, u.username AS user_name FROM $src AS p INNER JOIN users as u ON p.user_id = u.id WHERE p.id=".$id." LIMIT 1";			
			if ( $res = $db->query($q) ) {
				if ( $res->num_rows > 0 ) {
					$row = $res->fetch_assoc();
					if (preg_match('/(local_churches|outreaches)/', $src))
					{
						if (isset($row->pastor_id))
						{
							$q = "SELECT CONCAT(name_first,' ',name_last) AS pastor_name FROM pastors WHERE id = ".$row->pastor_id;
							$res = $db->query($q);
							$p_row = $res->fetch_assoc();							
							


							$row['pastor_name'] = $p_row['pastor_name'];							
						}						
					}
					foreach ($row as $key => $value) {
						// process values to be passed on json object
						if ( preg_match('/^(password|salt|user_id|author_id|pastor_id|id|img_thumbnail|activated|local_church)$/', $key) ) {
							// set if current user can edit this item								
							if ($key == 'user_id' )
							{
								$result->user_edittable = $this->session->user->id == $value;
							}						
							unset($row[$key]);
						} elseif ( preg_match('/(date)|(birthday)/i', $key) ) {
							$row[$key] = date('M-d-y',(integer)$value);
						} elseif ( preg_match('/(contact|social)/i', $key) ) {							
							$row[$key] = explode(',', $value);
						} elseif ( preg_match('/(sex)/i', $key) ) {
							$row[$key] = ($value == 'm' ? 'Male' : ($value=='f'?'Female':''));
						} elseif ( preg_match('/(services)/i', $key) ) {
							$arr = explode('||', $row[$key]);
							if (is_array($arr))
							{
								$row[$key] = [];
								foreach ($arr as $value) {
									if ($obj = json_decode($value))
									{
										array_push($row[$key], $obj);
										//$row->$key[] = $obj;
									}
								}
							}							
						} else {
							$row[$key] = $value ? $value : '';
						}
					}					
					$result->data = $row;					
				} else {
					$result->error = 'No result found.';
				}
			} else {
				$result->error = $db->error;
			}
			echo json_encode($result);
			break;
	}
?>