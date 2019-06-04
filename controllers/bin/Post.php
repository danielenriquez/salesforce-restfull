<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH .'libraries/REST_Controller.php'; 

class Post extends REST_controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("postbin_model");
    }

    //Read all records
    public function index_get(){
        //phpinfo();
        $posts = $this->postbin_model->get();
        //echo 'Cities' .$cities;
        if(!is_null($posts)){
            $this->response(array('response' => $posts), 200);
        } else {
            $this->response(array('error' => 'Not post in the BD...', 404));
        }
       
    }

    //read one record
    public function find_get($id){
        if (!$id){
            $this->response(null, 400);
        }
        $post = $this->postbin_model->get($id);
        if (!is_null($post)){
            $this->response(array('response' => $post), 200);
        } else{
            $this->response(array('error' => 'Post not found...'), 404); 
        }
    }  

}