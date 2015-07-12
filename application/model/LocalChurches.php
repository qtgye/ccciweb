<?php

class LocalChurches extends MainModel
{
    const TABLE_NAME = 'local_churches';    

    public function __construct()
    {        
        parent::__construct();
    }   

    public function load_single($options = '')
    {        
        $ret_obj = parent::load_single($options);

        // process services json object
        if ( $ret_obj )
        {   
        	$services =  explode('||', $ret_obj->services);
        	foreach ($services as $key => $service) {
        		$services[$key] = json_decode($service);
        	}
        	$ret_obj->services = $services;
        }

        return $ret_obj;
    }

}