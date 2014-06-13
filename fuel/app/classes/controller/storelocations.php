<?php

class Controller_Storelocations extends Controller_Rest
{
    protected $format = "json";

    public function action_index() {

        $timestamp = Input::get("timestamp");

	try {
	    $date = new DateTime($timestamp);
	} catch (Exception $e) {
	    $this->response(array("error" => "Incorrect date format, it should be of form 'YYYY-MM-DD'."));
	    return;
	}

        $fullUrl = Config::get('drupal_views');
        $fullUrl .= "/store_locations?timestamp=$timestamp";
	
	$curl = Request::forge($fullUrl, "curl");
        $curl->execute();
        $data = $curl->response();

	if (count($data->body()) > 0) {
	    $fullUrl = Config::get('drupal_views') .= "/store_locations";
	    $curl = Request::forge($fullUrl, "curl");
            $curl->execute();
            $data = $curl->response();
	}

        $this->response($data->body());
    }
}

?>
