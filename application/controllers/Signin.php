<?php

    class Signin extends CI_Controller {
		private $user_session_key;
		private $controller_path;

		public function __construct() {
			parent::__construct();
			$this->controller_path = base_url() . 'index.php';
		}
		
        //display sign-in form
		public function showSignInForm($redirectToUrl = NULL, $proc_result = NULL)
		{
			//display home page for video listing
			$this->db->order_by('id', 'ASC');
			$category_query = $this->db->get('video_category', 25, 0);
			
			if ($category_query)
				$category_query = $category_query->result_array();
			
			$video_catalog = array();
			$videos = array();

			$current_cat = NULL;
			
			if (is_array($category_query)) {
				
				foreach ($category_query as $category) {
					
					$query = $this->db->get_where('video_catalog', array('category'=>$category['appid'], 'encoded'=>1, 'ads_video'=>0), 50, 0);
					if ($query->num_rows() > 0)
					{
						$video_catalog[$category['appid']] = array('title'=>$category['title'], 'categoryid'=>$category['appid'], 'videos'=>$query->result_array());
						$videos = array_merge($videos, $video_catalog[$category['appid']]['videos']);
					}
				}
			}

			$this->config->load('appsettings_config');
			
			$footer = $this->load->view('shared/footer', null, TRUE);
			$data['footer'] = $footer;

			$data['videos'] = $videos;
			$data['video_catalog'] = $video_catalog;
			$data['video_category'] = $category_query;
			$data['proc_result'] = $proc_result;
			$data['redirect_url'] = $redirectToUrl;
			$data['hide_right_links'] = TRUE;

			$this->load->view('subscriber_signin_view', $data);
        }
        

        //process login
		public function procSignIn()
		{
			//check if session is valid
			if ( ! isset($user_session_key) || ! isset($_SESSION['user_session_key']))
			{
				$username = trim($this->input->post('Email'));
				$password = hash('sha256', $this->input->post('Password'));
				$query = $this->db->get_where('subscribers', array(
					'email_address' => $username,
					'password' => $password
				));
				
				if ($query && $query->num_rows() > 0)
				{
					//start session
					$_SESSION['user_session_key'] = $username . '!:@' . $password;
					$_SESSION['display_name'] = $query->row('account_name');

					//redirect to user
					$redirect_url = $this->input->post('RedirectUrl');
					
					if (! empty($redirect_url) && ! is_numeric($redirect_url))
						redirect($this->controller_path . "/{$redirect_url}");
					else
						redirect($this->controller_path);

					return;
				}
			}
			else
			{
				//redirect to dashboard if session key valid
				$parts = explode('!:@', $_SESSION['user_session_key']);
				if (count($parts) > 0)
				{
					$username = $parts[0];
					$hash_password = $parts[1];
					
					$query = $this->db->get_where('admin_users', array(
						'username' => $username,
						'password' => $password
					));
	
					if ($query->num_rows > 0)
					{
						$redirect_url = $this->input->post('RedirectUrl');

						if (empty($redirect_url))
							redirect($this->controller_path);
						else
							redirect($this->controller_path . "/{$redirect_url}");

						return;
					}
				}
			}

			redirect($this->controller_path . '/subscriber/logout/1');
		}

		//process logout
		//@param case: the reason for logout call-> 1: invalid authentication details, 2: possible session expiry
		public function logout($case = NULL, $redirect_url = NULL)
		{
			unset($_SESSION['user_session_key']);
			unset($_SESSION['display_name']);

			if (! $case)
				redirect($this->controller_path . '/subscriber/signin');
			else
				redirect($this->controller_path . '/subscriber/signin/0/' . $case);
		}

		//display change password panel
		public function showChangePassword($proc_result = NULL)
		{
			if (isset($this->session->user_session_key))
			{
				$data['proc_result'] = $proc_result;
				$data["render_body"] = 'admin/change_password_view';
				$data['active_page'] = 'change-password';
				$data['uid'] = $_SESSION['user_session_key'];

				$this->load->view('shared/admin_masterview', $data);
				return;
			}

			redirect($this->controller_path . '/subscriber/logout');
		}

		//display change password panel
		public function procChangePassword()
		{
			$success = FALSE;
			if (isset($this->session->user_session_key))
			{
				$this->form_validation->set_rules('txtOldPassword', 'Old Password', 'required|min_length[5]|max_length[200]');
				$this->form_validation->set_rules('txtNewPassword', 'New Password', 'required|min_length[5]|max_length[200]');
				$this->form_validation->set_rules('txtNewPasswordConfirm', 'Password Confirmation', 'required|matches[txtNewPassword]');

				if ($this->form_validation->run())
				{
					$parts = explode('!:@', $_SESSION['user_session_key']);
					if (count($parts) > 0)
					{
						$username = $parts[0];
						$hash_password = $parts[1];

						$this->db->where(array('username'=>$username, 'password'=>hash('sha256', $this->input->post('txtOldPassword'))));
						$this->db->update('admin_users', array(
							'password' => hash('sha256', $this->input->post('txtNewPassword'))
						));

						if ($this->db->affected_rows() > 0)
							$success = TRUE;

						redirect($this->controller_path . '/subscriber/change-password/' . (int)$success);
						return;
					}
				}
			}

			redirect($this->controller_path . '/subscriber/logout');
		}
    }