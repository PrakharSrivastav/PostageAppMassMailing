<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	
	
	public function __construct(){
    	parent::__construct();
    }
	
	public function user_data($user_details){
		try{
			if(empty($user_details) || !is_array($user_details)){
				throw new Exception("Invalid user input array provided", 1);
			}
			else{
				# return array
				$return = array();

				# where clause
				$this->db->where($user_details);
				
				# get the results from database
				$query = $this->db->get("users");
				
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
	
	public function set_user($user_details){
		try{
			if(empty($user_details) || !is_array($user_details)){
				throw new Exception("Invalid array user input array provided", 1);
			}
			else{
				
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	}
	
	public function update_user($user_details){
		try{
			if(empty($user_details) || !is_array($user_details)){
				throw new Exception("Invalid array user input array provided", 1);
			}
			else{
				
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	}
	
	public function delete_user($user_details){
		try{
			if(empty($user_details) || !is_array($user_details)){
				throw new Exception("Invalid array user input array provided", 1);
			}
			else{
				
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	} 
	

}
