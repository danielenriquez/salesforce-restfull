<?php
class Cities_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    //get all cities or one city by id
    public function get($id = null){
        if(!is_null($id)){
            $this->db->where('id', $id);
            $query = $this->db->select('*')->from('cities')->get();
            if($query->num_rows() === 1){
                return $query->row_array();
            }
            return null;
        }

        $query = $this->db->select('*')->from('cities')->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }

        return null;
    }

    //Add new city
    public function save($city){
        $data = $this->setCity($city);

        $this->db->insert('cities', $data);

        if($this->db->affected_rows() === 1){
            return $this->db->insert_id();
        }
        return null;
    }

    //Update existing city, passing the id
    public function update($id, $city){        
        $data = $this->setCity($city);

        $this->db->where('id', $id);
        $this->db->update('cities', $data);
        if($this->db->affected_rows() === 1){
            return true;
        }
        return null;
    }    

    //delete existing city passing the id
    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('cities');
        if($this->db->affected_rows() === 1){
            return true;
        }
        return null;
    }

    //convert city posted object in array
    private function setCity($city){
        return array(
            'name' => $city['name']
        );
    }

}