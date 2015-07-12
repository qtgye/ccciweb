<?php

	$request = new Facebook\FacebookRequest(
	$this->session,
	  'POST',
	  '/' . $this->page_id . '/feed',
	  array (
	    'message' => $args->message,
	  )
	);
	$this->last_response = $request->execute();
	$graphObject = $this->last_response->getGraphObject();

?>