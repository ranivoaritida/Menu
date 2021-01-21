<?php

 require APPPATH . 'libraries/REST_Controller.php';
 use Restserver\Libraries\REST_Controller;

 class Commande extends REST_Controller{
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

    public function index_post($menu,$token){
        $input = $this->input->post();
        $this->menu->commander($token,$input['plat'],$menu,$input['qte']);
        
        $this->response(["Commande success"], REST_Controller::HTTP_OK);
    }

    public function index_get($menu,$token="",$type=""){
        if($type==""){
            $data = $this->menu->getCommande($token,$menu);
        }
        if($type=="montant"){
            $data = $this->menu->getMontant($token,$menu);
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function index_put($token,$commande){
        $input = $this->put();
        $this->menu->modify($commande,$input['quantite'],$token);
        $this->response(["Commande updated"], REST_Controller::HTTP_OK);
    }

    public function index_delete($token,$commande){
        $this->menu->delete($commande,$token);
        $this->response(["Commande updated"], REST_Controller::HTTP_OK);
    }
 }
 ?>