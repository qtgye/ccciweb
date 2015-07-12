<?php 

	// curl_setopt( curl_init(), CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
	
	// function __($str)
	// {
	// 	echo '<pre>';
	// 	print_r($str);
	// 	echo '</pre>';
	// }

	// require 'php_sdk/src/Facebook/autoload.php'; 
 	
	// // use Facebook\Facebook;
	// // use Facebook\FacebookRequest;
	// // use Facebook\GraphNodes\GraphUser;
	// // use Facebook\GraphObject;
	// // use Facebook\FacebookRequestException;

	// $app = (object)[
	// 	'appId' => '1504042413186568',
	// 	'appSecret' => 'bdfa7723d9aa2d5cbd777d79ebe76217',		
	// 	'group' => (object)[
	// 			'id' => '135309263223390',
	// 			'access_token' => 'CAAVX6ynD3ggBAPqO6PqlRUOOfe47dchWLEMZBMNG7oeIVe5FIFZAPYcADCZB7w2FfhULfdX1AQiD5ecQdzZCmSfGT0n63Bjg8UOXhEbM681Xdwj7ZCocdRZCYS8I6UippRx9DWPzNiM49YWPkd25jfz7DZCjyARwvyutQYsWrOthTIo8UnzKxtzfjYL8wZAMzEPGDLSF4SbZBZBteSqVWRcoFB'
	// 		],
	// 	'page' => (object)[
	// 			'id' => '146340972105458',
	// 			'access_token' => 'CAAVX6ynD3ggBANzevl2Ql7DsQUWEuODdJbZBOJlcKvE5BgZApdHEfFIuMYz7YvZCt9I6LpZAoWttUghZBtMrSmJXRqDiqXF2mSB4Xn9gNeipTE3dgQbPzuw61YZA6qefquZAtYruUf3OCB25nnsjpfVhi5vPDNtiCK26VZChEGb2cyNFnu96OHAG3cZCcJ8uI7pAZD'
	// 		]
	// ];
	
	// function sdfsdf($value='')
	// {
	// 	FacebookSession::setDefaultApplication('1504042413186568', 'bdfa7723d9aa2d5cbd777d79ebe76217');

	// 	$session = new FacebookSession($main->access_token);

	// 	$ccci_group = (object)[
	// 		'id' => '135309263223390'
	// 	];

	// 	$request = new FacebookRequest($session, 'GET', '/'.$ccci_group->id.'/feed/','post',array('access_token'=>$main->access_token,'message'=>'nyahaha'));
	// 	$response = $request->execute();
	// 	$graphObject = $response->getGraphObject();

	// 	echo '<pre>';
	// 	print_r($graphObject);
	// 	echo '</pre>';
	// }


	// FacebookSession::setDefaultApplication($app->appId, $app->appSecret);

	// $session = new FacebookSession($app->access_token);

	// // echo '<pre>';
	// //   print_r($session);	  
	// //   echo '</pre>';
	



	// try {

	//     $response = (new FacebookRequest(
	//       $session, 'POST', '/'.$app->ccci_group->id.'/feed', array(
	//         'link' => 'www.example.com',
	//         'message' => 'User provided message'
	//       )
	//     ))->execute()->getGraphObject();

	//     echo "Posted with id: " . $response->getProperty('id');

	//   } catch(FacebookRequestException $e) {

	//     echo "Exception occured, code: " . $e->getCode();
	//     echo " with message: " . $e->getMessage();

	//   }   

	// $fb = new Facebook\Facebook([
	//   'app_id' => $app->appId,
	//   'app_secret' => $app->appSecret
	//   ]);

	// $res = $fb->get('me/feed',$app->page->access_token);
	// $res = $fb->post(
	// 		$app->page->id.'/feed/?access_token='.$app->page->access_token,	
	// 		[
	// 			'message'=>'Test post using php sdk'
	// 		]
	// 	);

	// $obj = $res->execute()->getGraphObject();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Test on FB PHP SDK</title>
	<script src="../../inc/jquery.js"></script>
	<script>
		function log (str) {
			console.log(str);
		}

		// load sdk
		window.fbAsyncInit = function () {
        	FB.init({
        		appId      : '1504042413186568',	          
		        xfbml      : true,
		        version    : 'v2.1'
        	});

        	FB.api(
        		'146340972105458/feed/?access_token='+'CAAVX6ynD3ggBANzevl2Ql7DsQUWEuODdJbZBOJlcKvE5BgZApdHEfFIuMYz7YvZCt9I6LpZAoWttUghZBtMrSmJXRqDiqXF2mSB4Xn9gNeipTE3dgQbPzuw61YZA6qefquZAtYruUf3OCB25nnsjpfVhi5vPDNtiCK26VZChEGb2cyNFnu96OHAG3cZCcJ8uI7pAZD',
        		'POST',
        		{
        			status_type : 'added_photos',
        			message : 'nyahaha',
        			picture : 'data:image/jpeg;base64,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'
        		},function (res) {
        			$('body').append(res);
        		}
        	);
        };

	    (function(d, s, id){
	    	var js, fjs = d.getElementsByTagName(s)[0];
	    	if (d.getElementById(id)) {return;}
	    	js = d.createElement(s); js.id = id;
	    	js.src = "//connect.facebook.net/en_US/sdk.js";
	    	fjs.parentNode.insertBefore(js, fjs);
	    }(document, 'script', 'facebook-jssdk'));

	</script>
</head>
<body>
	
</body>
</html>