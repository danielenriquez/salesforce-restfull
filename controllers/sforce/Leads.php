<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH .'libraries/REST_Controller.php'; 

class Leads extends REST_controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("salesforce_model");
    }

    //Read all records
    public function index_get(){
        $leads = $this->salesforce_model->get();
        //$this->response(array('response' => $leads), 200);
        if(!is_null($leads)){
            $this->response(array('response' => $leads), 200);
        } else {
            $this->response(array('error' => 'Not campaigns in the BD...', 404));
        }
    }

    //Read one record
    public function find_get($id){
        if (!$id){
            $this->response(null, 400);
        }
        $lead = $this->salesforce_model->get($id);
        if (!is_null($lead)){
            $this->response(array('response' => $lead), 200);
        } else{
            $this->response(array('error' => 'Lead not found...'), 404); 
        }
    }  
    
    //Add new record
    public function index_post(){
        $leadData = array();
        $leadData['firstname'] = $this->post('firstname');
        $leadData['lastname'] = $this->post('lastname');
        $leadData['phone'] = $this->post('phone');
        $leadData['email'] = $this->post('email');

        //Asking if sending object city on post
        if(is_null($leadData)){
            $this->response(null, 400);
        }

        $create = $this->salesforce_model->save($leadData);
        if(!is_null($create->id)){
            $this->response(array('response' => $create->id), 200);
        } else {
            $this->response($create, 400);
        }
    }   
    
    //Update one record
    public function index_put($id){
        $leadData = array();
        $leadData['firstname'] = $this->put('firstname');
        $leadData['lastname'] = $this->put('lastname');
        $leadData['phone'] = $this->put('phone');
        $leadData['email'] = $this->put('email');

        if(!$id || is_null($leadData)){
            $this->response(null, 400);
        }

        $update = $this->salesforce_model->update($id, $leadData);
        if(!is_null($update->id)){
            $this->response(array('response' => $update->id), 200);
        } else {
            $this->response($update, 400);
        }
    }    
    
    //Delete one record
    public function index_delete($id){
        if(!$id){
            $this->response(null,400);
        }
        $delete = $this->salesforce_model->delete($id);
        if(!is_null($delete->id)){
            $this->response(array('response' => $delete->id), 200);
        } else {
            $this->response($delete, 400);
        }
    }     

}