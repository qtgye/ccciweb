<?php

/**
 * Class About
 *
 *
 */
class About extends Controller
{
    /**
     * setup class-wide defaults
     */
    public function __construct()
    {
        parent::__construct();
        $this->data['page'] = 'about'; 
    }


    /**
     * PAGE: about, index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */   
    public function index()
    {        
        $this->data['head_title'] = 'About Us | Christian Challenge Church, Inc.';        
        $this->data['subpage'] = 'mission_vision_purpose';
        $this->data['statements'] = array(); // will hold the statements

        $this->load_model('AboutModel');
        $this->data['statements'][] = $this->AboutModel->load_single(array('where'=>'title="mission"'));
        $this->data['statements'][] = $this->AboutModel->load_single(array('where'=>'title="vision"'));
        $this->data['statements'][] = $this->AboutModel->load_single(array('where'=>'title="purpose"'));

        $this->loadView('public/_templates/header',$this->data);
        $this->loadView('public/about/index',$this->data);
        $this->loadView('public/_templates/footer');
    }
    // end index


    /**
     * PAGE: about, pastors
     */
    public function pastors($pastor_id = null)
    {
        $this->data['head_title'] = 'Our Pastors | Christian Challenge Church, Inc.';        
        $this->data['subpage'] = 'pastors';

        $this->load_model('PastorsModel');
        $this->loadView('public/_templates/header',$this->data);

        // if album_id is defined, load the template for a single album
        if ($pastor_id) {
            $this->data['pastor'] = $this->PastorsModel->load_single(array('where'=>'id='.$pastor_id));
            $this->loadView('public/about/pastors_single',$this->data);
        }
        else {
            $this->data['pastors'] = $this->PastorsModel->load_all();
            $this->loadView('public/about/pastors',$this->data);
        }

        $this->loadView('public/_templates/footer');
    }
    // end index


    /**
     * PAGE: about, gallery
     */
    public function gallery($album_id = null)
    {       
        $this->data['head_title'] = 'Gallery | Christian Challenge Church, Inc.';        
        $this->data['subpage'] = 'gallery';
        $this->data['album_id'] = $album_id ? $album_id : '';
        $this->loadView('public/_templates/header',$this->data);        

        // if album_id is defined, load the template for a single album
        if ($album_id) {
            $this->load_model('AlbumsModel');
            $this->data['album'] = $this->AlbumsModel->load_single(array('where'=>'id='.$album_id));
            $this->load_model('PhotosModel');
            $this->data['photos'] = $this->PhotosModel->load_all(array('where'=>'album_id='.$album_id));            
            $this->loadView('public/about/gallery_single',$this->data);
        }
        else {
            $this->load_model('AlbumsModel');
            $this->data['albums'] = $this->AlbumsModel->load_albums();
            $this->loadView('public/about/gallery',$this->data);
        }

        $this->loadView('public/_templates/footer');
    }
    // end index


    /** PAGE: ministry, single
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */   
    public function ministry($ministry_abbr = null)
    {        
        // load MinistryModel if not yet loaded
        if ( !$this->MinistryModel )
        {
            $this->load_model('MinistryModel');
        }        
        $ministry = $this->MinistryModel->load_single(array('where'=>'title_abbr = "'.$ministry_abbr.'"'));

        if (!$ministry)
        {
            header('location:/404_not_found');
        }
        else
        {
            $this->data['head_title'] = $ministry->title;
            $this->data['ministry'] = $ministry;
            $this->data['page'] = 'ministry';
            $this->data['subpage'] = $ministry_abbr;
            
            $this->data['head_title'] .= ' | Christian Challenge Church, Inc.';        
            
            $this->loadView('public/_templates/header',$this->data);        
            $this->loadView('public/ministry/single',$this->data);        
            $this->loadView('public/_templates/footer');
        }

        
    }
    // end ministry


    /** PAGE: about, locations
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */   
    public function locations()
    {
        $this->data['page'] = 'reach_us';
        $this->data['subpage'] = 'times_and_locations';

        $this->load_model('LocalChurches');
        $this->load_model('Outreaches');

        $this->data['local_churches'] = $this->LocalChurches->load_all(array('where'=>'status="published"'));
        $this->data['outreaches'] = $this->Outreaches->load_all(array('where'=>'status="published"'));
        
        $this->data['head_title'] = 'Times and Locations | Christian Challenge church, Inc.';
        $this->loadView('public/_templates/header',$this->data);
        $this->loadView('public/locations/index',$this->data);
        $this->loadView('public/_templates/footer');

    }
    // end locations


    /** PAGE: ministry, single
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */   
    public function local_churches($location_id = null)
    {
        // redirect page if no location_id is defined
        if (!$location_id)
        {
            header('location:/404_not_found');            
        }

        // htmlspecialchars_decode(string)

        $this->data['page'] = 'reach_us';
        $this->data['subpage'] = 'times_and_locations';
           
        $this->load_model('LocalChurches');
        $this->data['local_church'] = $this->LocalChurches->load_single(array('where'=>'id="'. ($location_id .'"')));
        
        $this->data['head_title'] = $this->data['local_church']->title . ' | Christian Challenge church, Inc.';
       
        $this->loadView('public/_templates/header',$this->data);        
        $this->loadView('public/locations/single',$this->data);        
        $this->loadView('public/_templates/footer');        
    }
    // end local_churches


    /** PAGE: ministry, single
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */   
    public function outreaches($location_id = null)
    {
        // redirect page if no location_id is defined
        if (!$location_id)
        {
            header('location:/404_not_found');            
        }

        $this->data['page'] = 'reach_us';
        $this->data['subpage'] = 'times_and_locations';
           
        $this->load_model('Outreaches');
        $this->data['outreach'] = $this->Outreaches->load_single('id = '.$location_id);

        // redirect if there is no record found with the defined id
        if ( !$this->data['outreach'] )
        {            
            header('location:/404_not_found');
        }
        
        $this->data['head_title'] = $this->data['outreach']->title . ' | Christian Challenge church, Inc.';
        $this->data['page'] = 'outreach';
        $this->data['subpage'] = $location_id;        

        $this->loadView('public/_templates/header',$this->data);        
        $this->loadView('public/locations/index',$this->data);        
        $this->loadView('public/_templates/footer');        
    }
    // end local_churches

}
