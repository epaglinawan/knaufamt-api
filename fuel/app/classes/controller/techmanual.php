<?php

class Controller_Techmanual extends Controller_Rest
{
    protected $format = "json";

    public function action_index() {
        $timestamp = Input::get("timestamp");
	$documentId = Input::get("document_id");

        $fullUrl = Config::get('drupal_views');
        $fullUrl .= "/tech_manual?timestamp=$timestamp&document_id=$documentId";

	$curl = Request::forge($fullUrl, "curl");
        $curl->execute();
        $systemSelectors = $curl->response();

        $this->response($systemSelectors);
    }
}

?>
