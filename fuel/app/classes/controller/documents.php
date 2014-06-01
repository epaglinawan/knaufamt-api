<?php

class Controller_Documents extends Controller_Rest
{
    protected $format = "json";

    public function action_index() {
        $timestamp = Input::get("timestamp");
	$documentId = Input::get("document_id");

        $fullUrl = Config::get('drupal_views');
        $fullUrl .= "/documents?timestamp=$timestamp&document_id=$documentId";

	$curl = Request::forge($fullUrl, "curl");
        $curl->execute();
        $data = $curl->response();

        $this->response($data);
    }
}

?>
