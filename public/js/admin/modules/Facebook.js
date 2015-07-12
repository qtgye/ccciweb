// The Facebook module
// This module handles operations that uses the Facebook Javascript SDK
// This module should be initiated directly after the FB.init() method


;var Facebook = (function () {
	
	// some private vars here
	var FBInitParams  = {
	          appId      : '1504042413186568',	          
	          xfbml      : true,
	          version    : 'v2.1'
	        },
	    opts = {
	    	appId : '1504042413186568',
	    	appSecret : 'bdfa7723d9aa2d5cbd777d79ebe76217',	
	    	group : {
				id : '135309263223390',
				access_token : 'CAAVX6ynD3ggBAPqO6PqlRUOOfe47dchWLEMZBMNG7oeIVe5FIFZAPYcADCZB7w2FfhULfdX1AQiD5ecQdzZCmSfGT0n63Bjg8UOXhEbM681Xdwj7ZCocdRZCYS8I6UippRx9DWPzNiM49YWPkd25jfz7DZCjyARwvyutQYsWrOthTIo8UnzKxtzfjYL8wZAMzEPGDLSF4SbZBZBteSqVWRcoFB'
			},
			page : {
				id : '146340972105458',
				access_token : 'CAAVX6ynD3ggBANzevl2Ql7DsQUWEuODdJbZBOJlcKvE5BgZApdHEfFIuMYz7YvZCt9I6LpZAoWttUghZBtMrSmJXRqDiqXF2mSB4Xn9gNeipTE3dgQbPzuw61YZA6qefquZAtYruUf3OCB25nnsjpfVhi5vPDNtiCK26VZChEGb2cyNFnu96OHAG3cZCcJ8uI7pAZD'
			},
			admin : {
				id : '872621992749168',
				access_token : 'CAAVX6ynD3ggBAC9IWzOVLUAFfw6ZBL3tui3hZCHWugqGbOGflY3S3SxvsNmqoS1yKcr5yuJZCZCABBadmWWW7yYyK8Btx9vI88z8q0toEa0u2ssCfz5ReZBQbrjpQ5GBnrWaIMEgOZA73JDvM29gBiDUWNXSa2NyqtyAQSxs5We2m2uYn4Vs4S2521MikKzjeuUdgMtM7KEZBRPszpSEz8i'
			}
	    };	

	// extension object
	var extObj = {
		connected : true,		
		sendPost : function (postParams,callback) {
			// send post to page			

			FB.api(
				opts.page.id+'/feed/?access_token='+opts.page.access_token,
				'post',
				postParams,
				function (res) {

					console.log(res);

					// if error
					if (res.error)
					{
						res.error.customMessage = 'However, the entry was not posted to Facebook.';
						callback(res);
					}
					// else, send to group
					else
					{
						// FB.api(
						// 	opts.group.id+'/feed/?access_token='+opts.group.access_token,
						// 	'post',
						// 	postParams,
						// 	function (res2) {

						// 		var res = res2;

						// 		// if error
						// 		if (res.error)
						// 		{
						// 			res.error.customMessage = 'The entry was posted on Facebook Page, but not on Facebook Group.';
						// 			callback(res);
						// 		}
						// 		// else, run callback function immediately
						// 		else
						// 		{
						// 			callback(res);
						// 		}
						// 	}
						// );
					}
					
				}
			);			
		}
	}    

	// some private functions here
	function getFBInitParams () {
		return FBInitParams;
	}

	



	// The Class
	// @param fbObject = object, the FB main object
	function _FB(fbObject)
	{
		var f = this,
			FB = fbObject;


		// extend the main Facebook Module upon loading this class
		f.extendModule  = function () {
			$.extend(Facebook,extObj);
		};		

		f.init = function() {			

			console.log('Testing Facebook App connection...');

			// perform api test that restarts on failure or timeout of 5sec
			var connectLoop = setTimeout(function () {

				clearTimeout(connectLoop);
				f.init();

			},5000);

			// test api if connected succesfully
			FB.api(
				// opts.group.id+'/?access_token='+opts.group.access_token,
				'me/?access_token='+opts.group.access_token,
				'get',
				function (res) {

					clearTimeout(connectLoop);

					if (!res.error)
					{
						// connected
						f.extendModule();
						console.info('Successfully connected to CCCI Web App.');						

					}
					else
					{
						// handle connect error here;
						console.warn('Unable to connect to Facebook App.');
						f.init();
					}
				}
			);
		};

	}	
	


	// The return object returned
	return {

		// load the Facebook JS SDK
		appConnect : function () {			
	        window.fbAsyncInit = function () {
	        	FB.init(getFBInitParams());
	        	Facebook.init();
	        };

		    (function(d, s, id){
		    	var js, fjs = d.getElementsByTagName(s)[0];
		    	if (d.getElementById(id)) {return;}
		    	js = d.createElement(s); js.id = id;
		    	js.src = "//connect.facebook.net/en_US/sdk.js";
		    	fjs.parentNode.insertBefore(js, fjs);
		    }(document, 'script', 'facebook-jssdk'));
		},

		// instantiate the _FB class
		init : function () {

			// check whether a valid FB object exists			
			if (typeof FB == 'object' && FB.XFBML)
			{
				var fb = new _FB(FB);
				fb.init();
			}
			else
			{
				console.warn('The Facebook Javascript SDK was not loaded.');
				return;
			}
			
		}
	}



})();