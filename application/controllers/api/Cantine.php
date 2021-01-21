<?php

 require APPPATH . 'libraries/REST_Controller.php';
 use Restserver\Libraries\REST_Controller;

 class Cantine extends REST_Controller{
     /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model("cantine_model", "cantine");
    }

    public function index_get($idmenu){
        $data = $this->cantine->getPlats($idmenu);
        $this->response($data, REST_Controller::HTTP_OK);
    }
 }