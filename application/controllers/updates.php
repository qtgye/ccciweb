<?php

/**
 * Class updates
 *
 *
 */
class Updates extends Controller
{
    /**
     * setup class-wide defaults
     */
    public function __construct()
    {
        parent::__construct();
        $this->data['page'] = 'updates'; 
    }


    /**
     * PAGE: updates, events
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */   
    public function events($post_perma_title = null)
    {        
        $this->data['head_title'] = 'Events | Christian Challenge Church, Inc.';        
        $this->data['subpage'] = 'events';
        $this->loadView('public/_templates/header',$this->data);

        $this->load_model('Events');
        
        // choose a different template if $post_perma_title is defined
        if ($post_perma_title)
        {
            $this->data['post'] = $this->Events->load_single($post_perma_title);
            $this->data['other_posts'] = $this->Events->load_all(array('where'=>'status="published" and id<>'.$post_perma_title,'order_by'=>'event_date DESC','limit'=>5));
            $this->loadView('public/updates/posts_single',$this->data);
        }
        else
        {
            $this->data['posts'] = $this->Events->load_all(array('where'=>'status="published"','order_by'=>'event_date DESC','limit'=>10));
            $this->loadView('public/updates/posts',$this->data);
        }

        $this->loadView('public/_templates/footer');
    }
    // end events


    /**
     * PAGE: updates, news
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */   
    public function news($post_perma_title = null)
    {        
        $this->data['head_title'] = 'News | Christian Challenge Church, Inc.';        
        $this->data['subpage'] = 'news';
        $this->loadView('public/_templates/header',$this->data);

        $this->load_model('News');   

        // choose a different template if $post_perma_title is defined
        if ($post_perma_title)
        {
            $this->data['post'] = $this->News->load_single($post_perma_title);
            $this->data['other_posts'] = $this->News->load_all(array('where'=>'status="published" and id<>'.$post_perma_title,'order_by'=>'date_publish DESC','limit'=>5));
            $this->loadView('public/updates/posts_single',$this->data);
        }
        else
        {
            $this->data['posts'] = $this->News->load_all(array('where'=>'status="published"','order_by'=>'date_publish DESC','limit'=>10));
            $this->loadView('public/updates/posts',$this->data);
        }

        $this->loadView('public/_templates/footer');
    }
    // end news

    /**
     * PAGE: updates, news
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */   
    public function stories($post_perma_title = null)
    {        
        $this->data['head_title'] = 'Events | Christian Challenge Church, Inc.';        
        $this->data['subpage'] = 'stories';
        $this->loadView('public/_templates/header',$this->data);

        $this->load_model('Stories');

        // choose a different template if $post_perma_title is defined
        if ($post_perma_title)
        {
            $this->data['post'] = $this->Stories->load_single($post_perma_title);
            $this->data['other_posts'] = $this->Stories->load_all(array('where'=>'status="published" and id<>'.$post_perma_title,'order_by'=>'date_publish DESC','limit'=>5));
            $this->loadView('public/updates/posts_single',$this->data);
        }
        else
        {
            $this->data['posts'] = $this->Stories->load_all(array('where'=>'status="published"','order_by'=>'date_publish DESC','limit'=>10));
            $this->loadView('public/updates/posts',$this->data);
        }

        $this->loadView('public/_templates/footer');
    }
    // end stories


    /**
     * PAGE: updates, news
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */   
    public function articles($post_perma_title = null)
    {        
        $this->data['head_title'] = 'Events | Christian Challenge Church, Inc.';        
        $this->data['subpage'] = 'articles';
        $this->loadView('public/_templates/header',$this->data);

        $this->load_model('Articles');

        // choose a different template if $post_perma_title is defined
        if ($post_perma_title)
        {
            $this->data['post'] = $this->Articles->load_single(array('where'=>'id='.$post_perma_title));
            $this->data['other_posts'] = $this->Articles->load_all(array('where'=>'status="published" and id<>'.$post_perma_title,'order_by'=>'date_publish DESC','limit'=>5));
            $this->loadView('public/updates/posts_single',$this->data);
        }
        else
        {
            $this->data['posts'] = $this->Articles->load_all(array('where'=>'status="published"','order_by'=>'date_publish DESC','limit'=>10));
            $this->loadView('public/updates/posts',$this->data);
        }

        $this->loadView('public/_templates/footer');
    }
    // end articles


}
