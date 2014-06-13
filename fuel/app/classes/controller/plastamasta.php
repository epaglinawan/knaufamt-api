<?php

class Controller_Plastamasta extends Controller_Rest
{
    protected $format = "json";

    public function action_index() {
        $productId = Input::get("product_id");
        $timestamp = Input::get("timestamp");

	try {
	    $date = new DateTime($timestamp);
	} catch (Exception $e) {
	    $this->response(array("error" => "Incorrect date format, it should be of form 'YYYY-MM-DD'."));
	    return;
	}

        $fullUrl = Config::get('drupal_views') . "/plastamasta?product_id=$productId&last_update=$timestamp";
	$curl = Request::forge($fullUrl, "curl");
        $curl->execute();
        $products = $curl->response();

        $this->response($products->body());
    }
}

?>
