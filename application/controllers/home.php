<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Home extends Controller
{
	/**
     * setup class-wide defaults
     */
    public function __construct()
    {
        $this->data['page'] = 'home';
        parent::__construct();
    }

    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
    	$this->data['head_title'] = 'Welcome | Christian Challenge Chuch, Inc.';          
        
        // load mission
        $this->load_model('AboutModel');
        $this->data['mission'] = $this->AboutModel->load_single(array('where'=>'title="mission"'));

        // load ministry
        $this->data['ministry'] = $this->MinistryModel->load_all(array('where'=>'status="published"'));

        // load locations
        $this->load_model('LocalChurches');
        $this->data['local_churches'] = $this->LocalChurches->load_all(array('where'=>'status="published"'));

        $this->loadView('public/_templates/header',$this->data);
        $this->loadView('public/home/index',$this->data);
        $this->loadView('public/_templates/footer');
    }
    //  end index

}
