<?php

class Controller_Media extends Controller_Rest
{
    protected $format = "json";

    public function action_index() {
        $mediaId = Input::get("media_id");

        $fullUrl = Config::get('drupal_views');
        $fullUrl .= "/media?media_id=$mediaId";

	$curl = Request::forge($fullUrl, "curl");
        $curl->execute();
        $data = $curl->response();

        $this->response($data->body());
    }
}

?>
