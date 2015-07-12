<?php 

/**
* Facebook Class for the Facebook PHP SDK
*/
class FacebookSvc
{
	// the FB SDK connection status
	protected $connected = false;

	// the FB app name
	protected $app_id = "1504042413186568";

	// the FB app secret
	protected $app_secret = "bdfa7723d9aa2d5cbd777d79ebe76217";

	// the page id
	protected $page_id = "146340972105458";

	// the non-expiring access token for the page
	protected $access_token = "CAAVX6ynD3ggBANzevl2Ql7DsQUWEuODdJbZBOJlcKvE5BgZApdHEfFIuMYz7YvZCt9I6LpZAoWttUghZBtMrSmJXRqDiqXF2mSB4Xn9gNeipTE3dgQbPzuw61YZA6qefquZAtYruUf3OCB25nnsjpfVhi5vPDNtiCK26VZChEGb2cyNFnu96OHAG3cZCcJ8uI7pAZD";

	// handler for the facebook session
	public $session = 1;

	// handler for the latest response
	public $last_response = null;

	function __construct()
	{
		$this->load_sdk();
	}

	/**
	* Loads the Facebook SDK
	* The codes are from the github page: https://github.com/facebook/facebook-php-sdk-v4
	*/
	public function load_sdk()
	{		
		if ( !$this->is_connected() ) {
			require_once APP . 'services/FacebookSvc/load_sdk.php';
		}
	}

	/**
	* Checks if SDK is connected properly
	* returns true or false
	*/
	public function is_connected()
	{
		return $this->connected;
	}

	public function show_name()
	{
		// print_r($this->lib_name);
	}

	/**
	* Creates a facebook post request to the Graph API
	*/
	public function post($args)
	{
		if ( $this->is_connected() ) {
			try {
				$request = new Facebook\FacebookRequest(
				$this->session,
				  'POST',
				  '/' . $this->page_id . '/feed',
				  array (
				  	'access_token' => $this->access_token,
				  	'type' => "link",
				  	'name' => $args->info->post_info->title,
				    'description' => isset($args->info->post_info->summary) ?$args->info->post_info->summary : substr($args->info->post_info->summary, 0,50) . "...",
				    'link' => 'http://www.christianchallengechurch.org/updates/' . $args->info->page . '/' . $args->info->id,
				    'picture' => $args->info->post_info->img_url,
				  	'caption' => 'Christian Challenge Church'
				  )
				);
				$this->last_response = $request->execute();
				$graphObject = $this->last_response->getGraphObject();
			} catch (Exception $e) {
				print_r($e);
			}
		}
	}

}

?>