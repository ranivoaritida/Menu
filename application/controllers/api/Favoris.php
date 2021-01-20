<?php

 require APPPATH . '/libraries/REST_Controller.php';
 use Restserver\Libraries\REST_Controller;

 class Favoris extends REST_Controller{
     /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model("Menu_model", "menu");
    }

    public function index_get($token="",$idPlats="",$type=""){
        if($type==""){
		$data = $this->menu->getFavoris($token);
		}
		if($type=="inserer"){
			$this->menu->mettreFavoris($token,$idPlats);
        $this->response(["Mis en favoris"], REST_Controller::HTTP_OK);
			
		}
        $this->response($data, REST_Controller::HTTP_OK);
    }
	
 }