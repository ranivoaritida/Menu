<?php

 require APPPATH . '/libraries/REST_Controller.php';
 use Restserver\Libraries\REST_Controller;

class Menu extends REST_Controller {

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_get($plats="")
    {
        $this->load->model("Menu_model", "menu");
		if($plats==""){
        $data = $this->menu->getPlatsDuJour();
		}
		if($plats!=""){
		$data = $this->menu->getPlatsDetails($plats);
		}
        $this->response($data, REST_Controller::HTTP_OK);
    }

}