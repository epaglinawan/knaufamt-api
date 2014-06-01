<?php

class Controller_Trigger extends Controller_Rest
{
    protected $format = "json";

    public function action_index() {
	
        $type = Input::get("type");

	if (empty($type)) {
	    $this->response(array("error" => "Parameter <b>type=$type</b> not supported."), 400);
	    return;
	}

	$endpoints = Config::get('trigger_endpoints.'.$type);

	if (empty($endpoints)) {
	    $this->response(array("error" => "No endpoint found for $type"), 500);
	    return;
	}
	
	$status = array();
	foreach ($endpoints as $key) {
	    $endpoint = Config::get('endpoints.'.$key);
	    if (empty($endpoint)) {
	        continue;
	    }

	    $fullUrl = $endpoint;

	    try {
	        $curl = Request::forge($fullUrl, "curl");
	        $curl->execute();
		$status[$fullUrl] = true;
	    } catch (Exception $ex) {
		$status[$fullUrl] = false;
	    }
	}

	$this->response(array("status" => $status));

    }
}

?>

