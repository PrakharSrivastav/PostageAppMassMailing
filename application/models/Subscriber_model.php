<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscriber_model extends CI_Model {
	
	
	public function __construct(){
    	parent::__construct();
    }
	
	public function subscriber_data($subscriber_details){
		try{
			if(empty($subscriber_details) || !is_array($subscriber_details)){
				throw new Exception("Invalid subscriber input array provided", 1);
			}
			else{
				# return array
				$return = array();

				# where clause
				$this->db->where($subscriber_details);
				
				# get the results from database
				$query = $this->db->get("subscribers");
				
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
	
	public function all_subscriber_data($subscriber_details){
		try{
			if(empty($subscriber_details) || !is_array($subscriber_details)){
				throw new Exception("Invalid subscriber input array provided", 1);
			}
			else{
				# return array
				$return = array();

				# where clause
				$this->db->where($subscriber_details);
				
				# get the results from database
				$query = $this->db->get("subscribers");
				
				# if rows found then populate the array
				if($query->num_rows() > 0){
					// $return = $query->result_array();
					foreach ($query->result_array() as $row){
					         $return[] = $row;
					        //print_r($row);
					}
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
	
	public function set_subscriber($subscriber_details){
		try{
			if(empty($subscriber_details) || !is_array($subscriber_details)){
				throw new Exception("Invalid array subscriber input array provided", 1);
			}
			else{
				# variable to show the status of the insert
                $status = false;

                # insert records for each admin_smtp item in the $data array
                foreach ($subscriber_details as $subscriber) {
                    $status = $this->db->insert("subscribers", $subscriber);
                }

                # return the status
                return $status;
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	}
	
	public function update_subscriber($subscriber_details){
		try{
			if(empty($subscriber_details) || !is_array($subscriber_details)){
				throw new Exception("Invalid array subscriber input array provided", 1);
			}
			else{
				$status = false;
                # update the admin table for each new admin
                foreach ($subscriber_details as $subscriber) {
                    $this->db->where($subscriber["where"]);
                    $status = $this->db->update("subscribers", $subscriber["update"]);
                }

                # return status
                return $status;
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	}
	
	public function delete_subscriber($subscriber_details){
		try{
			if(empty($subscriber_details) || !is_array($subscriber_details)){
				throw new Exception("Invalid array subscriber input array provided", 1);
			}
			else{
				
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	} 
	
	public function insert_batch($data) {
        try {
            if (!is_array($data) && empty($data)) {
             	throw new Exception("Invalid array subscriber input array provided", 1);
            } else {
              	return $this->db->insert_batch('subscribers', $data);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
	
	public function where_in($subscriber_details){
		try{
			if(empty($subscriber_details) || !is_array($subscriber_details)){
				throw new Exception("Invalid subscriber input array provided", 1);
			}
			else{
				# return array
				$return = array();

				# where clause
				$this->db->where_in($subscriber_details[0],$subscriber_details[1]);
				
				# get the results from database
				$query = $this->db->get("subscribers");
				// print_r($query->num_rows());
				# if rows found then populate the array
				if($query->num_rows() > 0){
					// $return = $query->result_array();
					foreach ($query->result_array() as $row){
					         $return[] = $row;
					        //print_r($row);
					}
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
}
