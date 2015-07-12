<?php 

class Admin extends Controller
{
	public function index()
	{	
		$this->loadModel('adminModel');		

		if ( $this->model->user_logged_in() )
		{			
			$this->loadDefaultTemplates(['header'],(object)['header_title'=>'Admin Panel | Christian Challenge Church, Inc.']);		
			$this->loadDefaultTemplates(['top','sidebar']);
			$this->loadView('admin/home/index',(object)$this->model->get_sidebar());
			$this->loadDefaultTemplates(['footer']);
		}
		else
		{
			/**	
			 * checks if form is submitted already
			 * @var result from check_login_submit(). This can be login errors or success.
			 */			
			$login = $this->model->check_login_submit();

			//loads the login screeen
			$this->loadDefaultTemplates(['header'],(object)['header_title'=>'Admin Login']);	
			$this->loadView('admin/home/login', $login);
			$this->loadModals(['modal-forgot-password']);
		}		
	}

	//loads the modals
    //@param array list of modals
    public function loadModals($list=[],$page=null,$method=null)
    {        
        if (count($list)>0)        
        {
            foreach ($list as $modal) {            
                if ( file_exists(APP . 'views/admin/_modals/' . $modal . '.php') )
                {
                    require APP . 'views/admin/_modals/' . $modal . '.php';
                }
                else
                {
                    require APP . 'views/public/error/index.php';
                }
            }
        }
    }

	public function register()
	{
		$this->loadModel('adminModel');		
		/**	
		 * checks if form is submitted already
		 * @var result from check_login_submit(). This can be login errors or success.
		 */	
		$register = $this->model->check_register_submit();


		$data = (object)[
			'errors'=>$register->errors,
			'title'=>'',
			'values'=>$this->model->get_field_values('users'),			
			'method'=>null
		];

		//loads the register screeen		
		$this->loadDefaultTemplates(['header'],(object)['header_title'=>'User Registration']);
		$this->loadView('admin/home/register_header', $register);
		$this->model->loadFields('users', $data, 'new');
		$this->loadView('admin/home/register_footer', $register);
		$this->loadView('admin/_templates/footer_blank');
	}

	public function register_success()
	{
		$this->loadModel('adminModel');

		/**	
		 * displays success page	 
		 */
		$register = $this->model->check_register_submit();

		//loads the register screeen
		$data = (object)[
			"header_title" => 'Registration Success'
		];
		$this->loadView('admin/_templates/header',$data);
		$this->loadView('admin/home/register_success');
		$this->loadView('admin/_templates/footer_blank');
	}

	public function logout()
	{
		session_destroy();
		header('location: ' . URL . 'admin');
	}

	public function loadDefaultTemplates($views = [],$arg = null)
	{		

		$model = $this->model;	

		foreach ($views as $view) {	

			switch ($view)
			{
				case 'sidebar':
					$arg = (object)[
					'user'=> $this->session->user,
					'sidebar'=> $model->get_sidebar()
					];
					break;
				case 'header':				
					$arg = $arg ? $arg : 'Admin Panel | Christian Challenge Church';
					break;
				
				default:
					# code...
					break;
			}		
			

			$this->loadView('admin/_templates/'.$view, $arg);


		}
	}

	//add new entry page
	public function add_new($page)
	{		
		$this->loadModel('adminModel');
		$this->model->check_login();

		if ($page=='users') {
			header('location: '.URL.'error');
		}

		$check_add_submit = $this->model->check_add_submit($page);
		
		// send facebook post if there is no error
        if ( empty( $check_add_submit->errors->message ) )
        {

            $this->load_service('FacebookSvc');
            if ( $this->FacebookSvc->is_connected() ) {            	

            	$this->FacebookSvc->post($check_add_submit);

            	echo '<pre>';
            	print_r( $check_add_submit );
            	echo '</pre>';
            }
        }

		$arg = (object)[
				'header_title'=>'New Entry for '.ucwords(str_replace('_',' ',$page)) . " | Admin Panel",
				'page'=>$page,				
				'values'=>$this->model->get_field_values($page),
				'info'=>$check_add_submit->info,
				'errors'=>$check_add_submit->errors,
				'status'=>$check_add_submit->status,
				'method'=>'new',
				'title'=> ucwords(str_replace('_',' ',$page))
			];


		
		$this->loadDefaultTemplates(['header','top','sidebar'],$arg);
		$this->loadView('admin/new/header',$arg);
		$this->model->loadFields($page, $arg,'new');		
		$this->loadView('admin/new/footer',$arg);
		$this->loadModals(['image-select','default-modal','modal-publish'],$page);
		$this->loadDefaultTemplates(['footer']);
	}

	// ajax page for uploading each image
	public function upload($id)
	{
		$this->loadModel('adminModel');
		$this->model->check_login();		

		$album = $this->model->get_album_info($id);
		$data = (object)[			
			'album'=>$album,
			'header_title'=>'Upload Photos' . " | Admin Panel"
		];
		$this->loadDefaultTemplates(['header','top','sidebar'],$data);
		$this->loadView('admin/upload/content',$data);

		$this->loadDefaultTemplates(['footer']);
	}

	// ajax page for updating the image caption 
	public function image_update_info($img_id)
	{
		$this->loadModel('adminModel');
        $this->model->check_login();

        $this->loadView('admin/data/image_update_info',(object)['db'=>$this->model->db,'img_id'=>$img_id]);
	}

	//after successfuly adding entry:
    public function add_success($page)
    {
        $this->loadModel('adminModel');
        $this->model->check_login();

        $success_info = $this->model->parse_success_info($page);

        $this->loadDefaultTemplates(['header','top','sidebar'],(object)['header_title'=>'Successfuly Added Entry']);
        $this->loadView('admin/new/add_success', $success_info);
        $this->loadDefaultTemplates(['footer']);
    }


	public function view($page=null,$status='summary',$current_page=1)
	{
		$this->loadModel('adminModel');
		$this->model->check_login();

		$this->model->validate_url($page,$status);
		
		$info = $this->model->check_view_submit();

		$info = !empty($info->content) ? $info : $this->model->get_info_post();

		// albums page has only one status ('published')
		if (preg_match('/(albums|site_settings)/', $page))
		{
			$status = 'published';
		}		

		$arg = (object)[
			'header_title'=>ucwords(str_replace('_',' ',$page)).' | Admin Panel',
			'title'=>$this->model->get_view_title($page,$status),
			'page'=>$page,
			'status'=>$status,
			'list'=>$this->model->get_data_list($page,$status,(object)['current_page'=>$current_page,'limit'=>10]),
			'info'=>$info			
		];
				
		$this->loadDefaultTemplates(['header','top','sidebar'],$arg);

		if( $status == 'summary' )
		{
			$this->loadView('admin/view/header_summary',$arg);			
			$this->loadView('admin/view/view_summary',$arg);

		}
		else
		{
			$this->loadView('admin/view/header',$arg);
			$this->loadView('admin/view/view_list',$arg);
			$this->loadModals(['image-select'],$page);
		}

		$this->loadModals(['default-modal','modal-publish'],$page);
		$this->loadDefaultTemplates(['footer']);
	}


	public function gallery($id)
	{
		$this->loadModel('adminModel');
		$this->model->check_login();
		$album = $this->model->get_album_info($id);

		$info = $this->model->check_gallery_submit();		

		$arg = (object)[
				'title'=>$album->title,
				'id'=>$album->id,
				'photos'=>$this->model->get_album_photos($id),				
				'info'=>$info,
				'albums_list'=>$this->model->get_album_list()
			];
		
		$this->loadDefaultTemplates(['header','top','sidebar'],(object)['header_title'=>$album->title.' | Gallery' . ' | Admin Panel']);
		$this->loadView('admin/view/view_gallery',$arg);
		$this->loadDefaultTemplates(['footer']);
	}

	public function edit($page,$id)
	{		
		$this->loadModel('adminModel');
		$this->model->check_login();

		$values = $this->model->get_field_values($page,$id);				
		$check_edit_submit = $this->model->check_edit_submit($page,$id);
		$meta = (array)$this->model->get_item_meta($page,$id);

		$arg = (object)[
				'header_title'=>'Edit Entry | '.ucfirst(str_replace('_', ' ', $page)) . ' | Admin Panel',
				'title'=>'Edit Entry for '.ucwords(str_replace('_',' ',$page)),
				'id'=>$id,
				'page'=>$page,				
				'values'=>$values,
				'meta'=>(object)$meta,
				'info'=>$check_edit_submit->info,
				'errors'=>$check_edit_submit->errors,
				'status'=>$check_edit_submit->status?$check_edit_submit->status:$meta['Current Status'],
				'method'=>'edit'
			];		
		
		$this->loadDefaultTemplates(['header','top','sidebar'],$arg);
		$this->loadView('admin/new/header',$arg);
		$this->model->loadFields($page, $arg,'edit');
		$this->loadView('admin/new/footer',$arg);
		$this->loadModals(['image-select','default-modal','modal-publish'],$page);
		$this->loadDefaultTemplates(['footer']);
	}

	public function profile($task = 'summary')
	{		
		$this->loadModel('adminModel');
		$this->model->check_login();		

		$values = null;
		$user = $task == 'change_password' ? null : $this->model->get_user_info();

		$data = (object)[	
			'page'=>'profile',
			'values'=>null,
			'errors'=>null,
			'user'=>$user,
			'method'=>'profile',
			'title'=>''
		];	
		
		
		if (isset($this->post->publish) || isset($this->post->save_draft) || isset($this->post->save))
		{
			$data->values = $this->post;
		}
		else
		{
			$data->values = $this->model->get_item_data('users',$this->session->user->id);
		}

		// Select header title depending on the task
		switch ($task) {
			case 'summary':
				$header_title = 'My Profile | Admin Panel';
				$data->title = 'Edit Your Profile';
				break;
			case 'change_password':
				$header_title = 'Change Password | Admin Panel';
				$data->title = 'Change Password';
				break;
			case 'edit_profile':				
				$header_title = 'Edit Profile | Admin Panel';
				$data->title = null;
				break;
		}
		
		$this->loadDefaultTemplates(['header','top','sidebar'],(object)['header_title'=>$header_title]);
		

		// Select mid contents depending on the task
		switch ($task) {
			case 'edit_profile':
				$check_edit_submit = $this->model->check_edit_submit('users',$this->session->user->id,$task);				
				$data->info = $check_edit_submit->info;
				$data->errors = $check_edit_submit->errors;				
				$this->loadView('admin/new/header',$data);
				$this->model->loadFields('users', $data,$task);
				$this->loadView('admin/new/footer',$data);
				break;
			case 'change_password':				
				$check_passwordChange_submit = $this->model->check_edit_submit('users',$this->session->user->id,$task);
				$data->info = $check_passwordChange_submit->info;
				$data->errors = $check_passwordChange_submit->errors;				
				$this->loadView('admin/new/header',$data);
				$this->model->loadFields('users', $data,$task);
				$this->loadView('admin/new/footer',$data);
				break;		
			default:
				$this->loadView('admin/profile/'.$task,$data);
				break;
		}

		$this->loadModals(['image-select','default-modal'],'users');		
		$this->loadDefaultTemplates(['footer']);
	}

	public function ajaxFetch()
	{
		$this->loadModel('adminModel');
		$this->model->check_login();
		$this->loadView('admin/data/ajaxFetch',$this->db);
	}

	public function upload_single($album_id = null)
	{
		$this->loadModel('adminModel');
		$this->model->check_login();

		$json = $this->model->upload_single($album_id);
		$this->loadView('admin/upload/image_upload_single',$json);
	}

	public function upload_multiple($album_id = null)
	{
		$this->loadModel('adminModel');
		$this->model->check_login();

		$json = $this->model->upload_multiple($album_id);
		$this->loadView('admin/upload/image_upload_multiple',$json);
	}

	public function get_album_list()
	{
		$this->loadModel('adminModel');
		$this->model->check_login();
		$this->loadView('admin/data/get_album_list',(object)['url'=>URL,'db'=>$this->model->db]);
	}

	public function get_album_photos()
	{
		$this->loadModel('adminModel');
		$this->model->check_login();

		$photos = $this->model->get_album_photos($this->post->id);		
		$this->loadView('admin/data/display_album_photos',(object)['photos'=>$photos]);
	}

	/*
		publishes entry from ajax request
	*/
	public function publish_entry()
	{
		$this->loadModel('adminModel');

		if ($this->model->user_logged_in()) {

			/*
				@var = object , the result of the publish request in json format
				Valid info format:
				{
					type 	: 'success | error',
					content : 'Some message',
					button 	: {
								title : 'Button Text',
								link  : 'http://button.link'
							}
				}
			*/				

			$result = $this->model->check_publish_entry();

			$this->loadView('admin/data/publish_entry',$result);

		}
		else
		{

			header('location: '.URL.'admin/error');

		}

	}


	/*
		get an item's data from db, initiated by an ajax request
	*/
	public function get_item_data()
	{
		$this->loadModel('adminModel');
		$this->model->check_login();

		// check post items from ajax
		if ( !empty($this->post->page) && !empty($this->post->id) ) {

			$data = $this->model->get_item_data($this->post->page,$this->post->id);

			$this->loadView('admin/data/get_item_data',$data);

		}

	}


	/*
		displays the site_settings page
	*/
	public function site_settings()
	{
		$this->loadModel('adminModel');
		$this->model->check_login();

		$arg = (object)[
			'info'=>$this->model->check_settings_submit(),
			'header_title'=>'Site Settings | Admin Panel',
			'settings_list'=>$this->model->get_settings_list()
		];

		$this->loadDefaultTemplates(['header','top','sidebar'],$arg);
		$this->loadView('admin/site_settings/header',$arg);
		$this->loadView('admin/site_settings/content',$arg);
		$this->loadView('admin/site_settings/footer');
		$this->loadDefaultTemplates(['footer'],$arg);

	}














	// test page
	public function _test($page='index')
	{		
		require APP.'views/admin/test/php_sdk/autoload.php';
		
		$this->loadView('admin/test/index');
		
	}


}