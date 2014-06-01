<?php

class Controller_Estimation extends Controller_Rest
{
    protected $format = "json";

    public function action_index() {
        $timestamp = Input::get("timestamp");

        $fullUrl = Config::get('drupal_views');
        $fullUrl .= "/estimation_wizard?timestamp=$timestamp";

	$curl = Request::forge($fullUrl, "curl");
        $curl->execute();
        $data = $curl->response();

        $this->response($data);
    }
}

?>
