<?php

class Controller_Products extends Controller_Rest
{
    protected $format = "json";
    protected $drupalViews = "http://localhost/knaufamt.com.au/api/views";
    //protected $drupalViews = "http://knaufamt.com.au/staging/api/views";
    protected $productsResource = "/content";

    public function action_index() {
        $listType = Input::get("type");
        $productId = Input::get("productId");
        $timestamp = Input::get("timestamp");

        if ($listType != 1 && $listType != 2) {
            $this->response(array("error" => "Parameter <b>type=$listType</b> not supported."));
            return;
        }

        $fullUrl = $this->drupalViews;
        $fullUrl .= ($listType == 1) ? "/order_form?" : "/marketing_pages?";
        $fullUrl .= "product_id=$productId&last_update=$timestamp";

	$curl = Request::forge($fullUrl, "curl");
        $curl->execute();
        $products = $curl->response();

        $this->response($products);
    }
}

?>
