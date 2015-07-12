<?php

class AdminModel extends Base
{
    // @var = handling assoc for processed post values
    public $processed_post = [];

    // this is for debugging only
    public function log($str)
    {
        echo '<pre>';
        print_r($str);
         echo '</pre>';
    }

    public function __construct($db)
    {
        parent::__construct();
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }  
        
    }

    //redirects if user is not logged in
    public function check_login()
    {
        if (!$this->user_logged_in())
        {
            header('location: '.URL.'admin/');
        }
    }

    // validate url.
    // e.g., if page is present/valid for currrent user . or status is valid
    public function validate_url($page,$status)
    {
        $user_permission = $this->session->user->permission;       



        if (
            (preg_match('/(users|site_settings|documentation)/', $page) && $user_permission > 1) ||
            (preg_match('/(local_churches|outreaches|about|pastors|ministry|church_meta)/', $page) && $user_permission > 2) ||
            (!in_array($page, $this->pages))
        )
        {
            $this->error_404();
        }

    }

    //checks whether the user is logged in
    public function user_logged_in()
    {            
        return isset($_SESSION['user']) ? true : false;        
    }

    //checks whether a login form has been submitted
    public function check_login_submit()
    {   
        $login = (object)[
           'values' => null,
           'errors' => (object)[
                'fields' => [],
                'message' => ''
           ],
           'info'=>(object)[
                'type'=>'error',
                'content'=>''
           ]
        ];

        // if login form is submitted
        if ( isset($this->post->login) )
        {
            $login->values = $this->get_field_values('users');           

            // validata post values
            $q = "SELECT id,username,name_first,name_last,password,permission FROM users WHERE (username='{$this->post->username}' OR email='{$this->post->username}') AND status='active'";
            $res = $this->db->query($q);
            $user = $res->fetch_assoc();               
            if ( $res->num_rows == 1 )
            { 
                if ( $user['password'] == crypt($this->post->password,$user['password']) )
                {
                    $_SESSION['user'] = (object)[
                        'username' => $user['username'],
                        'name_first' => $user['name_first'],
                        'name_last' => $user['name_last'],
                        'permission' => $user['permission'],
                        'id'=> $user['id']
                    ];                    
                    header('location: '.URL.'admin');
                }                    
            }

            $login->errors->message =  'Invalid username/password.';
            $login->info->content =  'Invalid username/password.';
        }
        // if forgot password
        elseif (isset($this->post->reset_password)) {

            if (isset($this->post->email_address)) {
                // validate email
                if ($this->valid_email($this->post->email_address)) {
                    // validate availabity
                    if ($this->data_exists('users','email',null,null,$this->post->email_address)) {
                        // create a password
                        $password = rand(11111111,99999999);
                        // get the user object
                        $q = "SELECT id,name_first,email FROM users WHERE email='".$this->post->email_address."' AND status='active'";
                        $res = $this->db->query($q);
                        $user = $res->fetch_object();

                        $update_password = $this->change_password($password,$user);

                        $login->info->type = $update_password->type;
                        $login->info->content = $update_password->content;
                    }
                    else
                    {
                        $login->info->content =  'The email address is either not yet registered or is not yet activated.<br>Please provide the email from your account if you are an active user.';                        
                    }
                }
                else
                {
                    $login->info->content =  'Please provide a valid email address.';
                }                
            }

        }

        return $login;
    }


    //checks whether a register form has been submitted
    public function check_register_submit()
    { 
        $register = (object)[
           'errors' => (object)[
                'fields'=> [],
                'message'=>''
           ],
           'values' => $this->get_field_values('users')           
        ];

        if ( isset($this->post->register) )
        {            
            $errors = $this->validate_post_values($this->get_field_names('users','new'),'register','users');

            $register->errors->fields = !empty($errors->fields)?$errors->fields:[];
            $register->errors->message = !empty($errors->message)?$errors->message:'';

            // if no error, register
            if(!$register->errors->message)
            {
                $insert_db = $this->insert_db('users');                

                if ( !$insert_db->errors )
                {                    
                    // send mail to user
                    $this->send_mail('register_success',$this->post->email);                                  

                    header('location: '.URL.'admin/register_success');
                }
                else
                { 
                    $register = (object)[
                       'errors' => (object)[
                            'message' => $insert_db->errors->message             
                        ]
                    ];
                }
            }
                                     
        }

        return $register;    
    }

    //checks if date input is of valid format
    public function valid_date($i)
    {
        $i = trim((string)$i);
        $m31 = [1,3,5,7,8,10,12];
        $m30 = [4,6,9,11];
        if ( !empty($i) ) {            
            $date = explode('-',$i);
            if ( preg_match('/^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$/', $i) && (integer)substr($i, 0,4) >= 1970 ) {                
                $y = (integer)$date[0];
                $m = (integer)$date[1];
                $d = (integer)$date[2];                
                if ( $m <= 12 ) {                            
                    if ( $d <= 31 && in_array($m, $m31) ) {
                        return true;
                    } else if ( $d <= 30 && in_array($m, $m30) ) {
                        return true;
                    } else if ( $m == 2 && $y%12 == 0 && $d<= 29 ) {
                        return true;
                    } else if ( $m == 2 && $y%12 > 0 && $d < 29 ) {
                        return true;
                    }
                }       
            }            
        }
        return false;
    }

     //checks if time input is of valid format
    public function valid_time($i)
    {        
        if ( !empty($i) ) {
            $time = strtolower(trim($i));
            //echo $time;
            if ( preg_match('/^([1-9]|[1][1-2]):[0-5][0-9]\s?(am|pm)$.?/', $time) ) {
                return true;
            }
            return false;
        } else {
            return false;
        }   
    }

    // check if a data already exists in a table
    // @param page = string, the table name in database
    // @param column = string, the column name in table
    // @param value = mixed, the data to search
    public function data_exists($page,$column,$id = null,$method="new",$value=null)
    {        
        $value = $value ? $value : $this->post->$column;

        // check if new entry by checking if there is id
        if ($id)
        {       
            // existing entry has id
            $query = "SELECT * FROM {$page} WHERE {$column} = '{$value}' AND id != {$id}";
                           
        }
        else
        {
            // new entry don't have id
            $query = "SELECT * FROM {$page} WHERE {$column} = '{$value}'";           
        }

        $res = $this->db->query($query);

        if (@$res->num_rows > 0 )
        {
            // this is for debugging only
            // $row = $res->fetch_object(); 
            
            return true;
        }
        return false;
    }

    //check if email is of valid format
    function valid_email($email)
    {       
        $e = trim($email);  
        if ( preg_match('/^[\d\w_\-.]+@[\d\w_\-]+\.[A-Za-z]+$/', $e) ) {            
                return true;
            } 
        return false;   
    }

    //check if contact is of valid format
    function valid_contact($num)
    {       
        $n = trim($num);    
        if ( preg_match('/^[\d]{7}$/', $n) || preg_match('/^09[\d]{9}$/', $n) ) {           
                return true;
            } 
        return false;   
    }


    //create salt
    function salt()
    {
        $s = '$2a$12$';
        $t = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789');
        for ( $i = 0; $i <= 22; $i++ ) {
            $s .= $t[rand(0,count($t)-1)];
        }
        return $s;
    }    

    //function to get the info of each table from database
    public function get_table_info($table)
    {
        $m = (object)[
            'menu' => null,
            'notification' => null
        ];
        
        $status_pb = $table == 'users' ? 'active' : 'published';
        $status_dr = $table == 'users' ? 'waiting' : 'draft';

        $pb = $this->db->query("select * from ".$table." where (status='published' or status='active')");
        $dr = $this->db->query("select * from ".$table." where (status='draft' or status='waiting')");
        if ( !preg_match('/(users|albums)/', $table) )
        {
            $tr = $this->db->query("select * from ".$table." where status='trash'");
        }        

        if (preg_match('/(users|albums)/', $table))
        {            
            $tr = (object)['num_rows'=>0];
        }

        $m->menu = (object)[
            'title' => ucwords(str_replace('_', ' ', $table)),
            'name'=> $table,           
            'link' => URL.'admin/view/'.$table,
            'published' => (object)[
                'count' => $pb->num_rows,
                'link' => URL.'admin/view/'.$table.'/'.$status_pb
                ],
            'draft' => (object)[
                'count' => $dr->num_rows,
                'link' => URL.'admin/view/'.$table.'/'.$status_dr
            ],
            'trash' => (object)[
                'count' => $tr->num_rows,
                'link' => URL.'admin/view/'.$table.'/trash'
            ]
        ];

        if($dr->num_rows > 0 )
        {
            $be = $dr->num_rows > 1 ? 'are' : 'is';  
            $s = $dr->num_rows > 1 ? 's' : '';          
            $msg = $table == 'users' ? 'There '.$be.' '.$dr->num_rows.' awaiting request'.$s : 'There '.$be.' '.$dr->num_rows.' draft'.$s.' in '.ucwords(str_replace('_', ' ', $table));            
            $m->notification = (object)[
                'message' => $msg,
                'link' => URL.'admin/view/'.$table.'/'.$status_dr
            ];
        }

        return $m;
    }

    //gets the sidebar menu info
    public function get_sidebar()
    {       
        $sidebar = (object)[
            'notification' => [],
            'sidebar_menu_3' => [],
            'sidebar_menu_2' => [],
            'sidebar_menu_1' => [],
        ];        

        switch ($this->session->user->permission) {
            case 1:
                //get sidebar menu 2 info ( for users with perm. == 1 ) --> Primary Admin
                foreach (['users'] as $key => $p)
                {
                    $s = $this->get_table_info($p);                    
                    $sidebar->sidebar_menu_1[] = $s->menu;
                    if ( !empty($s->notification) )
                    {
                        $sidebar->notification[] = $s->notification;
                    }
                    
                }; 
                // add site_settings to sidebar menu                
                $sidebar->sidebar_menu_1[] = (object)[
                    'title' => 'Site Settings',
                    'name'=> 'site_settings',           
                    'link' => URL.'admin/site_settings'
                ];
            case 2:
                //get sidebar menu 2 info ( for users with perm. <= 2 ) --> Secondary Admin
                foreach (['local_churches','outreaches','about','pastors','ministry','church_meta'] as $key => $p)
                {
                    $s = $this->get_table_info($p);                    
                    $sidebar->sidebar_menu_2[] = $s->menu;
                    if ( !empty($s->notification) )
                    {
                        $sidebar->notification[] = $s->notification;
                    }
                    
                }
             case 3:
                //get sidebar menu 2 info ( for users with perm. <= 3 ) --> Contributor
                 foreach (['news','articles','stories','events','albums'] as $key => $p)
                {
                    $s = $this->get_table_info($p);                    
                    $sidebar->sidebar_menu_3[] = $s->menu;
                    if ( !empty($s->notification) )
                    {
                        $sidebar->notification[] = $s->notification;
                    }                    
                }
        } //end switch        

        return $sidebar;
    }

    public function get_item_data($page,$id)
    {        
        $q = 'SELECT * FROM '.$page.' WHERE id = '.$id.' '.($page!='users'?'AND user_id="'.$this->session->user->id.'"':'').' limit 1';
        $res = $this->db->query($q);

        if ($res->num_rows == 0) {
            header('location: '.URL.'admin/error');
        }

        $row = (object)$res->fetch_assoc();

        foreach ($row as $key => $value) {
            if ( preg_match('/(birthday|date)/', $key) ) {                
                $row->$key = $value ? date('Y-m-d',(integer)$value) : '';
            } elseif ( preg_match('/(contact|social)/', $key) ) {
                $row->$key = explode(',',$value);
            } elseif ( preg_match('/(services)/', $key) ) {                
                $row->$key = explode('||',$value);
            } elseif ( preg_match('/(date_created|date_modified|user_id|status)/i', $key) ) {                
                unset($row->$key);
            }
        }
       
        return $row;
    }

    public function get_data_list($page,$status,$params = ['limit'=>10,'current_page'=>1])
    {
        $params = (object)$params;

        $list = (object)[
            'total' => 0,
            'pager' => (object)[
                'total_pages'=>1,
                'current_page'=>$params->current_page,
                'pagers_enabled'=>false,
                'items_per_page'=>$params->limit
            ],
            'data' => []
        ];   

        $list_raw = [];     

        $sort = [
            (object)[
                'title'=>($page!='users'?'Published':'Active'),
                'status'=>'',
                'data'=>[]
            ],
            (object)[
                'title'=>($page!='users'?'Draft':'Waiting'),
                'status'=>'',
                'data'=>[]
            ],
            (object)[
                'title'=>'Trash',
                'status'=>'',
                'data'=>[]
            ]            
        ];
        
        // set ordering vars
        $criteria = 'date_modified'; // default
        $order = 'DESC'; // default
        switch ($page) {
            case 'news':
            case 'articles':
            case 'stories':
                $criteria = $status == 'summary' ? 'date_modified' : 'date_publish';
                break;
            case 'events':
                $criteria = 'event_date';
                break;
            case 'users':
                $criteria = 'permission';
                $order = 'ASC';
                $status = $status == 'published' ? 'active' : ($status == 'draft' ? 'waiting': $status);
                break;
            case 'albums':
                $criteria = 'IF(date_custom<>0 OR date_custom<>NULL,date_custom,date_created)';
                $order = 'DESC';
                $status = 'published';
                break;            
                break;
        }

        
        $stat = $status == 'summary' ? "published' or status='draft' or status='active' or status='waiting' or status='trash" : $status;
        $q = "SELECT * FROM ".$page." WHERE status='".$stat."'";
        $stmt = $this->db->query($q);

        if ( $stmt->num_rows > 0 )
        {    
            $list->total = $stmt->num_rows;
            $list->pager->total_pages = ceil($list->total/$list->pager->items_per_page);

            $offset = ($list->pager->current_page-1) * $list->pager->items_per_page;
            $limit = $list->pager->items_per_page;

            $q = "SELECT * FROM ".$page." WHERE status='".$stat."' ORDER BY ".$criteria.($status!='summary'?" ".$order." LIMIT ".$offset.",".$limit:'');       
            $stmt = $this->db->query($q);
            while ( $row = $stmt->fetch_assoc() )
            {
                // get photos count if albums
                if ($page=='albums') {
                    
                    if ($row['id']==1) {
                        $res = $this->db->query("SELECT id FROM photos WHERE album_id=".$row['id']." AND user_id=".$this->session->user->id);
                    }
                    else
                    {
                        $res = $this->db->query("SELECT id FROM photos WHERE album_id=".$row['id']);
                    }

                    $row['photos_count'] = isset($res->num_rows) ? $res->num_rows : 0;
                }                
                $list_raw[] = (object)[
                    'title'=>isset($row['title'])?$row['title']:(isset($row['username'])?$row['username']:(isset($row['name_first'])?$row['name_first'].' '.$row['name_last']:'')),
                    'data'=>(object)$row
                ];                             
            }
        }

        //if status is summary, list should be groups of items according to status
        if ( count($list_raw) > 0 && $status == 'summary' )
        {
            foreach ($list_raw as $item) {

                if ($item->data->status=='published'||$item->data->status=='active')
                {
                    $sort[0]->data[] = $item;
                    $sort[0]->status = $item->data->status;                    
                }               
                elseif ($item->data->status=='draft'||$item->data->status=='waiting')
                {
                     $sort[1]->data[] = $item; 
                     $sort[1]->status = $item->data->status;   
                }
                elseif ($item->data->status=='trash')
                {
                     $sort[2]->data[] = $item;
                     $sort[2]->status = $item->data->status;
                }
            }

            $list->data = $sort;            
        }       
        else
        {
            $list->data = $list_raw;
        }

        return $list;
    }    

    //loads a list of pastors from the database
    public function get_pastors_list()
    {      
        $pastors = [];
        $q = 'SELECT * FROM pastors WHERE status="published"';
        $res = $this->db->query($q);
        if ($res->num_rows > 0)
            {
                while ( $row = $res->fetch_assoc() )
                {
                    $pastors[] = (object)$row;
                }
            }        
        return $pastors;
    }

    //gets info of an album
    public function get_album_info($id)
    {
        $album = (object)[

        ];

        $q = "SELECT * FROM albums WHERE id=".$id." LIMIT 1";
        $res = $this->db->query($q);
        if ($res->num_rows > 0)
        {
            $row = $res->fetch_assoc();
            $res = $res = $this->db->query("SELECT id FROM photos WHERE album_id=".$id);
            $row['photos_count'] = isset($res->num_rows) ? $res->num_rows : 0;
            return (object)$row;
        }
    }

    //gets list of albums
    public function get_album_list()
    {
        $albums = [

        ];

        $q = "SELECT * FROM albums";
        $res = $this->db->query($q);
        if ($res->num_rows > 0)
        {
            while ( $row =  $res->fetch_object())
            {                
                if ($row->title == 'Default Album') {
                    if ($this->session->user->id==1) {
                        $albums[] = $row;
                    }
                }
                else
                {
                    $albums[] = $row;
                }
            }           
        }
        return $albums;
    }


    //checks if gallery form is submitted
    public function check_gallery_submit()
    {
        $info = (object)[
            'type'=>'',
            'content'=>''
        ];
       
        $error = 0;
        $success = 0;

        if (isset($this->post->delete_selected))
        {            
            if (isset($this->post->checked_thumbnails) && count($this->post->checked_thumbnails)>0) {  
                $ids = $this->post->checked_thumbnails;              
                foreach ($ids as $key => $id) {
                    //check if image exists in database
                    $res = $this->db->query("SELECT img_filename FROM photos WHERE id = ".$id." LIMIT 1");

                    if ($res->num_rows > 0)
                    {
                        $q = "DELETE FROM photos WHERE id = ?";
                        $stmt = $this->db->prepare($q);
                        $stmt->bind_param('s',$id);
                        if ($stmt->execute())
                        {
                            if ($stmt->affected_rows > 0)
                            {     
                                $row = $res->fetch_object();                               
                                @unlink(PHOTOS_DIR.$row->img_filename);
                                @unlink(THUMBNAILS_DIR.$row->img_filename);
                                $success++;                      
                                continue;
                            }                       
                        }
                        else
                        {
                            $error++;
                            $info->content .= 'The image with id no. '.$id.' cannot be deleted.<br>';
                        }                        
                    }
                    else
                    {
                        $error++;
                        $info->content .= 'The image with id no. '.$id.' does not exist.<br>';
                    }                    
                }

                $info->type = $error > 0 ? 'error' : 'success';
                $info->content .= $success > 0 ? 'Successfully deleted '.$success.' items.<br>' : '';
            }
        }
        elseif (isset($this->post->move_selected))
        {
            if (isset($this->post->target_album)) {
                if (isset($this->post->checked_thumbnails) && count($this->post->checked_thumbnails)>0) {  
                    $ids = $this->post->checked_thumbnails; 
                    $album_id = $this->post->target_album;             
                    foreach ($ids as $key => $id) {
                        //check if image exists in database
                        $res = $this->db->query("SELECT id FROM photos WHERE id = ".$id." LIMIT 1");

                        if ($res->num_rows > 0)
                        {
                            $q = "UPDATE photos SET album_id = ?,date_modified=UNIX_TIMESTAMP(NOW()) WHERE id = ?";
                            $stmt = $this->db->prepare($q);
                            $stmt->bind_param('ss',$album_id,$id);
                            if ($stmt->execute())
                            {
                                if ($stmt->affected_rows > 0)
                                {     
                                    $success++;                                     
                                    continue;
                                }                       
                            }
                            else
                            {
                                $error++;
                                $info->content .= 'The image with id no. '.$id.' cannot be moved.<br>';
                            }                        
                        }
                        else
                        {
                            $error++;
                            $info->content .= 'The image with id no. '.$id.' does not exist.<br>';
                        }                    
                    }
                    $info->type = $success > 0 ? 'success' : 'error';
                    $info->content .= $success > 0 ? 'Successfully moved '.$success.' item'.($success>1?'s':'').'.<br>' : '';
                }
            }
            else
            {
                $info->type = 'error';
                $info->content = 'Please select a target album.';
            }
        }

        if ($success > 0) {
            $q = "UPDATE albums SET date_modified=UNIX_TIMESTAMP(NOW()) WHERE id = ?";
            $stmt = $this->db->prepare($q);
            $stmt->bind_param('s',$album_id);
            if (!$stmt->execute())
            {
                if ($stmt->affected_rows > 0)
                {     
                    $error++;                      
                    $info->content .= 'The album\'s info was not updated.';
                }                       
            }
        }

        return $info;        
    }

    //gets a list of the photos of an album
    public function get_album_photos($id)
    {
        $photos = [];

        if ($id==1)
        {
            $q = "SELECT p.id,p.img_url,p.img_caption,p.img_filename,p.img_title,p.img_thumbnail,DATE(FROM_UNIXTIME(p.date_created)) as date_created,DATE(FROM_UNIXTIME(p.date_modified)) as date_modified,p.date_modified as modified_timestamp, p.user_id,u.username FROM photos as p INNER JOIN users as u ON p.user_id = u.id WHERE album_id = ".$id." AND user_id = {$this->session->user->id} ORDER BY modified_timestamp DESC";
        }
        else
        {
            $q = "SELECT p.id,p.img_url,p.img_caption,p.img_filename,p.img_title,p.img_thumbnail,DATE(FROM_UNIXTIME(p.date_created)) as date_created,DATE(FROM_UNIXTIME(p.date_modified)) as date_modified,p.date_modified as modified_timestamp, p.user_id,u.username FROM photos as p INNER JOIN users as u ON p.user_id = u.id WHERE album_id = ".$id." ORDER BY modified_timestamp DESC";
        }

        if ($res = $this->db->query($q))
        {
            while ($row = $res->fetch_assoc()) {                
                $photos[] = (object)$row;                
            }
        }
        return $photos;
    }

    //loads indvidual input fields
    //@param an array of the field ids
    //@param arguments such as post values and others
    public function loadFields($page,$data,$method=null)
    {
        $fields = $this->get_field_names($page,$method);
        foreach ($fields as $field) {
            $arr = explode(':', $field);
            $field_title = $arr[0];
            $field_name = $arr[1];
            $field_required = isset($arr[2]) ? $arr[2] : null;
            $field_data_source = $field_name == 'img_url' ? '#image_modal' : '';
            $pastors = preg_match('/(local_churches|outreaches)/', $page) ? $this->get_pastors_list(): [];

            if ( file_exists(APP.'views/admin/fields/'.$field_name.'.php') )
            {
                require APP.'views/admin/fields/_field_top.php';
                require APP.'views/admin/fields/'.$field_name.'.php';                
                require APP.'views/admin/fields/_field_bottom.php';
            }
            else
            {
                require_once APP.'controllers/error.php';
                $error = new Error();
                $error->index();
            }            
        }

        // load meta fields if method != new       
        if (!preg_match('/(new|register)/', $method) && !preg_match('/(edit_profile|change_password)/', $method)) {
            require APP.'views/admin/fields/meta_fields.php';
        }

        return $fields;
    }

    //returns list of field names for each page
    public function get_field_names($page,$method=null)
    {        
        $field_names = null;
        switch ($page) {
            case 'news':
                $field_names = [
                    'Title:title:required',
                    'Description:description',
                    'Summary:summary:required',                    
                    'Featured Image:img_url:required',
                    'Image Caption:img_caption',
                    'Content:content:required',
                    'Tags:tags'
                ];
                break; 
            case 'articles':
                $field_names = [
                    'Title:title:required',
                    'Descpription:description',
                    'Summary:summary:required',
                    'Bible Verse:verse',
                    'Featured Image:img_url:required',
                    'Image Caption:img_caption',
                    'Content:content:required',
                    'Tags:tags'
                ];
                break;  
            case 'stories':
                $field_names = [
                    'Title:title:required',                    
                    'Descpription:description',
                    'Summary:summary:required',                    
                    'Featured Image:img_url:required',
                    'Image Caption:img_caption',
                    'Content:content:required',
                    'Tags:tags'
                ];
                break;  
            case 'events':
                $field_names = [
                    'Title:title:required',                   
                    'Descpription:description', 
                    'Summary:summary:required',
                    'Location:location:required',  
                    'Event Date:event_date:required',
                    'Time:time',                   
                    'Featured Image:img_url:required',
                    'Image Caption:img_caption',                 
                    'Content:content:required',
                    'Tags:tags'
                ];
                break;
            case 'albums':
                $field_names = [
                    'Title:title:required',                    
                    'Descpription:description',                    
                    'Date:date_custom',                    
                    'Tags:tags'
                ];
                break;   
            case 'local_churches':
                $field_names = [
                    'Title:title:required',
                    'Address:address:required',
                    'Pastor:pastor_id',
                    'E-mail:email', 
                    'Contact No:contact',                    
                    'Service Schedules:services',                   
                    'Image:img_url',
                    'Image Caption:img_caption',
                    //'Map Image:map_image',
                    'Map Link:map_url'                    
                ];
                break;
            case 'outreaches':
                 $field_names = [
                    'Title:title:required',
                    'Address:address:required',
                    'Pastor:pastor_id',
                    'E-mail:email', 
                    'Contact No:contact',                    
                    'Service Schedules:services',                   
                    'Image:img_url',
                    'Image Caption:img_caption',
                    //'Map Image:map_image',
                    'Map Link:map_url'                    
                ];
                break;
            case 'about':
                $field_names = [
                    'Title:title:required',                   
                    'Descpription:description',                    
                    'Featured Image:img_url',
                    'Image Caption:img_caption',
                    'Content:content:required',                    
                ];
                break;
            case 'pastors':
                $field_names = [
                    'First Name:name_first:required',
                    'Middle Name:name_middle',
                    'Last Name:name_last:required',
                    'Name Extension:name_ext',
                    'Nickname/Alias:nickname',
                    'Sex:sex:required',
                    'Birthday:birthday:required',
                    'Contact No.:contact',
                    'E-mail Address:email',
                    'Social Network Profiles:social',                    
                    'Photo:img_url',
                    'Photo Caption:img_caption',
                    'Biography:biography:required',
                ];                
                break;
            case 'ministry':
                $field_names = [
                    'Title:title:required',
                    'Description:content:required',
                    'Date Established:date_established:required',                    
                    'Mission:mission',
                    'Vision:vision',
                    'History:history',
                    'Coordinator:coordinator',
                    'Assistant Coordinator:asst_coordinator',
                    'Treasurer:treasurer',
                    'Auditor:auditor',
                    'PRO:pro',
                    'Adviser:adviser',
                    'Social Network Page:social',                                 
                    'Image:img_url',
                    'Image Caption:img_caption'                         
                ];
                break;
           case 'church_meta':
                $field_names = [
                    'Title:title:required',                   
                    'Descpription:description'                                       
                ];
                break;   
            case 'users':
                if ( $method == 'edit' )
                {
                    $field_names = [
                        'Username:username:required',                        
                        'First Name:name_first:required',
                        'Middle Name:name_middle',
                        'Last Name:name_last:required',
                        'Name Extension (if any):name_ext',
                        'Nickname/Alias:nickname',
                        'Sex:sex:required',
                        'Birthday:birthday:required',
                        'Contact No.:contact',
                        'E-mail Address:email:required',
                        'Photo:img_url',
                        'Photo Caption:img_caption',
                        'Access Permission Level:permission:required'
                    ];
                }
                elseif ( $method == 'new' )
                {                    
                    $field_names = [
                        'Username:username:required',
                        'Passsword:password:required',
                        'Repeat Password:repeat_password:required',
                        'First Name:name_first:required',                        
                        'Last Name:name_last:required',                        
                        'Sex:sex:required',
                        'Birthday:birthday:required',                        
                        'E-mail Address:email:required'                                               
                    ];
                }
                elseif ( $method == 'edit_profile' )
                {                    
                    $field_names = [
                        'Username:username:required',                        
                        'First Name:name_first:required',
                        'Middle Name:name_middle',
                        'Last Name:name_last:required',
                        'Name Extension (if any):name_ext',
                        'Nickname/Alias:nickname',
                        'Sex:sex',
                        'Birthday:birthday',
                        'Contact No.:contact',
                        'E-mail Address:email',
                        'Photo:img_url',
                        'Photo Caption:img_caption'                                               
                    ];
                }
                elseif ( $method == 'change_password' )
                {                    
                    $field_names = [
                        'New Password:password:required',                        
                        'Repeat New Password:repeat_password:required'                            
                    ];
                }
                else
                {
                    $field_names = [
                        'Username:username:required',                        
                        'First Name:name_first:required',
                        'Middle Name:name_middle',
                        'Last Name:name_last:required',
                        'Name Extension (if any):name_ext',
                        'Nickname/Alias:nickname',
                        'Sex:sex',
                        'Birthday:birthday',
                        'Contact No.:contact',
                        'E-mail Address:email:required',
                        'Photo:img_url',
                        'Photo Caption:img_caption',
                        'Access Permission Level:permission:required'                   
                    ];
                }
                break;
            case 'site_settings':
                $field_names = [                                    
                    'Content:content'
                ];
                break;            
        }
        return $field_names;
    }

    //process post values to change into accepted formats for database
    public function process_post_values()
    {    
        $fields = [
                    'date_established',
                    'date_custom',
                    'date_publish',
                    'birthday',
                    'date',
                    'event_date',
                    'password',
                    'contact',
                    'social',
                    'services',
                    'content'
                ];

        foreach ($fields as $key => $field) {
            if ( !empty($this->post->$field) ) {
                switch ($field) {
                   
                    case 'date_established' :                    
                    case 'date_custom' :
                    case 'birthday' :
                    case 'date' :
                    case 'event_date' :
                        $this->processed_post[$field] = strtotime($this->post->$field);
                        break;

                    case 'contact' :
                    case 'social' :
                        $this->processed_post[$field] = implode(',', $this->post->$field);
                        break;

                    case 'password' :                    
                        $this->processed_post[$field] = crypt($this->post->$field,$this->salt());                        
                        break;

                    case 'services' :                    
                        $this->processed_post[$field] = implode('||', $this->post->$field);
                        break;

                    case 'content' : 
                        preg_match('/(class=").+\"/', $this->post->$field, $match);
                        // var_dump($this->post->$field);
                        $this->processed_post[$field] = preg_replace('/(class=[\"])[^\"]+[\"]/', '', $this->post->$field);
                        preg_match_all('/(class=[\"])[^\"]+[\"]/', $this->processed_post[$field], $matches);
						break;
                    
                    default:
                        # code...
                        break;
                }
            }
        }

    }

    /**  
        * validates post values according to parameters
        * @param $arr = array of 'Field Label : fieldname : required' combinations (ex ['Username:username:required','Password:password:required','Last Name:name_first'])      
        * @param $method = string, if new, edit, trash, etc.
        * @param $page = string, the database table name
        * @param $id = integer, the id number of the entry
    */
    public function validate_post_values($arr,$method=null,$page=null,$id=null)
    {
        $errors = (object)[
            'fields' => [],   //fields which contain errors        
            'message' => ''
        ];
        $empty = false;

        foreach ($arr as $field) {
            $parts = explode(':',$field);
            $label = trim($parts[0]);
            $name = trim($parts[1]);

            // print_r($parts);
            
            /**
            *checks if this field has 'required'
            *if so, check if it is set
            */ 
            if ( !empty($parts[2]) && trim($parts[2]) == 'required' )
            {                
                if ($name == 'contact') {                    
                    if (empty($this->post->$name)) {                        
                        $empty = true;
                        $errors->fields[] = $name; //add this field name to empty                                       
                        continue;
                    }                                    
                }
                else
                {                   
                    if ( empty($this->post->$name) ) //check whether empty
                    {                        
                        $empty = true;
                        $errors->fields[] = $name; //add this field name to empty                        
                        continue;             
                    }                    
                }
            }            
            
            // validate each field
            if ( !empty($this->post->$name) )
            {

                switch ( $name ) //checks for each field values if valid
                {
                    case 'username':  
                         //validate format
                        if ( !preg_match('/^[\d\w_-]+$/', $this->post->$name) )
                        {
                            $errors->fields[] = $name;
                            $errors->message[] = $label.' contains invalid characters.';
                                                    
                        }
                        elseif ( strlen($this->post->$name) < 8 )
                        {
                            $errors->fields[] = $name;
                            $errors->message .= $label.' must be at least 8 characters.<br>';
                        }
                        else
                        {                            
                            // validate availability
                            if ($this->data_exists($page,$name,$id)) {
                                $errors->fields[] = $name;
                                $errors->message .= $label.' already exists.<br>';
                            }
                        }                                                                     
                    case 'password':
                        if ( !preg_match('/^.{8,}+$/', $this->post->$name) )
                        {
                            $errors->fields[] = $name;
                            $errors->message .= $label.' must be at least 8 characters in length.<br>';
                        }
                        break;
                    case 'repeat_password':                                          
                        if ( preg_match('/^.{8,}+$/', $this->post->$name) )
                        {
                            if ( $this->post->password == $this->post->$name )
                            {                                
                                break;
                            }
                        }                        
                        $errors->fields[] = 'password';
                        $errors->fields[] = $name;
                        $errors->message .= 'Passwords didn\'t match.<br>';
                        break;
                    case 'name_first':
                    case 'name_middle':
                    case 'name_last':
                    case 'nickname': 
                    case 'name_ext':                   
                        if ( !preg_match('/^[A-Za-z\s-.]+$/', $this->post->$name) )
                        {
                            $errors->fields[] = $name;                            
                            $errors->message .= $label . ' contains invalid characters.<br> ';                      
                        }                    
                        break;
                    case 'date':                    
                    case 'date_established':
                    case 'date_custom':
                    case 'birthday':
                        if ( !$this->valid_date($this->post->$name) )  
                        {
                            $errors->fields[] = $name;
                            $errors->message .= $label . ' is in invalid format. Accepted example : 2014-03-31<br>';
                        }
                        break;                    
                    case 'time':
                        if ( !$this->valid_time($this->post->$name) )  
                        {
                            $errors->fields[] = $name;                            
                            $errors->message .= $label . ' is in invalid format. Accepted example : 4:08 am<br>';
                        }
                        break;
                    case 'contact':                        
                        foreach ($this->post->$name as $key => $c)
                        {                                                    
                            if ( !$this->valid_contact($c) )  
                            {                                
                                $errors->fields[] = $name.'['.$key.']';                            
                                $errors->message .= 'invalid contact number format<br>';
                            }
                        }                                                              
                        break;
                    case 'social':                        
                        foreach ($this->post->$name as $key => $social)
                        {                                                    
                            if ( !preg_match('/^http[s]?:\/\//', $social) )  
                            {                                
                                $errors->fields[] = $name.'['.$key.']';                            
                                $errors->message .= 'Invalid url format for the social network link.<br>';
                            }
                        }                                                              
                        break;
                    case 'services':
                        foreach ($this->post->$name as $key => $service)
                        {    
                            if ( !$obj = json_decode($service) ) 
                            {
                                $errors->fields[] = $name.'['.$key.']';                            
                                $errors->message .= 'Invalid format for the Service Schedule<br>';
                            }
                        }                                                              
                        break;
                    case 'email':
                        // validate availability
                        if (!$this->data_exists($page,$name,$id)) {                            
                            //validate format
                            if ( !$this->valid_email($this->post->$name) )  
                            {
                                $errors->fields[] = $name;                            
                                $errors->message .= 'invalid email format<br>';
                            }
                        }
                        else
                        {
                            $errors->fields[] = $name;
                            $errors->message .= $label.' already exists.<br>';
                        }
                        break;     
                }
            }            
        }

        if ( $empty )
        {
            $errors->message .= 'Required fields cannot be empty.<br>';                    
        }

        return $errors;
    }

    //this is for add_new method, which checks if there is post values submitted
    public function check_add_submit($page,$method = null)
    {        
        $info = (object)[
            'type'=>'error',
            'content'=>'',
             'button' => (object)[
                'title' => '',
                'link' => ''
            ]                
        ];

        $errors = (object)[
            'fields'=>[],
            'message'=>''
        ];

        if ($page!='users') {
            $status = isset($this->post->publish) ? 'published' : ( isset($this->post->save_draft) ? 'draft' : null);
        }
        else
        {
            $status = isset($this->post->publish) ? 'active' : ( isset($this->post->save_draft) ? 'waiting' : null);
        }

        if (isset($status))
        {
            //sets the fields to be validated according to page
            $validate_fields = $this->get_field_names($page);
            
            //validates values
            $errors = $this->validate_post_values($validate_fields,'new');            

            //if there are invalid values, generate error message
            if ( count($errors->fields) > 0 )
            {
                $info->content = $errors->message;               
            }
            else //if values are valid, perform db insert
            {
                $insert = $this->insert_db($page,$status);

                if (!empty($insert->errors->message))
                {
                    $info->content = $insert->errors->message;
                }
                else
                {   
                    // if this is an ajax request
                    // get the latest published post
                    $q = "SELECT * FROM {$page} WHERE status='published' ORDER BY id DESC LIMIT 1";
                    $res = $this->db->query($q);
                    $row = $res->fetch_object();

                    $latest_published = $row->id;

                    $info = (object)[     
                        'id' => $latest_published,                      
                        'page' => $page,
                        'type' => 'success',
                        'content' => 'Successfuly Added New Entry.',
                        'button'=> (object)[
                                    'title'=>'',
                                    'link'=>''
                                ],
                        'post_info' => $row
                    ];
                }
            }
        }
        else
        {
            $info = null;            
        }

        return (object)[   
            'errors'=>$errors,         
            'info' => $info,
            'status'=>$status
        ];
    }

    //this is for add_new method, which checks if there is post values submitted
    public function check_edit_submit($page,$id,$method='edit')
    {
        $has_post = true;        

        $info = (object)[
            'type'=>'error',
            'content'=>'',
             'button' => (object)[
                'title' => '',
                'link' => ''
            ]
        ];

        $errors = (object)[
            'fields'=>[],
            'message'=>''
        ];

        // set the new status depending on the post
        if (isset($this->post->publish))
        {           
            $status = 'published';
        }
        elseif (isset($this->post->activate))
        {            
            $status = 'active';
        }
        elseif (isset($this->post->save_draft))
        {            
            $status = 'draft';
        }
        elseif (isset($this->post->save))
        {
            $meta = (array)$this->get_item_meta($page,$id);

            if (!preg_match('/(change_password|edit_profile)/', $method)) {
                $method = 'save';
            }

            $status = $meta['Current Status'];
        }
         elseif (isset($this->post->deactivate))
        {
            $status = 'waiting';
        }
        else
        {
            $has_post = false;
            $status=null;
        }

        // if profile changes, set the id to user id
        if (preg_match('/(edit_profile|change_password)/', $method)) {
            $id = $this->session->user->id;
        }        
        if ($has_post)
        {
            //sets the fields to be validated according to page 
            $validate_fields = $this->get_field_names($page,$method); 
           
            //validates values
            $errors = $this->validate_post_values($validate_fields,$method,$page,$id);

            if (empty($errors->message)) //if values are valid, perform db update
            {                
                $update = $this->update_db($page,$id,$status,$method);

                if (isset($update->error))
                {
                    $info->content = $update->error;
                }
                else
                {    
                    $goto = '';

                    // send mail to user when activated;
                    if ($page=='users' && isset($this->post->publish)) {                       
                        $to = 'isi.jaysonbuquia@gmail.com';
                        $subject = 'Test';
                        $msg = 'Success';
                        $headers = 'From: nyahaha';
                        mail($to,$subject,$msg,$headers);
                    }

                    $info->type = 'success';

                    // set info button title depending on status/method
                    if ($page!='albums') {

                        // set the msg_part
                        if ( preg_match('/(save|edit_profile|change_password)/', $method) )
                        {
                            $msg_part = 'saved changes.';                            
                        }
                        else
                        {                            
                            if ($status == 'published')
                            {
                                $msg_part = 'published';
                                $btn_part = 'Published';
                            }
                            elseif ($status == 'draft')
                            {
                                $msg_part = 'saved';
                                $btn_part = 'Drafts';
                            }
                            elseif ($status == 'active')
                            {
                                $msg_part = 'activated';
                                $btn_part = 'Actives';
                            }
                            elseif ($status == 'waiting')
                            {
                                $msg_part = 'deactivated';
                                $btn_part = 'Waiting';
                            }

                            $msg_part.' entry.';

                            // set the btn_part
                            if ($status == 'published')
                            {
                                $btn_part = 'Published';
                            }
                            elseif ($status == 'draft')
                            {
                                $btn_part = 'Drafts';
                            }
                            elseif ($status == 'active')
                            {
                                $btn_part = 'Actives';
                            }
                            elseif ($status == 'waiting')
                            {
                                $btn_part = 'Waiting';
                            } 

                        }                       

                                   
                    }
                    else
                    {
                        $msg_part = 'saved changes.';

                        $btn_part = 'Albums';
                        $status = $update->status;
                    }
                    
                    
                    $info->content = 'Successfuly '.$msg_part;

                    if (isset($btn_part)) {
                        $info->button->title = 'Go to '.$btn_part.' List';
                        $info->button->link = URL.'admin/view/'.$page.'/'.$status;
                    }                   
                    
                }
            }
            else
            {
                $info->type = 'error'; 
                $info->content = $errors->message;                
            }
        }
        else
        {
            $info = null;            
        }

        return (object)[   
            'errors'=>$errors,            
            'info' => $info,
            'status'=>$status
        ];
    }

    // checks if post is submitted in password change page
    public function check_passwordChange_submit()
    {
        $page = 'change_password';

        $info = (object)[
            'type'=>'error',
            'content'=>'',
             'button' => (object)[
                'title' => '',
                'link' => ''
            ]                
        ];

        $error = (object)[
            'fields'=>[],
            'message'=>''
        ];

        if (isset($this->post->save)) {
            //sets the fields to be validated according to page
            $validate_fields = $this->get_field_names($page,'edit');
            
            //validates values
            $error = $this->validate_post_values($validate_fields);
            //if there are invalid values, generate error message
            if ( count($error->fields) > 0 )
            {
                foreach ($error->message as $msg) {
                    $info->content .= $msg.'<br>';
                }                 
            }
            else //if values are valid, perform db update
            {
                $update = $this->update_db($page,'change_password');
                if (isset($update->error))
                {
                    $info->content = $update->error;
                }
                else
                {    
                    // send mail to user when activated;
                    if (isset($this->post->activate)) {
                        $to = 'isi.jaysonbuquia@gmail.com';
                        $subject = 'Test';
                        $msg = 'Successfully changed password';
                        $headers = 'From: nyahaha';
                        mail($to,$subject,$msg,$headers);
                    }

                    $info->type = 'success';
                    $info->content = 'Password changed successfuly!';                   
                }
            }
        }        

        return (object)[   
            'error'=>$error,         
            'info' => $info           
        ];
    }


    // returns table columns for each page
    // this is for database operations
    public function get_column_names($page,$method,$status)
    {        
        $fields_raw = $this->get_field_names($page,$method);

        $field_names = [];

        foreach ($fields_raw as $key => $field) {

            $field_name = explode(':', $field)[1];
            $is_valid = false;

            // check if field name is valid to be included
            switch ($field_name) {
                case 'repeat_password':
                    if ( 
                            ($page=='users' && $method=='new') ||
                            ($page=='users' && $method=='change_password')
                        )
                    {
                        $is_valid = false;
                    }                   
                    else
                    {
                        $is_valid = true;
                    }                    
                    break;
                
                default:
                    $is_valid = true;
                    break;
            }

            // if valid
            if ($is_valid) {
                $field_names[] = $field_name  ;
            }
        }

        // add special columns        
        if (!empty($field_names)) {

            // add info columns
            foreach (['permission'] as $value) {
                switch ($value) {
                    case 'permission':
                        if ($page=='users' && $method=='new') {
                            continue;
                        }  
                        $value = null;                                                                                
                        break;                                                    
                    default:                       
                        break;
                }

                if (!is_null($value)) {
                    array_push($field_names, $value);
                }                
            }

            // for ministry page, add title_abbr column
            if ($page == 'ministry') {
                $field_names[] = 'title_abbr';
            }

            // add meta columns
            foreach (['user_id','date_created','date_modified','status','date_publish'] as $value) {
                switch ($value) {
                    case 'user_id':
                        if ($page=='users') {
                            $value = null;
                            continue; 
                        }                                                             
                        break; 
                    case 'date_created':
                        if ($method!='new') {                           
                            $value = null;  
                        }
                        break; 
                    case 'date_publish':                    
                        if (!preg_match('/^(news|articles|stories)$/', $page)) {                           
                            $value = null;                           
                        }
                        elseif (preg_match('/^(news|articles|stories)$/', $page) && $status != 'published') {
                            $value = null;
                        }
                        break;                                     
                    default:
                       
                        break;
                }

                if (!is_null($value)) {
                    array_push($field_names, $value);
                }                
            }                       
        }

        return $field_names;
    }


    // prepares the query statement
    public function prepare_query_statement($page,$method,$id=null,$status,$cols)
    {
        $statement = null;

        // prepare statement
        switch ($method) {

            // if add new entry
            case 'new':

                // prepare cols and values                
                $values = [];

                                    
                foreach ($cols as $key => $col) {                   

                    switch ($col) {
                        case 'date_publish':
                        case 'date_created':
                        case 'date_modified':
                            $values[] = 'UNIX_TIMESTAMP(NOW())';
                            break;                       

                        case 'status':                           
                            if ($page=='users') {
                                $values[] = "'waiting'";
                            }
                            else
                            {
                                $values[] = "'".$status."'";
                            }
                            break;

                        case 'permission':
                            if ($method=='new') {
                                $values[] = "3";
                            }
                            else
                            {
                                $values[] .= '?';
                            }
                            break;

                        case 'user_id':
                            $values[] = $this->session->user->id;
                            break;

                        case 'title_abbr':
                            // get the abbreviation of the title
                            $abbr = '';
                            foreach (explode(' ', $this->post->title) as $value) {
                                $abbr .= strtoupper(substr($value, 0,1));
                            };                            
                            $values[] = "'". $abbr ."'";
                            break;
                        
                        default:
                            $values[] .= '?';
                            break;
                    }
                    
                } 

                $statement .= "INSERT INTO ".$page." (".implode(',', $cols).") VALUES (".implode(',',$values).")";
 
                break;

            // if edit entry
            case 'edit': 
            case 'save': 
            case 'change_password':
            case 'edit_profile':

                // prepare cols and values
                $q = [];

                foreach ($cols as $key => $col) {
                    switch ($col) 
                    {
                        case 'date_modified' :
                            $q[] = $col.'=UNIX_TIMESTAMP(NOW())';
                        break;
                        case 'date_publish' :
                            $q[] = $col.'=UNIX_TIMESTAMP(NOW())';
                            break;
                        case 'user_id' :
                            $q[] = $col.'="'.$this->session->user->id.'"';     
                            break;                       
                        case 'status' :                            
                            $q[] = $col.'="'.$status.'"';
                        break;
                        case 'title_abbr':
                            // get the abbreviation of the title
                            $abbr = '';
                            foreach (explode(' ', $this->post->title) as $value) {
                                $abbr .= strtoupper(substr($value, 0,1));
                            };                            
                            $q[] = $col."='". $abbr ."'";
                            break;
                        default :
                            $q[] = $col.'=?';
                        break;

                    }
                };
                
                $statement = 'UPDATE '.$page.' SET '.implode(",", $q).' WHERE id='.$id;

                break;

            
            default:
                # code...
                break;
        }       

        return $statement;
    }


    // prepares the bind parameters
    public function get_bind_params($page,$cols,$method)
    {
        $bind_params = [];
        $types = '';

        // process post values that shouldn't be used as is
        $this->process_post_values();

        // create references for each column value       
        foreach ($cols as $key => $col_name) {            

            switch ($col_name) {
                
                case 'date_established':
                case 'date_custom':
                case 'birthday':
                case 'date':
                case 'event_date':
                case 'contact':
                    $bind_params[] =& $this->processed_post[$col_name];                    
                    $types .= 'i';
                    break;

                case 'password':                    
                case 'social':
                case 'services':                      
                    $bind_params[] =& $this->processed_post[$col_name];                    
                    $types .= 's';
                    break;

                case 'date_modified' :
                case 'date_created' :
                case 'date_publish' :                
                case 'user_id':                              
                case 'status':
                case 'title_abbr':
                    unset($cols[$key]);
                    break;

                case 'permission':
                    if ($method=='new') {
                        unset($cols[$key]);
                    }
                    else
                    {
                        $bind_params[] =& $this->post->$col_name;
                        $types .= 'i';
                    }
                    break;
                                        
                default:
                    $bind_params[] =& $this->post->$col_name;                    
                    $types .= 's';
                    break;

            }
            
        }

        array_unshift($bind_params, $types);

        return $bind_params;
    }
    
    // prepares bind parameters
    public function get_query_params($page,$method,$id=null,$status)
    {
        $query_params = null;

        // if all required args are not empty
        if ($page&&$method) {            

            // get column names
            $cols = $this->get_column_names($page,$method,$status);

            // prepare query statement
            $query_statement = $this->prepare_query_statement($page,$method,$id,$status,$cols);

            // prepare bind parameters
            $bind_params = $this->get_bind_params($page,$cols,$method);

            $query_params = (object)[
                'statement'=>$query_statement,
                'bind_params'=>$bind_params
            ];

        }

        return $query_params;
        
    }


    //insert new data to database
    public function insert_db($page,$status=null)
    {
        $insert = (object)[
            "errors"=>null,
            "id"=>null,
            "status"=>''
        ];       

        // change page value and method if edit_profile, etc.
        if (preg_match('/(edit_profile|change_password)/', $page)) {
            $method = $page;
            $page =  'users';
        }

        // prepare query parameters
        $query_params = $this->get_query_params($page,'new',null,$status);

        $stmt = $this->db->prepare($query_params->statement);

        // if prepared statement is valid,
        if ($this->db->errno == 0) {            
            // check if $stmt is a valid db query statement,
            // perform insert_db if true,
            // else, output a readable error
            if (is_object($stmt) && method_exists($stmt, 'bind_param')) {

                // check if valid bind params
                if (call_user_func_array([$stmt,'bind_param'], $query_params->bind_params)) {
                    
                    // execute
                    $stmt->execute();

                    if ($stmt->errno > 0 )
                    {                     
                        $insert->errors = (object)[
                            'message'=> 'Unable to add new entry.<br>'.$this->db->error
                        ];
                    }
                    else
                    {                    
                        $q = "SELECT MAX(id) AS id,status FROM {$page} LIMIT 1";
                        $res = $this->db->query($q);                        

                        if ($res->num_rows > 0) {
                            $row = $res->fetch_object();
                            $insert->id = $row->id;
                            $insert->status = $row->status;
                        }
                    }

                }

            }
            else
            {            
                $insert->errors = (object)[
                    'message'=>'Unable to add new entry.<br>'.$this->db->error
                ];            
            }
        }
        else
        {        
            // handle error in prepared statement
            $insert->errors = (object)[
                    'message'=>$this->db->error
                ];  
        }

        return $insert;
    }

    //update data in database
    public function update_db($page,$id=null,$status='published',$method='edit')
    {        
        $update = (object)[
            "error"=>null,
            "id"=>$id,
            "status"=>$status,
        ];
        
        // change page value and method if edit_profile, etc.
        if (preg_match('/(edit_profile|change_password)/', $method)) {            
            $method = $method;
            $page =  'users';            
        }

        // get column names
        $query_params = $this->get_query_params($page,$method,$id,$status);        

        $stmt = $this->db->prepare($query_params->statement);

        // check if $stmt is a valid db query statement,
        // perform update_db if true,
        // else, output a readable error
        if (is_object($stmt) && method_exists($stmt, 'bind_param')) {

            // check if valid bind params
            if (call_user_func_array([$stmt,'bind_param'], $query_params->bind_params)) {
                
                // execute
                $stmt->execute();

                if ($stmt->errno > 0 )
                {                     
                    $update->errors = (object)[
                        'message'=> 'Unable to edit entry.<br>'.$this->db->error
                    ];
                }
                else
                {                    
                    $stmt->close();
                }

            }

        }        

        return $update;
    }

    //this is for view method, which returns the page title
    public function get_view_title($page,$status)
    {        
        foreach (['news','articles','stories','events','local_churches','outreaches','about','pastors','ministry','church_meta'] as  $p) {
            if ( $page == $p )
            {
                return ($status=='published'?'Published items':($status=='draft'?'Drafts':($status=='trash'?'Trashed items':'Summary of items'))).' for '.ucwords(str_replace('_', ' ', $page));
            }
        } 

        if ( $page == 'users' )
        {
            return ($status=='active'?'Activated Users items':($status=='waiting'?'Awaiting Activation Requests':'Summary of Users'));
        }  
        elseif ( $page == 'albums' )
        {
            return 'Published Albums';
        } 
         elseif ( $page == 'site_settings' )
        {
            return 'Site Settings';
        }     
    }

    //check if there is status change request in view method
    public function check_status_change($method='view')
    {

        $info = null;        

        if (!empty($this->post->modal_field_id) || isset($this->post->multiple_trash) || isset($this->post->multiple_delete) || isset($this->post->multiple_delete)) {
            $info = (object)[
                'id' => null,
                'page' => null,
                'type'=>'error',
                'content'=>'',
                 'button' => (object)[
                    'title' => '',
                    'link' => ''
                ]                
            ];

            $ids = isset($this->post->modal_field_id) ? explode(',',$this->post->modal_field_id) : $this->post->items_checked; //should be an array in case of multiple inputs            
            $new_status = isset($this->post->multiple_trash) || isset($this->post->modal_trash)? 'trash' :
                            (isset($this->post->modal_publish) || isset($this->post->publish) ? 'published' : 
                                (isset($this->post->modal_activate) ? 'active' :
                                    (isset($this->post->modal_deactivate) ? 'waiting' :
                                        (isset($this->post->modal_delete) || isset($this->post->multiple_delete) ? 'delete' :
                                            ( isset($this->post->modal_restore) ? 'draft' : null )))));

            // get the page name
            $page = call_user_func(function ()
            {
                $page_name = null;

                foreach (['source_page','modal_field_page','page'] as $post_name) {
                    if (isset($this->post->$post_name)) {
                        $page_name = $this->post->$post_name;
                        break;
                    }
                }

                return $page_name;

            });
            
            $published = [];
            $activated = []; 
            $drafted = [];           
            $trashed = [];
            $restored = [];
            $deactivated = [];
            $not_found = [];
            $deleted = [];
            $error = [];
           
            foreach ($ids as $i) {                
                if (preg_match('/^(published)|(active)|(draft)|(waiting)|(trash)$/', $new_status))
                {                    
                    //check if such item id is users' entry
                    $q = "SELECT id FROM ".$page." WHERE id=".$i." LIMIT 1";
                    $res = $this->db->query($q);

                    if ( $res && $res->num_rows > 0)
                    {   
                        switch ($page) {
                            case 'users':
                                $q = "UPDATE ".$page." SET status='".$new_status."' WHERE id=".$i;
                                break;                            
                            default:
                                $q = "UPDATE ".$page." SET status='".$new_status."',date_modified=UNIX_TIMESTAMP(NOW()),user_id='".$this->session->user->id."' WHERE id=".$i;
                                break;
                        }                        
                        
                        $r = $this->db->query($q);                        

                        if ( $this->db->affected_rows > 0)
                        {
                            switch ($new_status) {
                                case 'published':
                                    $published[] = $i;
                                    break;
                                case 'draft':
                                    $restored[] = $i;
                                    break;
                                case 'active':
                                    $activated[] = $i;
                                    // get user's email from database
                                    $q = "SELECT email FROM users WHERE id=".$i;
                                    $res = $this->db->query($q);
                                    if ($res->num_rows > 0) {
                                        $row = $res->fetch_object();
                                        $email = $row->email;
                                        $this->send_mail('user_activated',$email);
                                    }
                                    break;
                                case 'trash':
                                    $trashed[] = $i;
                                    break;
                                case 'waiting':
                                    $deactivated[] = $i;
                                    break;
                                default:
                                    $drafted[] = $i;
                                    break;
                            }                            
                        }
                        else
                        {
                            $error[] = $i;
                        }
                    }
                    else
                    {                        
                        $not_found[] = $i;
                    }
                }
                elseif ( $new_status == 'delete' )
                {
                    $q = "DELETE FROM ".$page." WHERE id=".$i;
                    $res = $this->db->query($q);

                    // if albums, delete photos in it
                    if ( isset($this->db->affected_rows) && $this->db->affected_rows > 0)
                    {                        
                        if ($page=='albums') {
                            $res = $this->db->query("SELECT id,img_url,img_filename FROM photos WHERE album_id=".$i);
                           
                            // if there are album's photos in the database, delete these entries                           
                            if ($res->num_rows>0) {
                                while ($file = $res->fetch_object()) {
                                    // Delete the file                                    
                                    if (unlink(PHOTOS_DIR.$file->img_filename)) {
                                        @unlink(THUMBNAILS_DIR.$file->img_filename);
                                        // Delete the database entry
                                        $r = $this->db->query("DELETE FROM PHOTOS WHERE id = ".$file->id);                                        
                                    }                                    
                                }
                            }
                        }
                        
                        $deleted[] = $i;
                    }
                    else
                    {                                              
                        $error[] = $i;
                    }
                }
            }

            if ( count($published) > 0 )                       
            {
                $info->type = 'success';
                $info->content .= 'You have successfully published '.count($published).' item(s).';                
                $info->button->title = 'Go to Published';
                $info->button->link = URL.'admin/view/'.$page.'/published';               
            }
            if ( count($activated) > 0 )                       
            {
                $info->type = 'success';
                $info->content .= 'You have successfully activated '.count($activated).' item(s).';               
                $info->button->title = 'Go to Active';
                $info->button->link = URL.'admin/view/'.$page.'/active';
            }
            if ( count($trashed) > 0 )                       
            {
                $info->type = 'success';
                $info->content .= 'You have successfully trashed '.count($trashed).' item(s).';               
                $info->button->title = 'Go to Trash';
                $info->button->link = URL.'admin/view/'.$page.'/trash';
            }
            if ( count($restored) > 0 )                       
            {
                $info->type = 'success';
                $info->content .= 'You have successfully restored '.count($restored).' item(s) to Draft.';                
                $info->button->title = 'Go to Draft';
                $info->button->link = URL.'admin/view/'.$page.'/draft';               
            }
            if ( count($deactivated) > 0 )                       
            {
                $info->type = 'success';
                $info->content .= 'You have successfully deactivated '.count($deactivated).' item(s).';               
                $info->button->title = 'Go to Waiting';
                $info->button->link = URL.'admin/view/'.$page.'/waiting';
            }
            if ( count($deleted) > 0 )                       
            {
                $info->type = 'success';
                $info->content .= 'You have successfully deleted '.count($deleted).' item(s).';                               
            }
            if ( count($error) > 0 )                       
            {
                $info->type = 'warning';
                $info->content .= 'Requested operation cannot be performed on '.count($error).' item(s).';                           
            }
            if ( count($not_found) > 0 )                       
            {
                $info->type = 'warning';
                $info->content .= count($not_found).' item(s) cannot be found from this list.';
            }


            // if this request is from AJAX
            if ( $method == 'ajax' ) {
                $info->id = $ids[0];
                $info->page = $page;
            }


        }

        return $info;
    }

    //check if there is request for multiple items status change through post
    public function check_view_submit()
    {
        $info = $this->check_status_change();

        return $info;
    }

    // upload a single image through ajax
    public function upload_single($album_id = 1)
    {
        //vars  
        $db = $this->db;        
        $folder = PHOTOS_DIR;
        $user_id = $this->session->user->id;   
        $return = (object)[
            'error'=>null,
            'uploaded'=>null,
            'filename'=>''
        ];  
    
        if (isset($_FILES['file']))
        {
            $file = (object)$_FILES['file'];

            if (preg_match('/(.jpg)|(.jpeg)|(.png)$/i', $file->name))
            {
                $unique_prefix = rand(111111,999999).'_'.time();  
                $title = str_replace(' ', '_', $file->name);
                $filename = $unique_prefix.'_'.$title;

                if (move_uploaded_file($file->tmp_name, $folder.str_replace(' ', '_', $filename)))
                {                                      
                    $url = URL.'public/img/photos/'.$filename;                    
                    $thumbnail = $this->make_thumb($filename);

                    $q = "INSERT INTO photos (img_url,album_id,img_filename,img_title,img_thumbnail,date_created,date_modified,status,user_id) VALUES (?,?,?,?,?,UNIX_TIMESTAMP(NOW()),UNIX_TIMESTAMP(NOW()),'published',?)";
                    $stmt = $db->prepare($q);                   

                    if ($stmt->bind_param('ssssss',$url,$album_id,$filename,$title,$thumbnail,$user_id))
                    {
                        if ($stmt->execute())
                        {
                            if ($db->affected_rows > 0)
                            {
                                $res = $db->query("SELECT id FROM photos ORDER BY date_modified DESC LIMIT 1");                         
                                $row = $res->fetch_assoc();

                                $return->uploaded = (object)[
                                    'filename'=>$filename,
                                    'title'=>$title,
                                    'size'=>$file->size/1000,
                                    'url'=>$url,  
                                    'thumbnail'  =>$thumbnail,
                                    'id'=>$row['id'],               
                                    'album'=>$album_id
                                ];
                            }                   
                        }
                        $return->error = 'Unable to upload. Database error';
                    }
                    $return->error = $db->error;                
                }
                else
                {
                    $return->error = 'Unable to upload the file. The file size might be too large.';
                    $return->filename = $file->name;
                }
            }
            else
            {
                $return->error = 'Invalid file format. Accepted image file formats are jpep and png only.';
            }       
        }
        else
        {
            $return->error = 'No file selected.';
        }

        return json_encode($return);
    }

    // upload multiple through iframe
    public function upload_multiple($album_id = 1)
    {        
        //vars        
        $errors = [];  
        $db = $this->db;        
        $folder = PHOTOS_DIR;
        $user_id = $this->session->user->id;    
        $return = (object)[
            'error'=>null,
            'uploaded'=>[],
            'filenames'=>[],
            'error_files'=>[],
            'files'=>''
        ];
        
        if (isset($_FILES['file']))
        {
            $files = $_FILES['file'];            

            if (is_array($files)) {
                foreach ($files['name'] as $key => $name) {
                    $file = (object)[
                        'name' => $name,
                        'type' => $files['type'][$key],
                        'tmp_name' => $files['tmp_name'][$key],
                        'error' => $files['error'][$key],
                        'size' => $files['size'][$key]
                    ];
                    if (preg_match('/(.jpg)|(.jpeg)|(.png)$/i', $file->name))
                    {           
                        if (move_uploaded_file($file->tmp_name, $folder.str_replace(' ', '_', $file->name)))
                        {   
                            $url = URL.'public/img/photos/'.str_replace(' ', '_', $file->name);
                            $unique_prefix = rand(111111,999999).'_'.time();
                            $title = str_replace(' ', '_', $file->name);
                            $filename = $title.'_'.$unique_prefix;
                            $thumbnail = $this->make_thumb($file->name);

                            $q = "INSERT INTO photos (img_url,album_id,img_filename,img_thumbnail,date_created,date_modified,status,user_id) VALUES (?,?,?,?,UNIX_TIMESTAMP(NOW()),UNIX_TIMESTAMP(NOW()),'published',?)";
                            $stmt = $db->prepare($q);                            
                            if ($stmt->bind_param('sssss',$url,$album_id,$filename,$thumbnail,$user_id))
                            {
                                if ($stmt->execute())
                                {
                                    if ($db->affected_rows > 0)
                                    {
                                        $res = $db->query("SELECT id FROM photos ORDER BY date_modified DESC LIMIT 1");                         
                                        $row = $res->fetch_assoc();                         

                                        $return->uploaded[] = (object)[
                                            'filename'=>$file->name,
                                            'title'=>$title,
                                            'size'=>$file->size/1000,
                                            'url'=>$url,    
                                            'id'=>$row['id'],               
                                            'album'=>$album_id
                                        ];                                      

                                        continue;
                                    }                   
                                }
                                else
                                {
                                    $return->error .= 'Unable to upload '.$file->name.'. Database error.<br>';
                                    $return->filenames[] = $file->name;
                                }
                            }
                            else
                            {
                                $return->error .= $db->error.'<br>';    
                            }                                   
                        }
                        else
                        {
                            $return->error .= 'Unable to upload the '.$file->name.'. The file size might be too large.<br>';                        
                        }
                    }
                    else
                    {
                        $return->error = $file->name.' cannot be uploaded. Must be an image file.<br>';                 
                    }               
                }           
            }                       
        }
        else
        {
            $return->error = 'No file selected.';
        }        
            
        return json_encode($return);
    }

    /* function to create the image thumbnail */
    /* $src = the path to the source image file */
    /* $desired_width = your desired thumbnail width, default is 100 if unspecified */
    public function make_thumb($filename) {
        // vars   
        $src = PHOTOS_DIR.$filename;
        $dest = THUMBNAILS_DIR.$filename;
        $desired_width = 200;
        $source_image = null;
        $img_thumbnail = URL.'public/img/photos/'.$filename; // default value is the original image file

        /* if source image is given */
        if ($src) {

            if (preg_match('/.(jpg|jpeg)$/i', $filename))
            {
                $source_image = imagecreatefromjpeg($src);     
            }
            else if (preg_match('/.(png)$/i', $filename))
            {
                $source_image = imagecreatefrompng($src);               
            }          
            
            /* if source image is valid */
            if ($source_image) {
                $width = imagesx($source_image);
                $height = imagesy($source_image);
                
                /* find the "desired height" of this thumbnail, relative to the desired width  */
                $desired_height = floor($height * ($desired_width / $width));
                
                /* create a new, "virtual" image */
                $virtual_image = imagecreatetruecolor($desired_width, $desired_height);
                
                /* copy source image at a resized size */
                imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
                
                /* create the physical thumbnail image to its destination */
                imagejpeg($virtual_image, $dest, 100);

                if (getimagesize(THUMBNAILS_DIR.$filename)) {
                    $img_thumbnail = THUMBNAILS_URL.$filename;
                }                
            }
        }
        
        return $img_thumbnail;      
    }


    public function get_user_info()
    {
        // vars        
        $user_id = $this->session->user->id;

        $res = $this->db->query("SELECT id,username,name_first,name_middle,name_last,name_ext,img_url,img_thumbnail,img_caption,birthday,sex,contact,email,permission FROM users WHERE id=".$user_id." LIMIT 1");

        if ($res->num_rows > 0) {
            $u = [];
            $row = $res->fetch_assoc();

            foreach ($row as $key => $value) {
                switch ($key) {                    
                    case 'name_first':
                        $u['First Name'] = $value;
                        break; 
                    case 'name_last':
                        $u['Last Name'] = $value;
                        break; 
                    case 'name_middle':
                        $u['Middle Name'] = $value;
                        break;
                     case 'name_ext':
                        $u['Name Extension'] = $value;
                        break;
                    case 'contact':
                        $u['Contact No.'] = $value;
                        break;
                    case 'sex':
                        $u['Sex'] = $value == 'm' ? 'Male' : 'Female';
                        break;
                    case 'birthday':
                        $u['Birthday'] = date('M d, Y',$value);
                        break;
                    case 'img_url':
                    case 'img_thumbnail':
                    case 'img_caption':
                        $u[$key] = $value;
                        break;
                    default :
                        $u[ucfirst($key)] = $value;
                        break;                 
                }
            }           
        }

        return (object)[
            'raw'=>(object)$row,
            'processed'=>(object)$u
        ];
        
    }

    // gets the values to populate input fields
    // if post is submitted, its data is used
    // otherwise, the database data is used
    public function get_field_values($page,$id = null)
    {
        $values = null;

        if (isset($this->post->register) || isset($this->post->publish) || isset($this->post->save_draft) || isset($this->post->save) || isset($this->post->deactivate) || isset($this->post->activate))
        {
            $values = $this->post;
            if (isset($this->post->publish))
            {
                $values->status = 'published';
            }
            elseif (isset($this->post->activate))
            {
                $values->status = 'active';
            }
            elseif (isset($this->post->save_draft))
            {
                $values->status = 'draft';
            }
            elseif (isset($this->post->deactivate))
            {
                $values->status = 'waiting';
            }
        }
        else
        {
            if ($id)
            {                
                $values = $this->get_item_data($page,$id);                
            }
            else
            {

            }
        }

        return $values;
    }


    // gets the meta information of an item
    // (date_modified, date_created, user_id, status)
    public function get_item_meta($page,$id)
    {       
        $meta = null;        

        if ($page=='users') {  
            $q = "SELECT date_created AS 'Date Created',date_modified AS 'Date Modified',status AS 'Current Status' FROM {$page}  WHERE id={$id} LIMIT 1";                           
        }
        elseif ($page=='edit_profile') {
            $q = "SELECT date_created as 'Date Created',date_modified as 'Date Modified',status as 'Current Status' FROM users WHERE id={$this->session->user->id} LIMIT 1";      
        }             
        else
        {
            $q = "SELECT p.date_created as 'Date Created',p.date_modified as 'Date Modified',p.status as 'Current Status',u.username as 'User Name' FROM {$page} as p INNER JOIN users AS u ON p.user_id = u.id WHERE p.id={$id} LIMIT 1";      
        }


        // print_r($this->db->error);
        if ($res = $this->db->query($q)) {            
            // if there is a row returned
            if (isset($res->num_rows) && $res->num_rows > 0) {                
                if ($row = $res->fetch_assoc()) {
                    foreach ($row as $key => $value) {
                        if ( preg_match('/(date)/i', $key) ) {                
                            $row[$key] = date('Y-m-d',(integer)$value);
                        }
                    }                    
                    $meta = (object)$row;
                }
            }
            
        }
        else
        {
            // error in your statement
        }

        return $meta;
    }

    // parses the success info in the add_success page
    // @param = the info success data in the url (e.g. p=somePage&s=d)
    public function parse_success_info($page)
    {    
        // check if valid format
        if (preg_match('/^(about|albums|articles|church_meta|events|local_churches|ministry|ministry_officers|news|outreaches|pastors|photos|schedules|site_meta|stories|users)$/i', $page)) {             

            // check if a post item is present
            // parse json object
            if (!empty($this->post->info_parameters)) {
                
                $json_obj = json_decode($this->post->info_parameters);

                return (object)[
                    'id'=>$json_obj->id,
                    'status'=>'published',
                    'page'=>$json_obj->id,
                    'info'=>(object)[
                        'type'=>$json_obj->type,
                        'content'=>$json_obj->content
                    ]
                ];
            }
            else
            {
                $q = "SELECT id,status FROM {$page} ORDER BY id DESC LIMIT 1";
                $res = $this->db->query($q);

                if ($res->num_rows > 0) {  
                    $row = $res->fetch_object();

                    return (object)[
                        'page'=>$page,
                        'id'=>$row->id,
                        'status'=>$row->status
                    ];
                }
            }           

        }
        else
        {             
            // header('location: '.URL.'admin/not-found');
        }

    }


    // sends and email
    // @param type = string, type of email to be sent
    //               accepted types: register_success,user_activated
    // @param to = string, the email address of the receiver
    // @param opts = object, a list of other options to be added on the mail message
    public function send_mail($type=null,$to=null,$opts = null)
    { 
        if ($type&&$to) {

            $msg =  '
                <html>
                <head>
                    <title></title>
                </head>
                <body>';

            switch ($type) {
                case 'register_success':
                    $subject = 'Registration Succesful';
                    $msg .= '<h3>Congratulations!</h3>';
                    $msg .= '<br>';
                    $msg .= '<p>You are succesfully registered to the Admin Panel of CCCI Admin.</p>';
                    $msg .= '<p>You will be notified by mail as soon as your account is activated by our admin.</p>';
                    $msg .= '<br>';
                    $msg .= '<p>Thank you!</p>';
                    $msg .= '<br>';
                    $msg .= '<br>';
                    $msg .= '<p><em>Regards,<em></p>';
                    $msg .= '<br>';
                    $msg .= '<h4>CCCI Web Admin</h4>';
                    break;
                 case 'user_activated':
                    $subject = 'Account Activated';
                    $msg .= '<h3>Congratulations!</h3>';
                    $msg .= '<br>';
                    $msg .= '<p>Your account has been activated.</p>';
                    $msg .= '<p>You can now access the Admin Panel using your username and password.</p>';
                    $msg .= '<br>';
                    $msg .= '<p>Thank you!</p>';
                    $msg .= '<br>';
                    $msg .= '<br>';
                    $msg .= '<p><em>Regards,<em></p>';
                    $msg .= '<br>';
                    $msg .= '<h4>CCCI Web Admin</h4>';
                    break;  
                case 'temporary_password':
                    $subject = 'Temporary Password';    
                    $msg .= '<p>Good Day, '.$opts->user.'</p>';
                    $msg .= '<br>';
                    $msg .= '<p>Your temporary password:</p>';
                    $msg .= '<p><strong>'.$opts->password.'</strong></p>';
                    $msg .= '<br>';
                    $msg .= '<p>Please change your password immediately upon logging in for your security.</p>';
                    $msg .= '<br>';
                    $msg .= '<p>Thank you!</p>';
                    $msg .= '<br>';
                    $msg .= '<br>';
                    $msg .= '<p><em>Regards,<em></p>';
                    $msg .= '<br>';
                    $msg .= '<h4>CCCI Web Admin</h4>';
                    break; 
                
                default:
                    # code...
                    break;
            }

            $msg .=  '  
                </body>
                </html>';

            $to = $to;            
            $headers = "From: CCCIWeb_Admin\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            if (mail($to,$subject,wordwrap($msg),$headers)) {
                return true;
            }
            return false;
        }
    }


    // checks if there are info contents sent through POST ( invoked by JS form submit )
    public function get_info_post()
    {
        $info = (object)[
            'type' => 'error',
            'content' => '',
            'button' => (object)[
                'title' => '',
                'link' => '',
            ]
        ];
        if (isset($this->post->info_parameters)) {

            $info_post = json_decode($this->post->info_parameters);

            $info->type = $info_post->type;
            $info->content = $info_post->content;
            $info->button->title = $info_post->button->title;
            $info->button->link = $info_post->button->link;

        }
        return $info;
    }


    // checks if there is hidden form submit request
    public function check_publish_entry()
    {       

        if (isset($this->post->modal_publish) || isset($this->post->publish)) {  

            $page = isset($this->post->page) ? $this->post->page : $this->post->modal_field_page;            
            
            // check if such page is allowed for this action
            if (preg_match('/(news|articles|stories|events)/',$page)) {

                $status_change;

                if ( $this->post->method == 'ajax_new' )
                {
                    // this is a new entry
                    $status_change = $this->check_add_submit($page,'ajax');

                }
                else
                {                   
                    // this is an editted entry                        
                    $id = $this->post->modal_field_id;

                    // check if such id is present in the page (db table)
                    $q = "SELECT id FROM {$page} WHERE id={$id}";
                    $res = $this->db->query($q);

                    // error is suppressed as it will contine to the bottom script if error
                    if ( @$res->num_rows > 0) {

                        $status_change = (object)[
                            'info' => $this->check_status_change('ajax_edit')
                        ];

                    }

                    
                }

                if (!empty($status_change->info->content)) {                        
                    return json_encode($status_change);
                }                     

            }

        }

        // if any of the conditions above are false, return null
        return null;
    }    

    // updates the user table with the changed password
    public function change_password($text_password,$user)
    {
        // return an info format object
        $info = (object)[
            'type'=>'error',
            'content'=>''
        ];

        // create a hashed password
        $hashed = crypt($text_password,$this->salt());
        $this->processed_post['password'] = $hashed;



        // update db
        $page = 'users';
        $cols = ['password'];

        // prepare query statement
        $query_statement = $this->prepare_query_statement($page,'edit',$user->id,'active',$cols);

        // prepare bind parameters
        $bind_params = $this->get_bind_params($page,$cols,'edit');

        // prepare the statement
        $stmt = $this->db->prepare($query_statement);

        // if valid prepared statement
        if ($this->db->errno == 0) {
            
            if (call_user_func_array([$stmt,'bind_param'], $bind_params)) {

                $stmt->execute();

                if ($stmt->affected_rows > 0 ) {

                    // send an email to the user
                    if ($this->send_mail('temporary_password',$user->email,(object)['password'=>$text_password,'user'=>$user->name_first])) {
                        $info->type = 'success';
                        $info->content = 'A temporay password has been sent to your email.';
                    }
                    else
                    {                        
                        $info->content = 'Email cannot be sent this time, please try again later.';  
                    }                                      
                }
                else
                {                
                    $info->content .= $this->db->error;                
                }

            }
            else
            {                
                $info->content .= $this->db->error;                
            }
        }
        else
        {           
            $info->content = $this->db->error;
        }

        return $info;
    }

    // gets the settings list
    // returns post values if there is, otherwise get data from db
    public function get_settings_list()
    {        
        $settings_list = (array)$this->site_settings ;

        // check if there is post values
        if (isset($this->post->save)) {
            // replace the site_settings data with the post values
            foreach ($settings_list as $key => $item) {
                $settings_list[$key]->content = $this->post->$key;
            }
        }        

        return (object)$settings_list;

    }

    // checks if form is submitted from the site_settings page
    public function check_settings_submit()
    {   
        $info = (object)[
            'id'=>'',
            'type'=>'error',
            'content'=>'',
            'button'=>(object)[
                'title'=>'',
                'link'=>''
            ]
        ];

        // check if there is post values
        if (isset($this->post->save)) {

            // save each settings item
            foreach ($this->post as $name => $value) {

                // check for site_settings item with the post key as name
                if (isset($this->site_settings->$name)) {

                    // get the item's id for update_db 
                    $id = $this->site_settings->$name->id; 

                    // prepare query parameters
                    $query_statement = 'UPDATE site_settings SET content=?,user_id='.$this->session->user->id.',date_modified=UNIX_TIMESTAMP(NOW()) WHERE id='.$id.''; 
                    $bind_params = ['s',&$this->post->$name];
                    
                    // prepare query stmt
                    $stmt = $this->db->prepare($query_statement);                   

                    // check if $stmt is a valid db query statement,
                    // perform bind_param if true,
                    // else, output a readable error
                    if (is_object($stmt) && method_exists($stmt, 'bind_param')) {

                        // check if valid bind params
                        if (call_user_func_array([$stmt,'bind_param'], $bind_params)) {
                            
                            // execute
                            $stmt->execute();

                            if ($stmt->errno > 0 )
                            {     
                                $info->content = 'Unable to edit entry.<br>'.$this->db->error;
                            }
                            else
                            {                    
                                $stmt->close();
                                $info->type = 'success';
                                $info->content = 'Succesfully saved changes';
                            }

                        }

                    }     
                }                
            }            
        }        

        return $info;
    }





} // close the adminModel class
