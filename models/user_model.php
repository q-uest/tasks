<?php


class User_model extends CI_Model {


	// public function get_users() {

	
		//$config['hostname']="localhost";
		//$config['username']="root";
		//$config['password']="";
		//$config['database']="users";

		// $connection = $this->load->database($config);


		// $query = $this->db->get('users');
		
		// return $query->result();



	public function create_user() 
	{
		$options = ['cost' => 12];
		$encrypted_pass = password_hash($this->input->post('password'),PASSWORD_BCRYPT,$options);
		echo "encrypted_pass=".$encrypted_pass;

		$data = array(
			'Firstname' => $this->input->post('first_name'),
			'Lastname' => $this->input->post('last_name'),
			'Email' => $this->input->post('email'),
			'Username' => $this->input->post('username'),
			'Password' => $encrypted_pass
			         );



		$insert_data = $this->db->insert(users,$data);
		return $insert_data;

	}


	public function get_user()
	{	
		$this->db->select('id,username');
		$result = $this->db->get('users')->result_array();
#		$result = $rawres->result_array();
		#echo "from user_model username=".$result[0]['username'];
		return $result;

	}

	public function curtime()
	{

		$query=$this->db->query(
		"SELECT NOW() ct");
		
		return $query->row();	
	}

	public function last_logged_time($username)
	{

		$ctime=$this->user_model->curtime();
		#$row=$query->row();
		echo $ctime->ct;
        	
		
		
		$update_set = array(
			'last_loggedin' => $ctime->ct
		);
		$this->db->where('username',$username);
		$this->db->update('users',$update_set);
	}


	public function get_last_loggedin_time($username)
	{
		$this->db->select('last_loggedin');
		$this->db->where('username',$username);
		
		$result = $this->db->get('users')->result_array();
		return $result[0]['last_loggedin'];


	}
	

public function db_getuser($userid)
{

	$this->db->where('id',$userid);
	$task=$this->db->get('users');
	return $task->result_array();
}


	public function login_user($username,$password) 
	{

		$this->db->where('username',$username);
		$rawres = $this->db->get('users');
		$result = $rawres-> result_array();

		#echo "num rows=".$rawres->num_rows();
		if ($rawres->num_rows() == 1 ) 
		{	
			#$options = ['cost' => 12];
  		    #$hash= password_hash($password,PASSWORD_BCRYPT,$options);
  		    #echo "  hash=".$hash;
			#$db_password = $result->row(2)->Password;
			echo "db_password=".$result[0]['Password'];
			$db_password = $result[0]['Password'];
			echo "      	password=".$password;

			# echo "db_password=  ".$db_password;
			 #echo "       var_dump of db_password=".var_dump($db_password);

			if (password_verify($password, $db_password)) 
			{

				echo "password verification is through";
				return $result[0]['id'];
			}
			else
			{
					echo "password verification failed";
					return false;

			}

		}

	
	}
	
}

?>