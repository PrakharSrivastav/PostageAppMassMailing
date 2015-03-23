<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
    	parent::__construct();
    }
	
	public function index() {
		$this->load->helper(array('form'));
		$this -> load -> view('login');
	}
	
	public function logout(){
		try{
			$unset = array("id" ,"email" ,"password" ,"active" ,"role" ,"is_logged_in");
			$this->session->unset_userdata($unset);
			$this->session->sess_destroy();
			$this->load->helper(array('form'));
			$this -> load -> view('login');
		}
		catch(Exception $e){
			print_r($e);
		}
	}
	
	public function validate(){
		try{
			$this->load->helper(array('form'));
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules("login_email","Registered Email","required|valid_email");
			$this->form_validation->set_rules("login_password","Your password","required|min_length[5]");
			
			if ($this->form_validation->run() == FALSE){
	      		$this->load->view('login');
	        }
	        else{
	        	$email = $this->input->post("login_email");
				$password = $this->input->post("login_password");
	        	
	        	$this->load->model("User_model","user");
	        	
	        	$user_details = $this->user->user_data(array("email" => $email));
				if($user_details!== false && $email === $user_details['email'] && $password === $user_details['password']){
	        		$this->session->set_userdata($user_details);
					$this->session->set_userdata(array("is_logged_in"=>true));
					redirect("login/view_dashboard");
	        	}
				else{
					$this -> load -> view('login',array("error"=>"Invalid username / password."));
				} 
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	}
	
	public function view_dashboard(){
		try{
			if($this->session->userdata("is_logged_in")){
				$this->load->library("postageApp");
				$metric = json_decode(json_encode($this->postageapp->get_metrics()),true);;
				// print_r($metric);
				
				$this->load->model("Campaign_model","camp");
				$campaigns = $this->camp->run_query("select a.id , b.list_name , a.end_time, a.insert_date, a.progress, a.sent, a.start_time, a.subscriber, c.template_name from campaigns a , lists b , templates c where a.list_id = b.id and a.template_name = c.id  order by a.start_time DESC");
				$data = array(
					"campaigns"=>$campaigns,
					"metric"=>$metric
				);
				$this->load->view("template/header");
				$this->load->view('dashboard',$data);
				$this->load->view("template/footer");
			}
			else{
				throw new Exception("Your Session has Expired. Please login and try again.", 1);
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	}
	
	public function view_lists(){
		try{
			if($this->session->userdata("is_logged_in")){
				$this->load->model("List_model","list");
				$data = $this->list->get_list_details();
				$this->load->helper(array('form'));
				$this->load->view("template/header");
				$this->load->view('lists',array("list_data"=>$data));
				$this->load->view("template/footer");
			}
			else{
				throw new Exception("Your Session has Expired. Please login and try again.", 1);
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	}
	
	public function view_templates(){
		try{
			if($this->session->userdata("is_logged_in")){
				$this->load->helper(array('form'));
				$this->load->model("Template_model","template");
				$templates = $this->template->get_templates();
				$this->load->view("template/header");
				$this->load->view('templates',array("template_data" => $templates));
				$this->load->view("template/footer");
			}
			else{
				throw new Exception("Your Session has Expired. Please login and try again.", 1);
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	}
	
	public function view_campaigns(){
		try{
			if($this->session->userdata("is_logged_in")){
				# load form helper	
				$this->load->helper(array('form'));
				
				# load models
				$this->load->model("Template_model","template");
				$this->load->model("List_model","list");
				
				# get template and list data from database
				$templates = $this->template->get_templates();
				$data = $this->list->get_list_details();
				
				# load the views
				$this->load->view("template/header");
				$this->load->view('campaigns',array("template_data"=>$templates,"list_data"=>$data));
				$this->load->view("template/footer");
			}
			else{
				throw new Exception("Your Session has Expired. Please login and try again.", 1);
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	}
	
	public function upload_list_details(){
		try{
			if($this->session->userdata("is_logged_in")){
				
				# validate the form and get the input parameters
				$this->load->library('form_validation'); 
				$this->load->model("List_model","list");
				
				$this->form_validation->set_rules("list_name","List Name", "required|is_unique[lists.list_name]");
				$this->form_validation->set_rules("list_desc","List Description", "required");
				// $this->form_validation->set_rules("file_name","File Name", "required");
				
				if($this->form_validation->run() === false){
					$data = $this->list->get_list_details();
					$this->load->helper(array('form'));
					$this->load->view("template/header");
					$this->load->view('lists',array("list_data"=>$data));
					$this->load->view("template/footer");
				}
				else{
					# get all input parameters
					$list_name = $this->input->post("list_name");
					$list_desc = $this->input->post("list_desc");
					//$file_name = $this->input->post("file_name");
					
					$file_name = "csv_" . date("Y_m_d_h") . ".csv";
					# upload the file to some location
					$config['upload_path']          = './upload/';
	                $config['allowed_types']        = 'csv';
	                $config['max_size']             = 12048;
	                $config['overwrite']            = TRUE;
					$config['file_name']            = $file_name;
					
					# load the library
					$this->load->library('upload', $config);
					
					# perform the file upload
					if ( ! $this->upload->do_upload('file_name')){
                        $data = $this->list->get_list_details();
						$this->load->helper(array('form'));
						$this->load->view("template/header");
						$this->load->view('lists',array(
							"list_data"=>$data,
							'upload_error' => $this->upload->display_errors())
						);
						$this->load->view("template/footer");
                	}
                	else{
                        # create a list and get the list id mark it as inactive
                        $list_data = array(
							"list_name" => $list_name,
							"list_desc" => $list_desc,
							"active" => '0'
						);
						
						$this->load->model("List_model","list");
						if($this->list->set_list(array($list_data))){
								
							# get the list-id
							$list_data = array("list_name" => $list_name);
							$list_details = $this->list->list_data($list_data);
							$list_id = $list_details["id"];
							
							# parse the content of the file and get an array of records
							$csv_configuration = array("file_name" => FCPATH . "upload/" . $file_name);
							$this->load->library("csvhandler", $csv_configuration);
							
							# get the return array
							$csv_data = $this->csvhandler->read_csv_data();
							
							
							# if the return array is not empty
							if (count($csv_data) > 0) {
								 ini_set('memory_limit', '1024M'); 
								# include the list id to the array and prepare the upload data
								$upload_array = array();
								foreach ($csv_data as $csv) {
									$upload_array[] = array_merge($csv, array("list_id" => $list_id));
								}
		
								# load the subscribers model
								$this->load->model("Subscriber_model", "subscriber");
								
								# insert the array in a batch into database
								if ($this->subscriber->insert_batch($upload_array) !== FALSE) {
									# if the insertion is successfull update the list to active
									$list_update = array("active"=>'1');
									$list_where = array("id"=>$list_id,"list_name"=>$list_name,"active"=>'0');
									$list_array = array("where"=>$list_where,"update"=>$list_update);
									
									# load the list view
									if($this->list->update_list(array($list_array))){
										$data = $this->list->get_list_details();
										$this->load->helper(array('form'));
										$this->load->view("template/header");
										$this->load->view('lists',array("list_data"=>$data,"success"=>"List is created successfully"));
										$this->load->view("template/footer");
									}
								}
							} else {
								throw new Exception("No Data in the CSV file. Please validate the csv fila data and format and try again.");
							}
							
						}
						else{
							$error = array('error' => "Problem occured while creating list. Probably a list with same name already exists. Please try again with a different list name.");
							$this->load->view("template/header");
							$this->load->view('lists',$error);
							$this->load->view("template/footer");
						}
					}
				}
			}
			else{
				throw new Exception("Your Session has Expired. Please login and try again.", 1);
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	}

	public function upload_template_details(){
		try{
			if($this->session->userdata("is_logged_in")){
				// print_r($this->input->post());
				$this->load->helper(array('form'));
				
				# validate the form inputs 
				$this->load->library("form_validation");
				$this->form_validation->set_rules("template_name","Template Name","required|is_unique[templates.template_name]");
				if($this->form_validation->run() === false){
					$this->load->view("template/header");
					$this->load->view('templates');
					$this->load->view("template/footer");
				}
				else{
					# get the post parameters
					$template_name = trim($this->input->post("template_name"));
					$tempalte_desc = trim($this->input->post("template_desc"));
					
					# create the database array
					$template_data = array(
						"template_name" => $template_name , 
						"template_desc" => $tempalte_desc
					);
					$this->load->model("Template_model","template");
					
					# add the details to the database
					if($this->template->set_template(array($template_data))){
						$templates = $this->template->get_templates();
						$this->load->view("template/header");
						$this->load->view('templates',array("template_data" => $templates,"success"=>true));
						$this->load->view("template/footer");
					}
					else{
						throw new Exception("Duplicate Template name, please try with a different name");
					}
				}	
			}
			else{
				throw new Exception("Your Session has Expired. Please login and try again.", 1);
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	}

	public function queue_emails(){
		try{
			if($this->session->has_userdata("is_logged_in") && $this->session->userdata("is_logged_in")){
				# load helper, library and models
				$this->load->helper(array('form'));
				$this->load->library("form_validation");
				$this->load->model("Template_model","template");
				$this->load->model("Subscriber_model","subscriber");
				$this->load->model("List_model","list");
				
				# set the rules
				$this->form_validation->set_rules("template","Template name","required");
				$this->form_validation->set_rules("list","List name","required");
				
				# run the validation rules
				if($this->form_validation->run() === false){
					# get template and list data from database
					$templates = $this->template->get_templates();
					$data = $this->list->get_list_details();
					
					# load the views
					$this->load->view("template/header");
					$this->load->view('campaigns',array("template_data"=>$templates,"list_data"=>$data));
					$this->load->view("template/footer");
				}
				else{
					$templ = trim($this->input->post("template"));
					$list  = trim($this->input->post("list"));
					
					$templ = $this->template->template_data(array("id"=>$templ));
					$list = $this->subscriber->all_subscriber_data(array("list_id"=>$list));
					
					if (count($list)>0 && count($templ)>0){
						$sub_lst = array();
						foreach($list as $item){
							$sub_lst[] = $item['id'];
						}
						
						$campaign["template_name"] 	= $templ['id'];
						$campaign["list_id"]	 	= $list[0]['list_id'];
						$campaign["progress"]	 	= '1';
						unset($list);
						$campaign["subscriber"] 	= json_encode($sub_lst);
						$campaign["insert_date"]	= date("Y-m-d H:i:s");
						$campaign["start_time"]		= date("Y-m-d H:i:s");
						$campaign["end_time"]		= "";
						unset($sub_lst);
						
						$this->load->model("Campaign_model","camp");
						ini_set('memory_limit', '1024M'); 
						if($this->camp->set_campaign(array($campaign))){
							# get template and list data from database
							$templates = $this->template->get_templates();
							$data = $this->list->get_list_details();
							
							# load the views
							$this->load->view("template/header");
							$this->load->view('campaigns',array("template_data"=>$templates,"list_data"=>$data,"success"=>TRUE));
							$this->load->view("template/footer");
						}
					}
				}
			}
			else{
				throw new Exception("Your Session has Expired. Please login and try again.", 1);
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	}

	public function run_cron_job(){
		try{
			$sql = "SELECT a.`id`, a.`progress`,b.`template_name`,a.`subscriber`,a.`start_time`,a.`end_time` ,a.`sent` 
					FROM `campaigns` a,`templates` b 
					where a.`start_time`= (select min(`start_time`) from `campaigns` where `progress` in ('1','2')) 
					and a.`template_name` = b.`id` 
					and a.`progress` in ('1','2')";
			$this->load->model("Campaign_model","campaign");
			$return_val = $this->campaign->run_query($sql);
			if($return_val === false){
				exit();
			}
			else{
				// print_r($return_val);
				foreach($return_val as $ret){
					# get the data
					$progress	=	$ret["progress"];
					$template	=	$ret["template_name"];
					$subscriber	=	json_decode($ret["subscriber"]);
					$sent		=	json_decode($ret["sent"]);
					$start_time	=	$ret["start_time"];
					$end_time	=	$ret["end_time"];
					$row_id		= 	$ret['id'];
					// var_dump(json_decode($ret["subscriber"],TRUE));
					// print_r(json_last_error_msg());
					
					
					$this->load->library('postageApp');
					
					
					# update the progress to 2
					$where = array(
						'id'		=>	$row_id,
						'progress'	=>	$progress,
						'start_time'=>	$start_time
					);
					
					$update = array(
						'progress'	=> '2'
					);
					
					$db = array(
						"where"		=>	$where,
						"update"	=> 	$update
					);
					
					if($this->campaign->update_campaign(array($db))){
						# find the total number of subscribers
						$sub_count 	=	count($subscriber);
						$split_sub 		= 	array();
						# split the subscribers into a batch size
						$split_sub = array_splice($subscriber , 0 , 100);
						
						print_r($sub_count);
						print_r(count($split_sub));
						# foreach subscribers in the batch send emails.
						$this->load->model("Subscriber_model","sub");
						$tot_subs = $this->sub->where_in(array("id",$split_sub));
						
						foreach($tot_subs as $sub){
							$this->postageapp->from('srivprakhar@gmail.com');
							$this->postageapp->to($sub["email"]);
							$this->postageapp->subject('Example Email');
							$this->postageapp->message('Example Message');
							$this->postageapp->template($template);
							$this->postageapp->send();
						}
						# update the subscribers , sent , sent time columns
						$where = array(
							'id'		=>	$row_id,
							'progress'	=>	'2',
							'start_time'=>	$start_time,
						);
						
						$prog = "";
						if (count($subscriber) === 0){
							$prog = '3';
						}
						else{
							$prog = '2';
						}
						
						$update = array(
							'progress'	 => $prog,
							'subscriber' => json_encode($subscriber),
							'sent'		 => json_encode(array_merge($sent,$split_sub)),
							'end_time'  =>  date("Y-m-d H:i:s")
						);
						
						$db = array(
							"where"		=>	$where,
							"update"	=> 	$update
						);
						
						if($this->campaign->update_campaign(array($db))){
							Echo "process complete";
						}
						# if subscribers > 0 update = 2 else update to 3	
					}
					else{
						throw new Exception("Could not update the initial status in the database", 1);	
					}
				}
			}
		}
		catch(Exception $e){
			print_r($e);
		}
	}
}
