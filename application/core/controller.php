<?php

class Controller extends Base
{
    /**
     * contains the data for each view
     * @var string
     */
    public $data = [];

    /**
     * ADDITIONAL PROPERTIES DUE TO REFACTORING
     */

    /**
     * The loader object
     */
    public $load;  

    /**
     * Whenever a controller is created, open a database connection too and load "the model".
     */
    function __construct()
    {        
        parent::__construct();
        // load ministries for the nav
        $this->load_model('MinistryModel');
        $this->data['ministries'] = $this->MinistryModel->load_all(array('where'=>'status="published"'));          
    }    

    /**
     * Loads the "model".
     * @return object model
     */
    public function loadModel($model,$data = null)
    {
        require APP . 'model/'.$model.'.php';
        // create new "model" (and pass the database connection)
        $this->model = new $model($this->db, $data);
    }

    public function loadView($view,$data = [])
    {
        if ( file_exists(APP . 'views/' . $view . '.php') )
        {
            require APP . 'views/' . $view . '.php';
        }
        else
        {
            require APP . 'views/public/error/index.php';
        }
        
    }

    // error page
    public function error_404()
    {
        $this->loadView('admin/_templates/header',(object)['header_title'=>'404 Not Found']);
        $this->loadView('admin/error/index',(object)['header_title'=>'404 Not Found']);
        $this->loadView('admin/_templates/footer_blank');
    }

    // error page
    public function maintenance_page()
    {
        $this->loadView('admin/_templates/header',(object)['header_title'=>'Site Inactive']);
        $this->loadView('admin/error/maintenance_page',(object)['header_title'=>'404 Not Found']);
        $this->loadView('admin/_templates/footer_blank');
    }    



    /**
     * ADDITIONAL METHODS DUE TO REFACTORING
     */   
    public function load_model($model_name)
    {
        require APP . 'model/'.$model_name.'.php';
        // create new "model" (and pass the database connection)
        $this->$model_name = new $model_name($this->db);
    }
    
    
}
