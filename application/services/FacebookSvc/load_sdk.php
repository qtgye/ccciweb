<?php 
require_once APP . 'services/FacebookSvc/fb_4.0_sdk/autoload.php';

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
// use Facebook\FacebookRedirectLoginHelper;
// use Facebook\FacebookResponse;
// use Facebook\FacebookSDKException;
// use Facebook\FacebookRequestException;
// use Facebook\FacebookAuthorizationException;
// use Facebook\GraphObject;
// use Facebook\GraphObject;
// use Facebook\Entities\AccessToken;
// use Facebook\HttpClients\FacebookCurlHttpClient;
// use Facebook\HttpClients\FacebookHttpable;

FacebookSession::setDefaultApplication( $this->app_id , $this->app_secret );

// Use one of the helper classes to get a FacebookSession object.
//   FacebookRedirectLoginHelper
//   FacebookCanvasLoginHelper
//   FacebookJavaScriptLoginHelper
// or create a FacebookSession with a valid access token:
$this->session = new FacebookSession( $this->access_token );

// Get the GraphUser object for the current user:
try {
  $me = (new FacebookRequest(
    $this->session, 'GET', '/me'
  ))->execute()->getGraphObject(GraphUser::className());
  if ( $me->getName() == "CCCI (Christian Challenge Church Incorporated)" )
  {
  	$this->connected = true;
  }

} catch (FacebookRequestException $e) {
  // The Graph API returned an error
} catch (\Exception $e) {
  // Some other error occurred
}

?>