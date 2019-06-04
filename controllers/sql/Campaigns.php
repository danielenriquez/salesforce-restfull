<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH .'libraries/REST_Controller.php'; 

class Campaigns extends REST_controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("campaigns_model");
    }

    //Read all records
    public function index_get(){
        $campaings = $this->campaigns_model->get();
        //echo 'Cities' .$cities;
        if(!is_null($campaings)){
            $this->response(array('response' => $campaings), 200);
        } else {
            $this->response(array('error' => 'Not campaigns in the BD...', 404));
        }
    }

    //read one record
    public function find_get($id){
        if (!$id){
            $this->response(null, 400);
        }
        $campaings = $this->campaigns_model->get($id);
        if (!is_null($campaings)){
            $this->response(array('response' => $campaings), 200);
        } else{
            $this->response(array('error' => 'Campaign not found...'), 404); 
        }
    }  

    //Add new record
    public function index_post(){
        $campaignData = array();
        $campaignData['code'] = $this->post('code');
        $campaignData['name'] = $this->post('name');
        $campaignData['total'] = $this->post('total');

        //Asking if sending object city on post
        if(is_null($campaignData)){
            $this->response(null, 400);
        }
        $id = $this->campaigns_model->save($campaignData);
        if(!is_null($id)){
            $this->response(array('response' => $id), 200);
        } else {
            $this->response(array('error' => 'Something went wrong on the server'), 400);
        }
    }  
    
    //Update one record
    public function index_put($id){
        $campaignData = array();       
        $campaignData['code'] = $this->put('code');
        $campaignData['name'] = $this->put('name');
        $campaignData['total'] = $this->put('total');

        if(!$id || is_null($campaignData)){
            $this->response(null, 400);
        }
        $update = $this->campaigns_model->update($id, $campaignData);
        if(!is_null($update)){
            $this->response(array('response' => 'Campaign update successful!'), 200);
        } else {
            $this->response(array('error' => 'Something went wrong on the server'), 400); 
        }
    } 
    
    //Delete one record
    public function index_delete($id){
        if(!$id){
            $this->response(null,400);
        }
        $delete = $this->campaigns_model->delete($id);
        if(!is_null($delete)){
            $this->response(array('response' => 'Campaign deleted successful!'), 200);
        } else {
           $this->response(array('error' => 'Something went wrong on the server'), 400); 
        }
    }    

}