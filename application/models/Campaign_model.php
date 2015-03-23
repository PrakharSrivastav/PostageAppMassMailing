<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaign_model extends CI_Model {
	
	
	public function __construct(){
    	parent::__construct();
    }
	
	public function campaign_data($campaign_details){
		try{
			if(empty($campaign_details) || !is_array($campaign_details)){
				throw new Exception("Invalid campaign input array provided", 1);
			}
			else{
				# return array
				$return = array();

				# where clause
				$this->db->where($campaign_details);
				
				# get the results from database
				$query = $this->db->get("campaigns");
				
				# if rows found then populate the array
				if($query->num_rows() > 0){
					$return = $query->row_array();
				}
				# else return false
				else{
					return false;
				}
				
				# if the return array is empty the return false
				if(empty($return)){
					return false;
				}
				# else return the row
				else {
					return $return;
				}
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	}
	
	public function set_campaign($campaign_details){
		try{
			if(empty($campaign_details) || !is_array($campaign_details)){
				throw new Exception("Invalid array campaign input array provided", 1);
			}
			else{
				# variable to show the status of the insert
                $status = false;

                # insert records for each admin_smtp item in the $data array
                foreach ($campaign_details as $campaign) {
                    $status = $this->db->insert("campaigns", $campaign);
                }

                # return the status
                return $status;
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	}
	
	public function update_campaign($campaign_details){
		try{
			if(empty($campaign_details) || !is_array($campaign_details) || count($campaign_details) === 0){
				throw new Exception("Invalid array campaign input array provided", 1);
			}
			else{
				$status = false;
                # update the campaign table for each new admin
                foreach ($campaign_details as $campaign) {
                    $this->db->where($campaign["where"]);
                    $status = $this->db->update("campaigns", $campaign["update"]);
                }

                # return status
                return $status;
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	}
	
	public function delete_campaign($campaign_details){
		try{
			if(empty($campaign_details) || !is_array($campaign_details)){
				throw new Exception("Invalid array campaign input array provided", 1);
			}
			else{
				
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	} 
	
	public function run_query($sql){
		try{
			if(empty($sql)){
				throw new Exception("Please provide the sql for running");
			}
			else{
				$query = $this->db->query($sql);
				$return = array();
				if ($query->num_rows() > 0){
					foreach ($query->result_array() as $row){
				        $return[] = $row;
					}
				}
				else{
					return false;
				}
				
				if(empty($return)){
					return false;
				}
				else{
					return $return;
				}
			}
		}
		catch(Exception $e){
			
		}
	}
/*
	public function get_campaign_details(){
		try{
			$query = $this->db->query(
			   "select a.id as id, 
			   	a.campaign_name as name , 
				a.campaign_desc des,
				count(b.id) as cnt 
				from campaigns a, subscribers b 
				where a.id = b.campaign_id 
				group by a.campaign_name"
			);
			$return = array();
			if ($query->num_rows() > 0){
				foreach ($query->result_array() as $row){
			        $return[] = $row;
				}
			}
			else{
				return false;
			}
			
			if(empty($return)){
				return false;
			}
			else{
				return $return;
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	}
*/
}
