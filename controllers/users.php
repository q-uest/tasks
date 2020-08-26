<?php


class Users extends CI_Controller {
	

//	public function Show() 
 //	{
	

	 //	$this->load->model('user_model');
	//	$data['result'] = $this->user_model->get_users();

	//	$this->load->view('users',$data);

		// foreach ($result as $object) 
		//{
		//	echo "firing foreach loop";
		//	echo "<br>";
		//	echo $object->id."<br>";
		//	echo $object->Name."<br>";
		//}
		//

	//}
//}
   public function validate() {


// echo "form_validation()=".$this->form_validation->run();


	
$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]');

$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[3]');

$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]');

$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');

		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
        
        $this->form_validation->set_rules('Confpswd', 'Pswd', 'trim|required|min_length[3]');





if ($this->form_validation->run() == FALSE )

	{

		//echo "Form_validation is false..ReLoading register_view()";


		$errdata = array(
				'regerr' => validation_errors('<p class="bg-danger">')
						);

		$this->session->set_flashdata($errdata);


			
		$data['main_view'] = 'users/register_view';
   		$this->load->view('layout/main', $data);
 	
 		
	}

   	else
   	{
   		//echo "form_validate() is true";
   		if($this->user_model->create_user()) 
   		{
   				$this->session->set_flashdata('user_registered','<p class="bg-danger">User has been registered </p>');
   				redirect('home/index');	
   		}
   		
   	}
   		

   	


   }

   public function register() {

		$data['main_view'] = 'users/register_view';
   		$this->load->view('layout/main', $data);

   }
	
   public function get_user_lastloggedin() {

	echo '[{"last_loggedin_at":"'.$_SESSION['last_loggedin'].'"}]' ;
}
public function js_get_user_lastloggedin()
{
?>
	<script> type="text/javascript" 
	var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "http://localhost/ci/users/get_user_lastloggedin", true);
    console.log('this is after xhttp.open statement');
    xhttp.send();
    console.log('this is after xhttp.send');
  
          xhttp.onreadystatechange = function() 
    			{
            
      			if (this.readyState == 4 && this.status == 200)
      			{
      				console.log("responseText=".concat(this.responseText));
      				//if (this.responseText.length > 3)
      				//{
      					var vlast_loggedin = JSON.parse(this.responseText); 
      					console.log("vlast_loggedin="+vlast_loggedin[0].last_loggedin_at);
      					var vlog=vlast_loggedin[0].last_loggedin_at;
      				//}
      			}
      			return(vlog);
                
           }


		</script>
<?php
   }


	public function login() {

		//$this->form_validation->set_rules('username','Username','trim|required|min_length[3]')
		//echo "users.login() called";

		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');

		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
        
        // $this->form_validation->set_rules('Confpswd', 'Pswd', 'trim|required|min_length[1]|matches[password]');

      //  echo "users.login()....form_validation=".$this->form_validation->run();

		if ($this->form_validation->run() == FALSE) 
		{

			//echo "form_validation login() is false";
			$data = array(
				'loginerr' => validation_errors()
						);

			$this->session->set_flashdata($data);
			

			
			#echo "this is users\login()";

			
			redirect('home');

		}
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$user_id=$this->user_model->login_user($username,$password);
			$last_logged_time=$this->user_model->get_last_loggedin_time($username);
			echo "userid=".$user_id;

			if ($user_id) 
			{
				echo "if user_id check is through";
				echo "last logged time=".$last_logged_time;
				// write the userinfo into session array for later use
				
				$user_data = array(
					'user_id' => $user_id,
					'username' => $username,
					'logged_in' => TRUE,
					'last_loggedin' => $last_logged_time

				);

            //echo "login success";

			$this->session->set_userdata($user_data);

			$this->session->set_flashdata('login_success','You are now logged in');

			#$data['main_view'] = "admin_view";
			#$this->load->view('layout/main',$data);
			

			redirect('home/index');

			}
			else
			{

				$this->session->set_flashdata('login_failure','Login Failed');

				 redirect('home/index');
			}



		}

		

	}




	public function logout() {
		echo "this is users/logout() func";
		$user_id=$this->user_model->last_logged_time($_SESSION['username']);
		$this->session->sess_destroy();
		redirect('home/index');
	}
}

?>