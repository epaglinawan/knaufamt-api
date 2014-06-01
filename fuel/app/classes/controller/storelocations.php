<?php

class Controller_Storelocations extends Controller_Rest
{
    protected $format = "json";

    public function action_index() {

        $timestamp = Input::get("timestamp");

        $fullUrl = Config::get('drupal_views');
        $fullUrl .= "/store_locations?timestamp=$timestamp";
	
	$curl = Request::forge($fullUrl, "curl");
        $curl->execute();
        $data = $curl->response();

	if (count($data->body()) > 0) {
	    $fullUrl .= "/store_locations?timestamp=$timestamp";
	    $curl = Request::forge($fullUrl, "curl");
            $curl->execute();
            $data = $curl->response();
	}

        $this->response($data);
    }
}

?>
