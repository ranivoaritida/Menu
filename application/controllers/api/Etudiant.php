<?php

 require APPPATH . '/libraries/REST_Controller.php';
 use Restserver\Libraries\REST_Controller;

class Etudiant extends REST_Controller {

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model("Etudiant_model", "etudiant");
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_get()
    {
       $input = $this->input->get();
       $token = $this->etudiant->connexion($input['numEtu'], $input['pwd']);

       $this->response([$token], REST_Controller::HTTP_OK);
    }

    public function index_post(){
        $input = $this->input->post();
        $this->etudiant->inscription($input);

        $this->response(["Etudiant created successfully"], REST_Controller::HTTP_OK);
    }

    public function index_put($token){
        $input = $this->put();
        $this->etudiant->modify($token,$input['nom'],$input['naissance']);

        $this->response(["Etudiant modified successfully"], REST_Controller::HTTP_OK);
    }

}