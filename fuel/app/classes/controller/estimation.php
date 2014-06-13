<?php

class Controller_Estimation extends Controller_Rest
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
        $fullUrl .= "/estimation_wizard?timestamp=$timestamp";

	$curl = Request::forge($fullUrl, "curl");
        $curl->execute();
        $data = $curl->response();

        $this->response($data->body());
    }
}

?>
