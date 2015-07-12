<?php

class AlbumsModel extends MainModel
{
    const TABLE_NAME = 'albums';    

    public function __construct()
    {        
        parent::__construct();        
    }

    public function load_albums()
    {    	
    	$albums = $this->load_all(array('where'=>'id <> 1'));

    	// get cover image for each album
    	foreach ($albums as $key => $album) {
    		$q = 'SELECT img_thumbnail FROM photos WHERE album_id='. $album->id. ' LIMIT 1';
    		$res = $this->db->query($q);
    		$row = $res->fetch_object(); 

    		if ($row) {
    			$albums[$key]->cover_img_thumbnail = $row->img_thumbnail;
    		}
    		
    	}

    	return $albums;
    }
    
    public function load_single_album($album_id = null)
    {

    }

}