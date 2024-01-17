<?php

    class Membership extends CI_Controller {
        private $contoller_path;

        public function __construct() {
			parent::__construct();
			$this->controller_path = base_url() . 'index.php/membership';
        }
        
        //call to display subscriber account info
        public function showSubscriberAccountDetails($sub_appid)
        {
            if (isset($this->session->user_session_key)) {
                $query = $this->db->get_where('subscriber', array('sub_appid'=>$sub_appid));
                if ($query->num_rows() > 0)
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
                    $data['proc_result'] = $proc_result;
                    $data['redirect_url'] = $redirectToUrl;
                    
                    
                    return;
                }
            }

            redirect(site_url() . '/subscriber/logout');
        }

        //call to display plans view
        public function joinSubscriptionPlan($paytoken) {

        }

        //call to cancel subscription plan
        public function cancelSubscriptionPlan() {

        }
    }