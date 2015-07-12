<?php

class MainModel extends Base
{
    const TABLE_NAME = 'about';
    public $db_data = array();

    public function __construct()
    {        
        parent::__construct();        
    }

    // load all or multiple entries
    public function load_all($options = '')
    {        
        $query_options = $this->construct_query_options($options);
        $ret_arr = [];

        $q = 'SELECT * FROM ' .$this::TABLE_NAME. $query_options;
        $res = $this->db->query($q);

        if ($res) {
            while ( $row = $res->fetch_object() ) {               
                array_push($ret_arr, $row);
            }
        }

        $res->free();               

        return $ret_arr;
    }

    // load a single entry
    public function load_single($opt)
    {

        if (!$opt) {            
            return null;
        }
        else if ( is_array($opt) )
        {
            $query_options = $this->construct_query_options($opt);
        }
        else
        {
            $query_options = ' WHERE id=' . $opt;
        }
        
        $ret_obj = null;

        $q = 'SELECT * FROM ' .$this::TABLE_NAME. $query_options;
        $res = $this->db->query($q);

        if ($res) {
            $ret_obj = $res->fetch_object();
        }

        return $ret_obj;
    }

    public function construct_query_options($options_array)
    {
        $options_string = '';

        if ( $options_array )
        {
            foreach ($options_array as $key => $value) {   
                $key = str_replace('_', ' ', $key);
                $options_string .= ' ' .strtoupper($key). ' ' .$value;
            }
        }

        return $options_string;
    }


}