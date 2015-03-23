<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_model extends CI_Model {
	
	
	public function __construct(){
    	parent::__construct();
    }
	
	public function list_data($list_details){
		try{
			if(empty($list_details) || !is_array($list_details)){
				throw new Exception("Invalid list input array provided", 1);
			}
			else{
				# return array
				$return = array();

				# where clause
				$this->db->where($list_details);
				
				# get the results from database
				$query = $this->db->get("lists");
				
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
	
	public function set_list($list_details){
		try{
			if(empty($list_details) || !is_array($list_details)){
				throw new Exception("Invalid array list input array provided", 1);
			}
			else{
				# variable to show the status of the insert
                $status = false;

                # insert records for each admin_smtp item in the $data array
                foreach ($list_details as $list) {
                    $status = $this->db->insert("lists", $list);
                }

                # return the status
                return $status;
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	}
	
	public function update_list($list_details){
		try{
			if(empty($list_details) || !is_array($list_details) || count($list_details) === 0){
				throw new Exception("Invalid array list input array provided", 1);
			}
			else{
				$status = false;
                # update the admin table for each new admin
                foreach ($list_details as $list) {
                    $this->db->where($list["where"]);
                    $status = $this->db->update("lists", $list["update"]);
                }

                # return status
                return $status;
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	}
	
	public function delete_list($list_details){
		try{
			if(empty($list_details) || !is_array($list_details)){
				throw new Exception("Invalid array list input array provided", 1);
			}
			else{
				
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	} 
	
	public function get_list_details(){
		try{
			$query = $this->db->query(
			   "select a.id as id, 
			   	a.list_name as name , 
				a.list_desc des,
				count(b.id) as cnt 
				from lists a, subscribers b 
				where a.id = b.list_id 
				group by a.list_name"
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
}
