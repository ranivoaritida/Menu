<?php

 require APPPATH . '/libraries/REST_Controller.php';
 use Restserver\Libraries\REST_Controller;

 class Info extends REST_Controller{
     public function index_get(){
         $data = array(
             "nom1"=>"Rakotoasimbola Mihary Lalaina",
             "numero1"=>"ETU000914",
			 "nom2"=>"Ranivoaritida Sandy",
             "numero2"=>"ETU000945"
         );
         $this->response($data,REST_Controller::HTTP_OK);
     }
 }