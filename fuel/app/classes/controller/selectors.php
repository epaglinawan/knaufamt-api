<?php

class Controller_Selectors extends Controller_Rest
{
    protected $format = "json";

    public function action_index() {
        $updated_date = Input::get("updated_date");

	try {
	    $date = new DateTime($updated_date);
	} catch (Exception $e) {
	    $this->response(array("error" => "Incorrect date format, it should be of form 'YYYY-MM-DD'."));
	    return;
	}

        $fullUrl = Config::get('knauf_domain') . '/system_selectors?updated_date=' . urlencode($updated_date);

	$curl = Request::forge($fullUrl, "curl");
        $curl->execute();
        $data = $curl->response();

        $this->response($data->body());
    }
}

?>
