<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template_model extends CI_Model {
	
	
	public function __construct(){
    	parent::__construct();
    }
	
	public function template_data($template_details){
		try{
			if(empty($template_details) || !is_array($template_details)){
				throw new Exception("Invalid template input array provided", 1);
			}
			else{
				# return array
				$return = array();

				# where clause
				$this->db->where($template_details);
				
				# get the results from database
				$query = $this->db->get("templates");
				
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
	
	public function set_template($template_details){
		try{
			if(empty($template_details) || !is_array($template_details)){
				throw new Exception("Invalid array template input array provided", 1);
			}
			else{
				# variable to show the status of the insert
                $status = false;

                # insert records for each admin_smtp item in the $data array
                foreach ($template_details as $template) {
                    $status = $this->db->insert("templates", $template);
                }

                # return the status
                return $status;
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	}
	
	public function update_template($template_details){
		try{
			if(empty($template_details) || !is_array($template_details) || count($template_details) === 0){
				throw new Exception("Invalid array template input array provided", 1);
			}
			else{
				$status = false;
                # update the admin table for each new admin
                foreach ($template_details as $template) {
                    $this->db->where($template["where"]);
                    $status = $this->db->update("templates", $template["update"]);
                }

                # return status
                return $status;
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	}
	
	public function delete_template($template_details){
		try{
			if(empty($template_details) || !is_array($template_details)){
				throw new Exception("Invalid array template input array provided", 1);
			}
			else{
				
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	} 
	
	public function get_templates(){
		try{
			$query = $this->db->query("select id, template_name , template_desc from templates order by template_name");
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
