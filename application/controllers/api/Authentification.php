<?php

 require APPPATH . '/libraries/REST_Controller.php';
 use Restserver\Libraries\REST_Controller;

 class Authentification extends REST_Controller{
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

    public function index_post(){
            // Login and send the token of the Etudiant
            try{
                $input = $this->input->post();
                if(!isset($input['numEtu']))    throw new Exception("L'identifiant ETU est invalide.");
                if(!isset($input['pwd']))    throw new Exception("Veuillez specifier votre mot de passe.");
                
                $data = $this->etudiant->connexion($input['numEtu'],$input['pwd']);
                $this->response($data, REST_Controller::HTTP_OK);
            }
            catch(Exception $e){
                $res = $this->response(["Authentification echouer"], REST_Controller::HTTP_UNAUTHORIZED);
            }
            catch(Error $e){
                $res = $this->response(["Authentification echouer"], REST_Controller::HTTP_UNAUTHORIZED);
            }
            finally{
                $this->response($res,$res['META']['status']);
            }
    
        }
	
 }