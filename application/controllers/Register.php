<?php

    class Register extends CI_Controller {
        private $controller_path;
        
        public function __construct()
        {
            parent::__construct();
            $this->controller_path = base_url() . 'index.php/subscriber/';
        }

        //display registration form
		public function showRegistrationForm($proc_result = NULL)
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
				foreach ($category_query as $category)
				{
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

            if (isset($proc_result))
            {
                //find account
                $query = $this->db->get_where('subscribers', array('sub_appid'=>$proc_result));
                if ($query->num_rows() == 0)
                    $data['proc_result'] = FALSE;
                else {
                    $data['proc_result'] = TRUE;
                    $result = $query->result_array();
                    $data['confirmation_email'] = $result[0]['email_address'];
                }
            }
            else
                $data['proc_result'] = NULL;
            
            $data['hide_right_links'] = TRUE;
            $data['hide_right_signin_link'] = FALSE;

			$this->load->view('subscriber_register_view', $data);
        }

        //process registration
        public function procRegistrationForm()
        {
            $this->form_validation->set_rules('txtUsername', 'Username', 'required|min_length[5]|max_length[25]');
            $this->form_validation->set_rules('txtEmail', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('txtConfirmPassword', 'Confirm Password', 'required|min_length[6]');
            $this->form_validation->set_rules('txtPassword', 'Password', 'required|min_length[6]|matches[txtConfirmPassword]');
            

            if ($this->form_validation->run()) {
                //check that email does not exist
                $query = $this->db->get_where('subscribers', array('email_address'=>$this->input->post('txtEmail')));

                if ($query->num_rows() == 0)
                {
                    //add to subscribers
                    $appid = generateID(20);
                    $this->db->insert('subscribers', array(
                        'sub_appid'=>$appid,
                        'account_name'=>$this->input->post('txtUsername'),
                        'email_address'=>$this->input->post('txtEmail'),
                        'password'=>hash('sha256', $this->input->post('txtPassword')),
                        'sub_expires'=> mktime()
                    ));

                    if ($this->db->affected_rows() > 0) {
                        redirect($this->controller_path . 'register/' . $appid);
                        return;
                    }
                }
            }

            redirect($this->controller_path . 'register/None');
        }

        //activate subscriber account
        public function activateAccount($sub_appid)
        {
            //display home page for video listing
			$this->db->order_by('id', 'ASC');
			$category_query = $this->db->get('video_category', 25, 0)->result_array();
			$video_catalog = array();
			$videos = array();

			$current_cat = NULL;
			foreach ($category_query as $category)
			{
				$query = $this->db->get_where('video_catalog', array('category'=>$category['appid'], 'encoded'=>1, 'ads_video'=>0), 50, 0);
				if ($query->num_rows() > 0)
				{
					$video_catalog[$category['appid']] = array('title'=>$category['title'], 'categoryid'=>$category['appid'], 'videos'=>$query->result_array());
					$videos = array_merge($videos, $video_catalog[$category['appid']]['videos']);
				}
			}

			$this->config->load('appsettings_config');
			
			$footer = $this->load->view('shared/footer', null, TRUE);
			$data['footer'] = $footer;

			$data['videos'] = $videos;
			$data['video_catalog'] = $video_catalog;
            $data['video_category'] = $category_query;
            $data['proc_result'] = FALSE;

            if (! empty($sub_appid)) {
                $query = $this->db->get_where('subscribers', array('sub_appid'=>$sub_appid));

                if ($query->num_rows() > 0)
                {
                    //activate
                    $this->db->where('sub_appid', $sub_appid);
                    $this->db->update('subscribers', array(
                        'account_confirmed'=> date('Y-m-d H:i:s')
                    ));

                    if ($this->db->affected_rows() > 0)
                    {
                        $data['activated'] = TRUE;
                        $data['fullname'] = 'Gbemi';//$query->row()->account_name;
                        $this->load->view('subscriber_account_confirmed', $data);

                        return;
                    }
                }
            }

            $data['activated'] = FALSE;
            $data['fail_reason'] = "We can't say exactly how you got to this point. But if you are looking for xrated, You are in the right place.";

            $this->load->view('subscriber_account_confirmed', $data);
        }
    }