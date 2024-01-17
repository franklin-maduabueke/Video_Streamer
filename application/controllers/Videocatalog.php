<?php

	class Videocatalog extends CI_Controller
	{
		private $controller_path;

		public function __construct()
		{
			parent::__construct();
			$this->controller_path = base_url() . 'index.php/video/';
		}

		public function index()
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
			$data['homebanner'] = $this->config->item('homebanner');

			$this->load->view('home_view', $data);
		}
		
		public function watch($vid_appid)
		{
			if (isset($this->session->user_session_key))
			{
				$data['video'] = array();
				$data['video_category'] = $this->db->get('video_category')->result_array();

				$data['related_videos'] = array();
				
				//display video player page and play video
				if (isset($vid_appid))
				{
					//count the number of products than random range select
					$count = $this->db->get_where('products', array('is_video_ad'=>1))->num_rows();
					$data['adverts'] = array();
					$start = 0;

					if ($count > 0)
					{
						if ($count > 5)
							$start = rand(0, $count);

						if ($start + 5 > $count);
							$start = 0;
						
						$v_adverts = $this->db->get('products', $start, 5)->result_array();
						shuffle($v_adverts);
						
						//get video for this
						foreach ($v_adverts as $v_ad)
						{
							if ($v_ad['is_video_ad'] == 1)
							{
								$query =$this->db->get_where('video_catalog', array('appid'=>$v_ad['video_appid'], 'encoded'=>1));
								if ($query->num_rows() > 0)
								{
									$vcount = count($data['adverts']);
									$data['adverts'][$vcount] = array('product_details'=>$v_ad, 'product_video'=>$query->row_array());
								}
							}
							else
							{
								//image ad
								$vcount = count($data['adverts']);
								$data['adverts'][$vcount] = array('product_details'=>$v_ad, 'product_video'=>NULL);
							}
						}
					}

					$query = $this->db->get_where('video_catalog', array('appid'=>$vid_appid, 'encoded'=>1));
					if ($query->num_rows() > 0)
					{
						$data['video'] = $query->row_array(0);
						
						//get related videos
						$query = $this->db->query("SELECT *
												FROM video_catalog 
												WHERE encoded=1 AND 
												category='{$data['video']['category']}' AND 
												appid<>'{$data['video']['appid']}'");

						if ($query->num_rows() > 0)
							$data['related_videos'] = $query->result_array();

					}
				}
				
				$footer = $this->load->view('shared/footer', null, TRUE);
				shuffle($data['adverts']);

				$data['footer'] = $footer;

				$this->load->view('alt_video_player_view', $data);

				return;
			}
			
			redirect(site_url() . '/subscriber/logout');
		}

		//search result view
		public function searchResult($category = NULL)
		{
			//display home page for video listing
			$data['videos'] = array();
			$data['video_category'] = array();
			
			$query = $this->db->get('video_category');
			if ($query->num_rows() > 0)
				$data['video_category'] = $query->result_array();

			if ( ! isset($category))
			{
				$query = $this->db->query('SELECT *
										FROM video_catalog 
										WHERE encoded=1 
										ORDER BY title ASC');

				if ($query->num_rows() > 0)
					$data['videos'] = $query->result_array();
			}
			else
			{
				$this->db->order_by('title', 'ASC');
				$query = $this->db->get_where('video_catalog', array(
					'category' => $category
				));

				if ($query->num_rows() > 0)
					$data['videos'] = $query->result_array();
			}

			$footer = $this->load->view('shared/footer', null, TRUE);
			$data['footer'] = $footer;

			$this->load->view('search_result_view', $data);
		}


		//responds to ajax request to search from client
		public function searchQueryResponder()
		{
			$categorys = $this->db->get('video_category')->result_array();

			$search_query = $this->input->post('query');
			$pid = $this->input->post('pid');
			$json_array = array('success' => false, 'results'=>array(), 'count' => 0, 'pid'=>$pid);

			if ( strlen(trim($search_query)) > 0)
			{
				//find videos
				$query = $this->db->query("SELECT appid, title, description, enc_media_id, vidly_url, encoded, date_created, category,
										   ads_video, keywords, cover_image, actors, directors, creators, video_length
										   FROM video_catalog 
										   WHERE encoded=1 AND (title LIKE '%{$search_query}%' 
										   OR keywords LIKE '%{$search_query}%' 
										   OR actors LIKE '%{$search_query}%' 
										   OR directors LIKE '%{$search_query}%' 
										   OR creators LIKE '%{$search_query}%' 
										   OR description LIKE '%{$search_query}%')");

				if ($query->num_rows() > 0)
				{
					$json_array['success'] = TRUE;
					$json_array['results'] = $query->result_array();
					foreach ($json_array['results'] as &$result)
					{
						$result['description'] =  wordwrap(trim($result['description']), 65, '<br/>');
						
						foreach ($categorys as $ct)
						{
							if (strcmp($ct['appid'], $result['category']) == 0)
							{
								$result['categoryname'] = $ct['title'];
								break;
							}
						}
					}

					$json_array['count'] = $query->num_rows();
				}
			}

			echo json_encode($json_array);
		}

		//display product order screen
		public function placeProductOrder($product_num, $proc_result = NULL)
		{
			$data['product'] = array();
			$data['proc_result'] = $proc_result;

			if (isset($product_num))
			{
				$query = $this->db->get_where('products', array('product_number'=>$product_num));
				if ($query->num_rows() > 0)
				{
					$product = $query->row_array(0);
					$data['product'] = $product;
					if ($product['is_video_ad'] == 1)
					{
						$vquery = $this->db->get_where('video_catalog', array('appid'=>$product['video_appid'], 'encoded'=>1));
						if ($vquery->num_rows() > 0)
							$data['product_video'] = $vquery->row_array(0);
						
					}
				}
			}

			$footer = $this->load->view('shared/footer', null, TRUE);
			$data['footer'] = $footer;

			$this->load->view('product_order_view', $data);
		}

		//submit order request
		public function productOrderFormSubmit()
		{
			$success = FALSE;

			$this->form_validation->set_rules('txtProductNumber', 'Product Number', 'required|min_length[10]|max_length[10]');
			$this->form_validation->set_rules('txtPersonFullname', 'Fullname', 'required|min_length[3]');
			$this->form_validation->set_rules('txtPersonPhone', 'Phone Number', 'required|min_length[11]|max_length[11]');
			$this->form_validation->set_rules('txtOrderQuantity', 'Quantity', 'required|integer');

			$product_num = trim($this->input->post('txtProductNumber'));
			$quantity = trim($this->input->post('txtOrderQuantity'));

			$fullname = trim($this->input->post('txtPersonFullname'));
			$phone = trim($this->input->post('txtPersonPhone'));

			if ($this->form_validation->run())
			{
				//find product
				$query = $this->db->get_where('products', array('product_number'=>$product_num));
				if ($query->num_rows() > 0)
				{
					$row = $query->row_array(0);
					$this->db->insert('product_order', array(
						'phone_number' => $phone,
						'product_appid' => $row['appid'],
						'order_date' => date('Y-m-d H:i:s'),
						'price_tag' => $row['current_price'],
						'quantity'=> $quantity
					));

					if ($this->db->affected_rows() > 0)
						$success = TRUE;
				}
			}

			if ($success)
				echo 1;//redirect($this->controller_path . "place-order/{$product_num}/" . (int)$success);
			else
				echo 0;//redirect($this->controller_path . 'place-order/0');
		}
	}