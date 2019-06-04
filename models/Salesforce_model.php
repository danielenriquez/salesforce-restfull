<?php
define("USERNAME", "salesforce@email.com");
define("PASSWORD", "paswword");
define("SECURITY_TOKEN", "salesforce-token-here");

require_once  APPPATH .'salesforce_api/soapclient/SforcePartnerClient.php';

class Salesforce_model extends CI_Model {
    private $mySforceConnection;
    public function __construct() {
        parent::__construct();        
        //Stablishing Salesforce connection
        $this->mySforceConnection = new SforcePartnerClient();	
        //Path to the WSDL xml generared by SalesForce API (Setup/API)
        $this->mySforceConnection->createConnection(APPPATH ."salesforce_api/PartnerWSDL.xml");
        $this->mySforceConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);
        //Check connection
        if ($this->mySforceConnection == null){
            exit('Connection error!');
        }
    }

    public function get($id = null){
        if(!is_null($id)){
            //Query SF Object
            $query = "SELECT Id,FirstName,Phone,Email FROM Lead WHERE Id='" .$id. "'";
            $response = $this->mySforceConnection->query(($query));
           
            if(count($response->records) === 1){
                $json = json_encode($response->records);                
                return json_decode($json);
            }
            return null;
        }        
        //Query SF Object
        $query = "SELECT Id,FirstName,Phone,Email,LeadSource,Status,FLYBUY__c FROM Lead limit 10000";
        $response = $this->mySforceConnection->query(($query));

        if(count($response->records) > 0){
            //print_r($response);
            $json = json_encode($response->records);
            return json_decode($json);
        }

        return null;
    }   
    
    //Add new Lead
    public function save($lead){
        $data = $this->setLead($lead);
        
        $sfObject = new SObject();
        $sfObject->fields = $data;
        $sfObject->type = 'Lead';	
    
        //Add Lead to SF
        $create = $this->mySforceConnection->create(array($sfObject));
        $json = (string)json_encode($create[0]);        
        $decoJson = json_decode($json);

        //return SF object with record id or error message.
        return $decoJson;
    } 

    //Update existing Lead, passing the id
    public function update($id, $lead){      
        //00Qw000001A4fXDEAZ
        $arrayFields = $this->setDynamicFields($lead);
        $sfObject = new SObject();
        $sfObject->fields =  $arrayFields;
        $sfObject->type = 'Lead';
        $sfObject->Id = $id;

        //Update SF lead Object
        $update = $this->mySforceConnection->update(array ($sfObject));
        $json = (string)json_encode($update[0]);        
        $decoJson = json_decode($json);

        return $decoJson;

    }     

    //Delete existing lead passing the id
    public function delete($id){

        $delete = $this->mySforceConnection->delete($id);
        $json = (string)json_encode($delete[0]);        
        $decoJson = json_decode($json);

        return $decoJson;
    }    
    
    //Convert Campaigns posted object in array
    private function setLead($lead){
        return array(
            'FirstName' => $lead['firstname'],
            'LastName' => $lead['lastname'],
            'Phone' => $lead['phone'],
            'Email' => $lead['email']
        );
    }  

    private function setDynamicFields($fields){
        foreach($fields as $key => $value) {
            $fieldsArray[$key] = $fields[$key];
        }
        return $fieldsArray;
    }        
}