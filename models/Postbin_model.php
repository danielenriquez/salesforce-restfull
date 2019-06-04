<?php
class Postbin_model extends CI_Model {

    public function __construct() {
        parent::__construct();        
        $this->db = $this->load->database('wp_bookitnow', TRUE); // the TRUE paramater tells CI that you'd like to return the database object.
    }

    //get all cities or one city by id
    public function get($id = null){

        if(!is_null($id)){
            $this->db->where('id', $id);
            $query = $this->db->select('id, post_date, post_title')->from('spdomains_posts')->get();
            if($query->num_rows() === 1){
                return $query->row_array();
            }
            return null;
        }
        
        $query = $this->db->select('id, post_date, post_title')->from('spdomains_posts')->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }

        return null;
    }
    
}