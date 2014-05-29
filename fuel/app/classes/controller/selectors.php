<?php

class Controller_Selectors extends Controller_Rest
{
    protected $format = "json";

    public function action_index() {
        $timestamp = Input::get("timestamp");

        $fullUrl = Config::get('drupal_views');
        $fullUrl .= "/system_selectors?timestamp=$timestamp";

	$curl = Request::forge($fullUrl, "curl");
        $curl->execute();
        $systemSelectors = $curl->response();

        $this->response($systemSelectors);
    }
}

?>
