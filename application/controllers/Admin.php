<?php

	class Admin extends CI_Controller
	{
		private $user_session_key;
		private $controller_path;
		private $vidly_userid = '12664';
		private $vidly_userkey = 'd66e8c72715fd0a7ba15672075bd9f39';

		public function __construct()
		{
			parent::__construct();
			$this->controller_path = base_url() . 'index.php/admin/';

			$this->load->library('upload');
		}

		//display login page
		public function index($proc_result = NULL)
		{
			$data['proc_result'] = $proc_result;

			$this->load->view('admin/admin_login_view', $data['proc_result']);
		}

		//process login
		public function processLogin()
		{
			//check if session is valid
			if ( ! isset($user_session_key) || ! isset($_SESSION['user_session_key']))
			{
				$username = trim($this->input->post('username'));
				$password = hash('sha256', trim($this->input->post('userpassword')));
				$query = $this->db->get_where('admin_users', array(
					'username' => $username,
					'password' => $password
				));

				if ($query->num_rows() > 0)
				{
					//start session
					$_SESSION['user_session_key'] = $username . '!:@' . $password;
					//redirect to dashboard
					redirect($this->controller_path . 'dashboard');
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
						redirect($this->controller_path . 'dashboard');
						return;
					}
				}
			}

			redirect($this->controller_path . 'logout');
		}

		//process logout
		public function processLogout()
		{
			unset($_SESSION['user_session_key']);

			redirect($this->controller_path . 'index');
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

			redirect($this->controller_path . 'logout');
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

					$this->db->where(array('username'=>$username/*, 'password'=>hash('sha256', $this->input->post('txtOldPassword'))*/));
						$this->db->update('admin_users', array(
							'password' => hash('sha256', $this->input->post('txtNewPassword'))
						));

						if ($this->db->affected_rows() > 0)
							$success = TRUE;

						redirect($this->controller_path . 'change-password/' . (int)$success);
						return;
					}
				}
			}

			redirect($this->controller_path . 'logout');
		}


		//display dashboard
		public function showDashboard($proc_result = NULL)
		{
			if (isset($this->session->user_session_key))
			{
				$data['proc_result'] = $proc_result;

				$data["render_body"] = 'admin/dashboard_view';
				$data['active_page'] = 'dashboard';

				$data['total_videos'] = $this->db->get('video_catalog')->num_rows();
				$data['total_encodings'] = $this->db->get_where('video_catalog', array('encoded' => 1))->num_rows();

				$data['total_views'] = (int)$this->db->query('SELECT SUM(num_views) AS watch_count FROM video_catalog')->row_array()['watch_count'];
				$data['total_pending'] = $this->db->get_where('video_catalog', array('encoded' => 0))->num_rows();

				$data['homebanner'] = 'dudubanner_default.png';

				$this->config->load('appsettings_config');
				$homebanner = $this->config->item('homebanner');
				if (isset($homebanner) && !empty($this->config->item('homebanner')))
				{
					$data['homebanner'] = $this->config->item('homebanner');
				}

				$this->load->view('shared/admin_masterview', $data);
				return;
			}
			
			redirect($this->controller_path . 'logout');
		}
		
		//process home banner update
		public function procUpdateHomeBanner()
		{
			$success = FALSE;

			if ( !empty($_FILES['fileHomeBannerImageFile']['tmp_name']) )
			{
				$file_name = 'dudubanner.' . pathinfo($_FILES['fileHomeBannerImageFile']['name'], PATHINFO_EXTENSION);

				//echo "<br/>{$file_name}";
				
				$this->upload->initialize(array(
					'upload_path' => $this->config->item('static_files_path'),
					'allowed_types' => 'png|jpg|bmp|gif',
					'overwrite' => TRUE,
					'max_size' => '0',
					'file_name' => $file_name
				));

				if ($this->upload->do_upload('fileHomeBannerImageFile'))
				{
					$appsettings = './application/config/appsettings_config.php';
					$content = "<?php $" . "config['homebanner'] = '" . $file_name . "';";
					@file_put_contents($appsettings, $content);

					$success = TRUE;
				}
			}

			redirect($this->controller_path . 'dashboard/'. (int)$success);
		}


		//<Category Methods>
		//display category list
		public function showAllCategory($proc_result = NULL)
		{
			if (isset($this->session->user_session_key))
			{
				$data["render_body"] = 'admin/category_list';
				$data['active_page'] = 'ls-category';
				$data['proc_result'] = $proc_result;

				$this->db->select('appid, title, datecreated, description');
				$data['categories'] = $this->db->get('video_category')->result_array();

				$this->load->view('shared/admin_masterview', $data);
				return;
			}
			
			redirect($this->controller_path . 'logout');
		}
		
		//[get]display create category
		public function showCreateCategory($proc_result = NULL)
		{
			if (isset($this->session->user_session_key))
			{
				$data["render_body"] = 'admin/create_category';
				$data['active_page'] = 'new-category';
				$data['proc_result'] = $proc_result;

				$this->load->view('shared/admin_masterview', $data);
				return;
			}
			
			redirect($this->controller_path . 'logout');
		}
		
		//[post]process category createp
		public function processCreateCategory()
		{
			if (isset($this->session->user_session_key))
			{
				$success = FALSE;
				//validate form items
				$this->form_validation->set_rules('txtCategoryTitle', 'Category title', 'required|min_length[3]|max_length[100]');
				if ($this->form_validation->run())
				{
					$title = $this->input->post('txtCategoryTitle');
					$description = $this->input->post('txtDescription');

					$this->db->insert('video_category', array(
						'appid' => generateID(20),
						'title' => $title,
						'description' => $description,
						'datecreated' => date('Y-m-d H:i:s')
					));

					if ($this->db->affected_rows() > 0)
						$success = TRUE;
				}

				redirect($this->controller_path . 'new-category/' . $success);
				return;
			}
			
			redirect($this->controller_path . 'logout');
		}
		
		//display edit category
		public function showEditCategory($category_id)
		{
			if (isset($this->session->user_session_key))
			{
				$category_row = NULL;
				if (isset($category_id))
				{
					$query = $this->db->get_where('video_category', array('appid' => $category_id));
					if ($query->num_rows() > 0)
					{
						$category_row = $query->row_array();

						$data["render_body"] = 'admin/edit_category_view';
						$data['active_page'] = 'ls-category';
						$data['category'] = $category_row;

						$this->load->view('shared/admin_masterview', $data);
						return;
					}
				}
				else
				{
					redirect($this->controller_path . 'ls-category');
					return;
				}
			}
			
			redirect($this->controller_path . 'logout');
		}
		
		//process edit category
		public function processEditCategory()
		{
			if (isset($this->session->user_session_key))
			{
				$success = FALSE;
				//validate form items
				$this->form_validation->set_rules('categoryId', 'Hmmmm!', 'required|min_length[20]');
				$this->form_validation->set_rules('txtCategoryTitle', 'Category title', 'required|min_length[3]|max_length[100]');
				if ($this->form_validation->run())
				{
					$title = $this->input->post('txtCategoryTitle');
					$description = $this->input->post('txtDescription');
					$category_id = $this->input->post('categoryId');

					$this->db->where('appid', $category_id);
					$this->db->update('video_category', array(
						'title' => $title,
						'description' => $description
					));

					$success = TRUE;
				}

				redirect($this->controller_path . 'ls-category/' . $success);
				return;
			}
			
			redirect($this->controller_path . 'logout');
		}

		//delete categoroy action
		public function processDeleteCategory()
		{
			if (isset($this->session->user_session_key))
			{
				$catid = $this->input->post('txthcategoryId');
				if (strlen($catid) >= 20)
				{
					//check if no video has this category
					$query = $this->db->get_where('video_catalog', array(
						'category' => $catid
					));

					if ($query->num_rows() == 0)
						$this->db->delete('video_category', array(
							'appid' => $catid
						));
				}

				redirect($this->controller_path . 'ls-category');
				return;
			}

			redirect($this->controller_path . 'logout');
		}


		//<Video methods>
		//display category list
		public function showAllVideo($proc_result = NULL)
		{
			if (isset($this->session->user_session_key))
			{
				$data["render_body"] = 'admin/video_list';
				$data['active_page'] = 'ls-videos';

				$data['videos'] = $this->db->get('video_catalog')->result_array();
				$data['proc_result'] = $proc_result;

				$this->load->view('shared/admin_masterview', $data);
				return;
			}

			redirect($this->controller_path . 'logout');
		}

		//[get]display video upload controls
		//@param proc_result: indicates the result of processing. is null when first shown
		public function showVideoUploader($proc_result = NULL)
		{
			if (isset($this->session->user_session_key))
			{
				$data["render_body"] = 'admin/video_uploader_view';
				$data['proc_result'] = $proc_result;
				$data['categories'] = NULL;
				$data['active_page'] = 'video-upload';

				$query = $this->db->get('video_category');
				$data['categories'] = $query->result_array();

				$this->load->view('shared/admin_masterview', $data);
				return;
			}

			redirect($this->controller_path . 'logout');
		}

		//[get]display edit video controls
		//@param proc_result: indicates the result of processing. is null when first shown
		public function showEditVideoUploader($video_id)
		{
			if (isset($this->session->user_session_key))
			{
				if (isset($video_id))
				{
					$data["render_body"] = 'admin/edit_video_uploader_view';
					$data['active_page'] = 'ls-videos';

					$query = $this->db->get_where('video_catalog', array(
						'appid' => $video_id
					));

					if ($query->num_rows() > 0)
					{
						$video = $query->row_array();
						$data['video'] = $video;
						$data['categories'] = $this->db->get('video_category')->result_array();

						if (strlen($video['cover_image']) > 2)
							$data['banner'] = base_url() . "media_source/video_cover/{$video['cover_image']}";
						
						$this->load->view('shared/admin_masterview', $data);
					}
					else
						redirect($controller_path . 'ls-videos');				
				}
				else
					redirect($controller_path . 'ls-videos');

				return;
			}

			redirect($this->controller_path . 'logout');
		}
		
		//[post]process video upload
		public function processUploadVideo()
		{
			if (isset($this->session->user_session_key))
			{
				$upload_info = array();
				$upload_info['success'] = FALSE;

				$this->form_validation->set_rules('txtVideoTitle', 'Title', 'required|min_length[5]|max_length[100]');
				$this->form_validation->set_rules('cbCategory', 'Category', 'required|min_length[20]');

				if (strlen(trim($this->input->post('chkSaveAsAdsVideo'))) > 0)
					$this->form_validation->set_rules('txtProductPrice', 'Product Price', 'required|decimal');


				if ($this->form_validation->run() && ! empty($_FILES['fileVideoSourceFile']['tmp_name']))
				{
					//validate entry
					$title = trim($this->input->post('txtVideoTitle'));
					$description = trim($this->input->post('txtDescription'));
					$category_id = trim($this->input->post('cbCategory'));
					$product_price = trim($this->input->post('txtProductPrice'));

					$keywords = trim($this->input->post('txtVideoKeywords'));
					$actors = trim($this->input->post('txtVideoActors'));
					$directors = trim($this->input->post('txtVideoDirectors'));
					$creators = trim($this->input->post('txtVideoCreators'));

					$newfileappid = generateID(10, TRUE, FALSE, '', '', TRUE);
					$file_new_name = $newfileappid . '.'. pathinfo($_FILES['fileVideoSourceFile']['name'], PATHINFO_EXTENSION);

					$this->upload->initialize(array(
						'upload_path' => $this->config->item('media_source_path'),
						'allowed_types' => 'mp4|m4a|m4v|mov|flv|webm|ogv|ogg',
						'overwrite' => TRUE,
						'max_size' => '0',
						'file_name' => $file_new_name
					));

					$upload_info['success'] = $this->upload->do_upload('fileVideoSourceFile');

					if ($upload_info['success'])
					{
						$file_current_name = $this->upload->data('file_name');
						$file_extension = $this->upload->data('file_ext');

						//add record
						$video_appid = generateID(50);
						$this->db->insert('video_catalog', array(
							'appid' => $video_appid,
							'title' => $title,
							'description' => $description,
							'date_created' => date('Y-m-d H:i:s'),
							'video_format' => $file_extension,
							'category' => $category_id,
							'enc_status' => 'NotSentForEncoding',
							'media_source' => $this->config->item('ftp_get_media_source_path') . $file_new_name,
							'ads_video' => (int)(strlen(trim($this->input->post('chkSaveAsAdsVideo'))) > 0),
							'keywords' => $keywords,
							'actors' => $actors,
							'directors' => $directors,
							'creators' => $creators
						));

						if ($this->db->affected_rows() > 0)
						{
							//save video cover image if provided
							if (! empty($_FILES['fileVideoCoverImageFile']['tmp_name']))
							{
								$cover_image_name = $newfileappid . '.'. pathinfo($_FILES['fileVideoCoverImageFile']['name'], PATHINFO_EXTENSION);
								$this->upload->initialize(array(
									'upload_path' => $this->config->item('media_source_path') . 'video_cover/',
									'allowed_types' => 'png|jpg|bmp|gif|jpeg',
									'overwrite' => TRUE,
									'max_size' => '0',
									'file_name' => $cover_image_name
								));

								if ($this->upload->do_upload('fileVideoCoverImageFile'))
								{
									//update db
									$this->db->where('appid', $video_appid);
									$this->db->update('video_catalog', array(
										'cover_image'=> $cover_image_name
									));
								}
							}

							//add product record
							if (strlen(trim($this->input->post('chkSaveAsAdsVideo'))) > 0)
							{
								$this->db->insert('products', array(
									'appid' => generateID(20),
									'product_name' => $title,
									'description' => $description,
									'product_number' => generateID(10, FALSE, FALSE, '', '', TRUE),
									'date_created' => date('Y-m-d'),
									'current_price' => $product_price,
									'video_appid' => $video_appid,
									'is_video_ad' => 1
								));
							}

							if ($this->input->post('chkStartEncoding') != '')
							{
								//run encoding
								try
								{
									$this->load->library('Vidly_encoding_manager');
									$request = new AddMediaRequest(
										'12664', 'd66e8c72715fd0a7ba15672075bd9f39', 
										$file_new_name, $title, $description 
									);

									$result =  $this->vidly_encoding_manager->addMedia($request);

									if ($result != NULL && $result['success'] == TRUE)
									{
										//update records
										$this->db->where('appid', $video_appid);
										$this->db->update('video_catalog', array(
											'enc_media_id' => $result['successinfo']['media_id'],
											'vidly_url' => $result['successinfo']['short_link'],
											'embedjs' => $result['successinfo']['email_embed'],
											'enc_status' => 'Pending',
											'date_uploaded' => date('Y-m-d H:i:s')
										));

										$upload_info['encoderequest_success'] = TRUE;
									}
								}
								catch(Exception $ex)
								{
									//exception thrown
									$upload_info['encoderequest_success'] = FALSE;
								}
							}
						}
					}
				}
			
				redirect($this->controller_path . 'video-upload/' . $upload_info['success']);
				return;
			}

			redirect($this->controller_path . 'logout');
		}


		//[post]process video upload
		public function processEditVideo()
		{
			if (isset($this->session->user_session_key))
			{
				$upload_info = array();
				$upload_info['success'] = FALSE;

				$this->form_validation->set_rules('txtVideoTitle', 'Title', 'required|min_length[5]|max_length[100]');
				$this->form_validation->set_rules('cbCategory', 'Category', 'required|min_length[20]');
				$this->form_validation->set_rules('video_appid', 'Video ID', 'required|min_length[50]|max_length[50]');

				if (strlen(trim($this->input->post('chkSaveAsAdsVideo'))) > 0)
					$this->form_validation->set_rules('txtProductPrice', 'Product Price', 'required|numeric');

				if ($this->form_validation->run())
				{
					//validate entry
					$title = trim($this->input->post('txtVideoTitle'));
					$description = trim($this->input->post('txtDescription'));
					$category_id = trim($this->input->post('cbCategory'));
					$video_appid = $this->input->post('video_appid');
					$product_price = trim($this->input->post('txtProductPrice'));

					$keywords = trim($this->input->post('txtVideoKeywords'));
					$actors = trim($this->input->post('txtVideoActors'));
					$directors = trim($this->input->post('txtVideoDirectors'));
					$creators = trim($this->input->post('txtVideoCreators'));
					
					if (!empty($_FILES['fileVideoSourceFile']['tmp_name']))
					{
						$video_instance = $this->db->get_where('video_catalog', array('appid' => $video_appid))->row_array();
						$old_name = substr($video_instance['media_source'], strrpos($video_instance['media_source'], '/') + 1);

						//delete old file
						try
						{
							$old_path = $this->config->item('media_source_path') . $old_name;
							if (file_exists($old_path))
							{
								@unlink($old_path);
							}
						}
						catch(Exception $ex)
						{
							//do nothing
						}

						$file_new_name = generateID(10, TRUE, FALSE, '', '', TRUE) . '.'. pathinfo($_FILES['fileVideoSourceFile']['name'], PATHINFO_EXTENSION);

						$this->upload->initialize(array(
							'upload_path' => $this->config->item('media_source_path'),
							'allowed_types' => 'mp4|m4a|m4v|mov|flv|webm|ogv|ogg',
							'overwrite'=>TRUE,
							'max_size' => '0',
							'file_name' => $file_new_name
						));

						$upload_info['success'] = $this->upload->do_upload('fileVideoSourceFile');
					
						if ($upload_info['success'])
						{
							$file_current_name = $this->upload->data('file_name');
							$file_extension = $this->upload->data('file_ext');

							//add record
							$this->db->where('appid', $video_appid);
							$this->db->update('video_catalog', array(
								'title' => $title,
								'description' => $description,
								'date_created' => date('Y-m-d H:i:s'),
								'video_format' => $file_extension,
								'category' => $category_id,
								'enc_status' => 'NotSentForEncoding',
								'media_source' => $this->config->item('ftp_get_media_source_path') . $file_new_name,
								'ads_video' => (int)(strlen(trim($this->input->post('chkSaveAsAdsVideo'))) > 0),
								'keywords' => $keywords,
								'actors' => $actors,
								'directors' => $directors,
								'creators' => $creators
							));

							if ($this->db->affected_rows() > 0)
							{
								//add product record
								if ( strlen(trim($this->input->post('chkSaveAsAdsVideo'))) > 0 )
								{
									if ($this->db->get_where('products', array('video_appid'=>$video_appid))->num_rows() == 0)
									{
										$this->db->insert('products', array(
											'appid' => generateID(20),
											'product_name' => $title,
											'description' => $description,
											'product_number' => generateID(10, FALSE, FALSE, '', '', TRUE),
											'date_created' => date('Y-m-d'),
											'current_price' => $product_price,
											'video_appid' => $video_appid,
											'is_video_ad' => 1
										));
									}
								}
								else
								{
									//remove product added to this for advert
									$this->db->where('video_appid', $video_appid);
									$this->db->update('products', array('video_appid'=>NULL, 'is_video_ad'=>0));
								}

								if ($this->input->post('chkStartEncoding') != '')
								{
									//run encoding
									try
									{
										//get media shortlink
										$slquery = $this->db->get_where('video_catalog', array('appid'=>$video_appid));

										if ($slquery->num_rows() > 0)
										{
											$video_record = $slquery->row_array(0);
											$this->load->library('Vidly_encoding_manager');

											$request = new UpdateMediaRequest(
												'12664', 'd66e8c72715fd0a7ba15672075bd9f39', 
												$video_record['vidly_url'], $file_new_name, $title, $description 
											);

											$result =  $this->vidly_encoding_manager->addMedia($request);

											if ($result != NULL && $result['success'] == TRUE)
											{
												//update records
												$this->db->where('appid', $video_appid);
												$this->db->update('video_catalog', array(
													'enc_status' => 'Pending',
													'date_uploaded' => date('Y-m-d H:i:s'),
												));

												$upload_info['encoderequest_success'] = TRUE;
											}
										}
									}
									catch(Exception $ex)
									{
										//exception thrown
										$upload_info['encoderequest_success'] = FALSE;
									}
								}
							}
						}
					}
					else
					{
						//just update base data
						$this->db->where('appid', $video_appid);
						$this->db->update('video_catalog', array(
							'title' => $title,
							'description' => $description,
							'category' => $category_id,
							'ads_video' => (int)(strlen(trim($this->input->post('chkSaveAsAdsVideo'))) > 0),
							'keywords' => $keywords,
							'actors' => $actors,
							'directors' => $directors,
							'creators' => $creators
						));
					}

					//save video cover image if provided
					if (! empty($_FILES['fileVideoCoverImageFile']['tmp_name']))
					{
						//get old image and delete
						$vquery = $this->db->get_where('video_catalog', array('appid'=>$video_appid));
						if ($vquery->num_rows() > 0)
						{
							$cover_image_old_name = $vquery->row_array(0)['cover_image'];
							if ( empty(trim($cover_image_old_name)) )
								$cover_image_old_name = generateID(10, TRUE, FALSE, '', '', TRUE) . '.png';

							$cover_image_path = $this->config->item('media_source_path') . 'video_cover/' . $cover_image_old_name;
							if (file_exists($cover_image_path))
								@unlink($cover_image_path);

							$cover_image_old_name = substr($cover_image_old_name, 0, strrpos($cover_image_old_name, '.'));

							$cover_image_name = $cover_image_old_name . '.'. pathinfo($_FILES['fileVideoCoverImageFile']['name'], PATHINFO_EXTENSION);
							$this->upload->initialize(array(
								'upload_path' => $this->config->item('media_source_path') . 'video_cover/',
								'allowed_types' => 'png|jpg|bmp|gif|jpeg',
								'overwrite' => TRUE,
								'max_size' => '0',
								'file_name' => $cover_image_name
							));
							
							if ($this->upload->do_upload('fileVideoCoverImageFile'))
							{
								//update db
								$this->db->where('appid', $video_appid);
								$this->db->update('video_catalog', array(
									'cover_image'=> $cover_image_name
								));
							}
						}
					}

					//add product record
					if ( strlen(trim($this->input->post('chkSaveAsAdsVideo'))) > 0 )
					{
						if ($this->db->get_where('products', array('video_appid'=>$video_appid))->num_rows() == 0)
						{
							$this->db->insert('products', array(
								'appid' => generateID(20),
								'product_name' => $title,
								'description' => $description,
								'product_number' => generateID(10, FALSE, FALSE, '', '', TRUE),
								'date_created' => date('Y-m-d'),
								'current_price' => $product_price,
								'video_appid' => $video_appid,
								'is_video_ad' => 1
							));
						}
						else
						{
							$this->db->where('video_appid', $video_appid);
							$this->db->update('products', array(
								'product_name' => $title,
								'description' => $description,
								'date_created' => date('Y-m-d'),
								'current_price' => $product_price,
								'video_appid' => $video_appid,
								'is_video_ad' => 1
							));
						}
					}
					else
					{
						//remove product added to this for advert
						$this->db->delete('products', array('video_appid'=>$video_appid, 'is_video_ad'=>1));
					}

					$upload_info['success'] = TRUE;
				}

				redirect($this->controller_path . 'ls-videos/' . (int)$upload_info['success']);
				return;
			}

			redirect($this->controller_path . 'logout');
		}


		//[GET]
		//called to request video encoding
		public function processEncodeVideoRequest($video_appid)
		{
			if (isset($this->session->user_session_key))
			{
				$upload_info = array();
				$upload_info['encoderequest_success'] = FALSE;

				if (isset($video_appid))
				{
					$query = $this->db->get_where('video_catalog', array('appid'=>$video_appid));
					if ($query->num_rows() > 0)
					{
						//run encoding
						try
						{
							$row = $query->row_array();
							$file_name = substr($row['media_source'], strrpos($row['media_source'], '/') + 1);
							
							$this->load->library('Vidly_encoding_manager');
							$request = new AddMediaRequest(
								$this->vidly_userid, $this->vidly_userkey, 
								$file_name, $row['title'], $row['description'] 
							);

							$result =  $this->vidly_encoding_manager->addMedia($request);

							if ($result != NULL && $result['success'] == TRUE)
							{
								//update records
								$this->db->where('appid', $video_appid);
								$this->db->update('video_catalog', array(
									'enc_media_id' => $result['successinfo']['media_id'],
									'vidly_url' => $result['successinfo']['short_link'],
									'embedjs' => $result['successinfo']['responsive_embed'],
									'enc_status' => 'Pending',
									'date_uploaded' => date('Y-m-d H:i:s'),
								));

								$upload_info['encoderequest_success'] = TRUE;
							}
						}
						catch(Exception $ex)
						{
							//exception thrown
						}
					}
				}

				redirect($this->controller_path . 'ls-videos/' . (int)$upload_info['encoderequest_success']);
				return;
			}

			redirect($this->controller_path . 'logout');
		}

		//display product list
		//@param proc_result: indicates the result of processing. is null when first shown
		public function showProductList($proc_result = NULL)
		{
			if (isset($this->session->user_session_key))
			{
				$data["render_body"] = 'admin/products_list_view';
				$data['proc_result'] = $proc_result;
				$data['products'] = NULL;
				$data['active_page'] = 'ls-products';

				$query = $this->db->get('products');
				$data['products'] = $query->result_array();

				$this->load->view('shared/admin_masterview', $data);
				return;
			}

			redirect($this->controller_path . 'logout');
		}

		//display product creation form
		//@param proc_result: indicates the result of processing. is null when first shown
		public function showCreateProduct($proc_result = NULL)
		{
			if (isset($this->session->user_session_key))
			{
				$data["render_body"] = 'admin/create_product';
				$data['proc_result'] = $proc_result;
				$data['products'] = NULL;
				$data['active_page'] = 'new-product';

				$this->load->view('shared/admin_masterview', $data);
				return;
			}

			redirect($this->controller_path . 'logout');
		}

		//[post]process product upload
		public function processNewProduct()
		{
			if (isset($this->session->user_session_key))
			{
				$upload_info = array();
				$upload_info['success'] = FALSE;

				$this->form_validation->set_rules('txtProductName', 'Product Name', 'required|min_length[5]|max_length[100]');
				$this->form_validation->set_rules('txtProductPrice', 'Product Price', 'required');

				$prod_price = trim($this->input->post('txtProductPrice'));

				if ($this->form_validation->run() && ! empty($_FILES['fileProductImage']['tmp_name']) && is_numeric($prod_price))
				{
					//validate entry
					$prod_name = trim($this->input->post('txtProductName'));
					$description = trim($this->input->post('txtDescription'));
					
					$prod_number = generateID(10, TRUE, FALSE, '', '', TRUE);

					$file_new_name = $prod_number . '.'. pathinfo($_FILES['fileProductImage']['name'], PATHINFO_EXTENSION);

					$this->upload->initialize(array(
						'upload_path' => $this->config->item('ads_products_banner_path'),
						'allowed_types' => 'png|jpg|bmp|gif',
						'overwrite' => TRUE,
						'max_size' => '0',
						'file_name' => $file_new_name
					));

					$upload_info['success'] = $this->upload->do_upload('fileProductImage');

					if ($upload_info['success'])
					{
						//add record
						$this->db->insert('products', array(
							'appid' => generateID(20),
							'product_name' => $prod_name,
							'description' => $description,
							'product_number' => $prod_number,
							'date_created' => date('Y-m-d'),
							'current_price' => $prod_price,
							'image_name' => $file_new_name
						));

						//resize the image
						$this->load->library('image_lib', array(
							'image_library' => 'gd2',
							'source_image' => $this->config->item('ads_products_banner_path') . $file_new_name,
							'maintain_ratio' => TRUE,
							'width' => 640,
							'height' => 360
						));

						$this->image_lib->resize();
					}
				}

				redirect($this->controller_path . 'new-product/' . $upload_info['success']);
				return;
			}

			redirect($this->controller_path . 'logout');
		}

		//display edit product
		public function showEditProduct($product_id)
		{
			if (isset($this->session->user_session_key))
			{
				$product_row = NULL;
				if (isset($product_id))
				{
					$this->db->reconnect();
					$query = $this->db->get_where('products', array('appid' => $product_id));
					if ($query->num_rows() > 0)
					{
						$product_row = $query->row_array();

						$data["render_body"] = 'admin/edit_product_view';
						$data['active_page'] = 'ls-products';
						$data['product'] = $product_row;
						$data['banner'] = base_url() . "products/{$product_row['image_name']}";

						if ( ! empty($product_row['is_video_ad']))
							//get video url
							$data['product_video'] = $this->db->get_where('video_catalog', array('appid'=>$product_row['video_appid']))->row_array(0);
						

						$this->load->view('shared/admin_masterview', $data);
					}
				}
				else
					redirect($this->controller_path . 'ls-products');

				return;
			}
			
			redirect($this->controller_path . 'logout');
		}


		//process edit category
		public function processEditProduct()
		{
			if (isset($this->session->user_session_key))
			{
				$success = FALSE;
				//validate form items
				$this->form_validation->set_rules('product_id', 'Hmmmm!', 'required|min_length[20]');
				$this->form_validation->set_rules('txtProductName', 'Product Name', 'required|min_length[3]|max_length[100]');
				$this->form_validation->set_rules('txtProductPrice', 'Product Price', 'required');

				if ($this->form_validation->run())
				{
					$prod_name = $this->input->post('txtProductName');
					$description = $this->input->post('txtDescription');
					$prod_id = $this->input->post('product_id');
					$prod_price = $this->input->post('txtProductPrice');

					if (is_numeric($prod_price))
					{
						if ( ! empty($_FILES['fileProductImage']['tmp_name']) )
						{
							$image_name_query = $this->db->get_where('products', array('appid' => $prod_id));
							$result = $image_name_query->row_array();
							$prod_num = $result['product_number'];
							$image_old_name = $result['image_name'];

							//validate entry
							$prod_name = trim($this->input->post('txtProductName'));
							$description = trim($this->input->post('txtDescription'));
							
							$file_new_name = $prod_num . '.'. pathinfo($_FILES['fileProductImage']['name'], PATHINFO_EXTENSION);
			
							//delete old image
							try
							{
								if (isset($image_old_name) && file_exists($this->config->item('ads_products_banner_path') . $image_old_name))
								{
									@unlink($this->config->item('ads_products_banner_path') . $image_old_name);
								}
							}
							catch(Exception $ex)
							{
								//do nothing
							}

							$this->upload->initialize(array(
								'upload_path' => $this->config->item('ads_products_banner_path'),
								'allowed_types' => 'jpg|png|gif|bmp',
								'overwrite'=>TRUE,
								'max_size' => '0',
								'file_name' => $file_new_name
							));
			
							$upload_info['success'] = $this->upload->do_upload('fileProductImage');
			
							if ($upload_info['success'])
							{
								$this->db->where('appid', $prod_id);
								$this->db->update('products', array(
									'product_name' => $prod_name,
									'description' => $description,
									'current_price' => $prod_price,
									'image_name' => $file_new_name
								));
			
								//resize the image
								$this->load->library('image_lib', array(
									'image_library' => 'gd2',
									'source_image' => $this->config->item('ads_products_banner_path') . $file_new_name,
									'maintain_ratio' => TRUE,
									'width' => 640,
									'height' => 360
								));
			
								$this->image_lib->resize();
							}
						}
						else
						{
							$this->db->where('appid', $prod_id);
							$this->db->update('products', array(
								'product_name' => $prod_name,
								'description' => $description,
								'current_price' => $prod_price
							));
						}

						$success = TRUE;
					}
				}

				redirect($this->controller_path . 'ls-products/' . $success);
				return;
			}
			
			redirect($this->controller_path . 'logout');
		}

		//called to delete uploaded video
		public function processDeleteVideo()
		{
			if (isset($this->session->user_session_key))
			{
				$video_appid = $this->input->post('txthvideoId');
				if (isset($video_appid))
				{
					$query = $this->db->get_where('video_catalog', array('appid' => $video_appid));
					if ($query->num_rows() > 0)
					{
						$row = $query->row_array();
						$file_name = substr($row['media_source'], strrpos($row['media_source'], '/') + 1);
						$video_path = $this->config->item('media_source_path') . $file_name;
						if (file_exists($video_path))
							@unlink($video_path);

						//delete video from encoding storage
						if ($row['encoded'] == TRUE)
						{
							$this->load->library('Vidly_encoding_manager');
							$enc_result = $this->Vidly_encoding_manager->deleteMedia(new DeleteMediaRequest(
												$this->vidly_userid, $this->vidly_userkey, $row['vidly_url']
											));

							if ($enc_result['success'] === TRUE)
							{
								//delete from db
								$this->db->where('appid', $video_appid);
								$this->db->delete('video_catalog');
							}
						}
						else
						{
							//delete from db
							$this->db->where('appid', $video_appid);
							$this->db->delete('video_catalog');
						}
					}
				}

				redirect($this->controller_path . 'ls-videos');
				return;
			}

			redirect($this->controller_path . 'logout');
		}

		//delete product action
		public function processDeleteProduct()
		{
			if (isset($this->session->user_session_key))
			{
				//check session alive
				$prod_id = $this->input->post('txthproductId');

				if (strlen($prod_id) >= 20)
				{
					//get product details
					$query = $this->db->get_where('products', array(
						'appid' => $prod_id
					));

					if ($query->num_rows() > 0)
					{
						$row = $query->row_array();
						$image_path = $this->config->item('ads_products_banner_path') . $row['image_name'];
						@unlink($image_path);
						
						$this->db->delete('products', array(
							'appid' => $prod_id
						));
					}
				}

				redirect($this->controller_path . 'ls-products');
				return;
			}

			redirect($this->controller_path . 'logout');
		}

		//display product order requests
		//@param proc_result: indicates the result of processing. is null when first shown
		public function showAllProductOrders($proc_result = NULL)
		{
			if (isset($this->session->user_session_key))
			{
				$data["render_body"] = 'admin/product_order';
				$data['proc_result'] = $proc_result;
				$query = $this->db->query('SELECT product_order.id, phone_number, product_appid, order_date, price_tag,
											responded,date_responded, resp_personel_appid,
											product_name, current_price 
											FROM product_order LEFT JOIN products ON product_order.product_appid=products.appid 
											WHERE responded = 0');

				$data['product_orders'] = $query->result_array();
				$data['active_page'] = 'product-orders';

				$this->load->view('shared/admin_masterview', $data);
				return;
			}

			redirect($this->controller_path . 'logout');
		}

		//process response to product order
		public function procRespondProductOrder($id)
		{
			if (isset($this->session->user_session_key))
			{
				$success = FALSE;
				if (isset($id))
				{
					$this->db->where('id', $id);
					$this->db->update('product_order', array(
						'responded' => 1,
						'date_responded' => date('Y-m-d H:i:s'),
						'resp_personel_appid' => ''
					));

					if ($this->db->affected_rows() > 0)
						$success = TRUE;
				}

				redirect($this->controller_path . 'product-orders/' . (int)$success);
				return;
			}

			redirect($this->controller_path . 'logout');
		}

		//process delete product order
		public function procDeleteProductOrder()
		{
			if (isset($this->session->user_session_key))
			{
				$success = FALSE;
				$order_id = trim($this->input->post('txthproductorderId'));
				if (isset($order_id))
				{
					$this->db->delete('product_order', array('id'=>$order_id));
					if ($this->db->affected_rows() > 0)
						$success = TRUE;
				}

				redirect($this->controller_path . 'product-orders/' . (int)$success);
				return;
			}

			redirect($this->controller_path . 'logout');
		}


		//show subscribers for membership
		public function showMembershipSubscribers($membershipPlanKey = NULL)
		{
			if (empty($membershipPlanKey))
			{
				//show all
			}
			else
			{
				//show for the membership key requested
			}
		}

		//show list of membership plans
		public function showMembershipPlans($proc_result = NULL)
		{
			$sql = "SELECT membership_plans.*, Count(sub_appid) AS plan_subscribers FROM membership_plans LEFT JOIN subscribers ON mp_appid=sub_plan";
			$data["render_body"] = 'admin/sub_plans_list_view';
			$data['proc_result'] = $proc_result;
			$data['active_page'] = 'ls-subscription-plans';
			$data['subscription_plans'] = $this->db->query($sql)->result_array();

			$this->load->view('shared/admin_masterview', $data);
		}

		//show edit view for membership plans
		public function showEditMembershipPlan($membershipPlanKey = NULL)
		{
			if (isset($membershipPlanKey))
			{
				$query = $this->db->get_where('membership_plans', array('mp_appid'=>$membershipPlanKey));

				if ($query->num_rows() > 0)
				{
					$data["render_body"] = 'admin/edit_sub_plan_view';
					$data['active_page'] = 'ls-subscription-plans';
					$data['sub_plan'] = $query->row_array();
		
					$this->load->view('shared/admin_masterview', $data);
				}
			}
		}

		//show create membership plan view
		public function showCreateMembershipPlan($proc_result = NULL)
		{
			$data["render_body"] = 'admin/new_membership_plan_view';
			$data['proc_result'] = $proc_result;
			$data['active_page'] = 'new-subscription-plan';

			$this->load->view('shared/admin_masterview', $data);
		}

		//process edit membership plan
		public function procEditMembershipPlan()
		{
			$mp_appid = trim($this->input->post('subplanKey'));
			$mp_title = trim($this->input->post('txtMembershipPlanTitle'));
			$mp_price = trim($this->input->post('txtMembershipPlanPrice'));
			$mp_validity_period = trim($this->input->post('txtMembershipPlanValidityPeriod'));
			$mp_validity_freq = trim($this->input->post('txtMembershipPlanValidityFreq'));
			$mp_description = trim($this->input->post('txtDescription'));

			$mp_enable_adverts  = ! empty($this->input->post('chkPrivEnableAdverts'));
			$mp_enable_live_cam = ! empty($this->input->post('chkPrivEnableLiveCam'));


			if (!empty($mp_appid) && !empty($mp_title) && !empty($mp_price) && !empty($mp_validity_period) && strcmp($mp_validity_freq, '0') != 0)
			{
				//check that another plan does not have this name
				$mp_title_uppercase = strtoupper($mp_title);
				$result = $this->db->query("SELECT * FROM membership_plans WHERE UPPER(mp_title)='{$mp_title_uppercase}' AND mp_appid<>'{$mp_appid}'");

				if ($result->num_rows() == 0)
				{
					$this->db->where('mp_appid', $mp_appid);
					$this->db->update('membership_plans', array(
						'mp_title'=>$mp_title,
						'mp_price'=>$mp_price,
						'mp_valid_period'=>$mp_validity_period,
						'mp_valid_freq'=>$mp_validity_freq,
						'mp_description'=>$mp_description,
						'mp_privileges'=> json_encode(array('adverts'=>$mp_enable_adverts, 'live_cam'=>$mp_enable_live_cam)),
						'date_modified'=> date('Y-m-d')
					));

					if ($this->db->affected_rows() > 0)
						redirect($this->controller_path . 'ls-subscription-plan/' . (int)true);
				}
			}

			redirect($this->controller_path . 'ls-subscription-plan/' . (int)false);
		}

		//process create membership plan
		public function procCreateMembershipPlan()
		{
			$mp_title = trim($this->input->post('txtMembershipPlanTitle'));
			$mp_price = trim($this->input->post('txtMembershipPlanPrice'));
			$mp_validity_period = trim($this->input->post('txtMembershipPlanValidityPeriod'));
			$mp_validity_freq = trim($this->input->post('txtMembershipPlanValidityFreq'));
			$mp_description = trim($this->input->post('txtDescription'));

			$mp_enable_adverts  = ! empty($this->input->post('chkPrivEnableAdverts'));
			$mp_enable_live_cam = ! empty($this->input->post('chkPrivEnableLiveCam'));

			if (!empty($mp_title) && !empty($mp_price) && !empty($mp_validity_period) && strcmp($mp_validity_freq, '0') != 0)
			{
				//check that another plan does not have this name
				$mp_title_uppercase = strtoupper($mp_title);
				$result = $this->db->query("SELECT * FROM membership_plans WHERE UPPER(mp_title)='{$mp_title_uppercase}'");
				if ($result->num_rows() == 0)
				{
					$this->db->insert('membership_plans', array(
						'mp_appid'=>generateID(20),
						'mp_title'=>$mp_title,
						'mp_price'=>$mp_price,
						'mp_valid_period'=>$mp_validity_period,
						'mp_valid_freq'=>$mp_validity_freq,
						'mp_description'=>$mp_description,
						'mp_privileges'=> json_encode(array('adverts'=>$mp_enable_adverts, 'live_cam'=>$mp_enable_live_cam)),
						'date_created'=>date('Y-m-d H:i:s')
					));

					if ($this->db->affected_rows() > 0)
						redirect($this->controller_path . 'ls-subscription-plan/' . (int)true);
				}
			}

			redirect($this->controller_path . 'new-subscription-plan/' . (int)false);
		}

		//process delete subscription plan
		public function procDeleteSubscriptionPlan()
		{
			if (isset($this->session->user_session_key))
			{
				$success = FALSE;
				$subplan_id = trim($this->input->post('txthsubplanId'));
				if (isset($subplan_id))
				{
					//check that no one is subscribed to this
					$query = $this->db->get_where('subscribers', array('sub_plan'=>$subplan_id));
					if ($query->num_rows() == 0)
					{
						$this->db->delete('membership_plans', array('mp_appid'=>$subplan_id));
						if ($this->db->affected_rows() > 0)
							$success = TRUE;
					}
				}

				redirect($this->controller_path . 'ls-subscription-plan/' . (int)$success);
				return;
			}

			redirect($this->controller_path . 'logout');
		}
	}