<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH .'libraries/REST_Controller.php'; 

class Cities extends REST_controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("cities_model");
    }
    //Read all records
    public function index_get(){
       $cities = $this->cities_model->get();
       if(!is_null($cities)){
           $this->response(array('response' => $cities), 200);
       } else {
           $this->response(array('error' => 'Not city found in the BD...', 404));
       }
    }

    //read one record
    public function find_get($id){
        if (!$id){
            $this->response(null, 400);
        }
        $city = $this->cities_model->get($id);
        if (!is_null($city)){
            $this->response(array('response' => $city), 200);
        } else{
           $this->response(array('error' => 'City not found...'), 404); 
        }
    }    

    //Add new record
    public function index_post(){
        $cityData = array();
        $cityData['name'] = $this->post('name');

        //Asking if sending object city on post
        if(is_null($cityData)){
            $this->response(null, 400);
        }
        $id = $this->cities_model->save($cityData);
        if(!is_null($id)){
            $this->response(array('response' => $id), 200);
        } else {
            $this->response(array('error' => 'Something went wrong on the server'), 400);
        }
    }

    //Update one record
    public function index_put($id){
        $cityData = array();       
        $cityData['name'] = $this->put('name');

        echo 'PUT'. $id .$cityData['name'];

        if(!$id || is_null($cityData)){
            $this->response(null, 400);
        }
        $update = $this->cities_model->update($id, $cityData);
        if(!is_null($update)){
            $this->response(array('response' => 'City update successful!'), 200);
        } else {
           $this->response(array('error' => 'Something went wrong on the server'), 400); 
        }
    }

    //Delete one record
    public function index_delete($id){
        //echo 'delete: ' .$id;
        if(!$id){
            $this->response(null,400);
        }
        $delete = $this->cities_model->delete($id);
        if(!is_null($delete)){
            $this->response(array('response' => 'City deleted successful!'), 200);
        } else {
           $this->response(array('error' => 'Something went wrong on the server'), 400); 
        }
    }
}