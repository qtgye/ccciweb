<?php 

if (isset($data->photos)) {
	echo json_encode((object)[
			'photos' => $data->photos
		]);	
}