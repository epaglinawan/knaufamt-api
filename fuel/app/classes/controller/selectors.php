<?php

class Controller_Selectors extends Controller_Rest
{
    protected $format = "json";
    protected $drupalViews = "http://localhost/knaufamt.com.au/api/views";
    //protected $drupalViews = "http://knaufamt.com.au/staging/api/views";

    public function action_index() {
        $timestamp = Input::get("timestamp");

        $fullUrl = $this->drupalViews;
        $fullUrl .= "/system_selectors?timestamp=$timestamp";

	$curl = Request::forge($fullUrl, "curl");
        $curl->execute();
        $systemSelectors = $curl->response();

        $this->response($systemSelectors);
    }
}

?>
