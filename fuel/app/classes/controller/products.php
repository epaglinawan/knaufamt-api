<?php

class Controller_Products extends Controller_Rest
{
    protected $format = "json";

    public function action_index() {
        $listType = Input::get("type");
        $productId = Input::get("product_id");
        $timestamp = Input::get("timestamp");

        if ($listType != 1 && $listType != 2) {
            $this->response(array("error" => "Parameter <b>type=$listType</b> not supported."));
            return;
        }

        $fullUrl = Config::get('drupal_views');
        $fullUrl .= ($listType == 1) ? "/order_form?" : "/marketing_pages?";
        $fullUrl .= "product_id=$productId&last_update=$timestamp";

	$curl = Request::forge($fullUrl, "curl");
        $curl->execute();
        $data = $curl->response();

        $this->response($data);
    }
}

?>
