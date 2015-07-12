<?php 

class Base
{
    /**
     * @var null Database Connection
     */
    public $db = null;

    /**
     * @var null Model
     */
    public $model = null;

    /**
     * @var null header title
     */
    public $header_title = 'Welcome | Christian Challenge Church, Inc. - Mission Summary Here';

    /**
     * @var post values
     */
    public $post = null;

    /**
     * @var session values
     */
    public $session = null;

    /**
     * @var site meta object
     */
    public $site_settings = null;

    /**
     * @var pages list array
     */
    public $pages = null;

    public function __construct()
    {
        date_default_timezone_set('Asia/Manila');
        if (!isset($_SESSION) )
        {
            session_start();
        }
        $this->session = (object)$_SESSION;
        $this->post = $this->refine_post();        
        $this->openDatabaseConnection();   
        $this->site_settings = $this->get_site_settings(); 
        $this->pages = explode('|', 'news|articles|stories|events|albums|local_churches|outreaches|about|pastors|ministry|church_meta|users|site_settings|documentation');
        
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection()
    {        
        $this->db = new mysqli(HOST,USERNAME,PASSWORD,DBASE);
    }

    //refines post values.
    //e.g., removes empty arrays
    private function refine_post()
    {
        $processed = [];
        foreach ($_POST as $key => $value) {
            if (is_array( $value)) {               
                $value = array_slice(array_filter($value),0);
            }
            $processed[$key]=$value;
        }        
        return (object)$processed;
    }

    // gets the meta information of the site from database
    // e.g., site_title, site_logo, etc.
    private function get_site_settings()
    {
        $settings = [];

        $q = "SELECT * FROM site_settings";
        $res = $this->db->query($q);

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_object()) {
                $settings[$row->name] = $row;                
            }
        }

        return (object)$settings;
    }

    // loads a library to be used
    // library name should be the same as the library folder and the php file
    public function load_service($service_name)
    {
        require APP . 'services/' . $service_name . '/' . $service_name . '.php';

        $this->$service_name = new $service_name;
    }
    

}