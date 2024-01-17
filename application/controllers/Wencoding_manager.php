<?php

    class Wencoding_manager extends CI_Controller
    {
        //[POST]
        //called by encoding when request was recieved and queued for processing
        public function addMediaEncResponse()
        {
            try
            {
                // Creating new object from response XML
                $xml = $this->input->post('xml');
                $xmlDom = new DOMDocument();
                
                if ($xmlDom->loadXML($xml))
                {
                    // If there are any errors, set error message
                    if($xmlDom->getElementsByTagName('Errors')->length > 0)
                    {
                        $media_source = (string)$xmlDom->getElementsByTagName('SourceFile')->item(0)->textContent;
                        $error_xml = $xmlDom->saveXML($xmlDom->getElementsByTagName('Errors')->item(0));

                        //update record in db
                        $this->db->reconnect();
                        $query = $this->db->get_where('video_catalog', array('media_source' => $media_source));
                        if (isset($query) && $query->num_rows() > 0)
                        {
                            //update info
                            $this->db->reconnect();

                            $this->db->where('media_source', $media_source);
                            $this->db->update('video_catalog', array(
                                'encoding_xml_error' => $error_xml
                            ));
                        }
                    }
                    elseif ($xmlDom->getElementsByTagName('MediaShortLink')->length > 0 && $xmlDom->getElementsByTagName('Status')->length > 0) {
                        // If message received, set OK message
                        $success_response['short_link'] = (string)$xmlDom->getElementsByTagName('MediaShortLink')->item(0)->textContent;
                        $success_response['status'] = (string)$xmlDom->getElementsByTagName('Status')->item(0)->textContent;

                        $successful = TRUE;
                        if (strtolower($success_response['status']) == 'finished')
                        {
                            //update record in db
                            $this->db->reconnect();

                            $this->db->where('vidly_url', $success_response['short_link']);
                            $this->db->update('video_catalog', array(
                                'encoded' => 1,
                                'date_encoded' => date('Y-m-d')
                            ));
                        }
                    }
                }
            }
            catch(Exception $e)
            {
                // If wrong XML response received
                $error = $e->getMessage();
            }
        }

        //[POST]
        //called to update media
        public function updateMediaEncResponse()
        {
            try
            {
                // Creating new object from response XML
                $xml = $this->input->post('xml');
                $xmlDom = new DOMDocument();
                
                if ($xmlDom->loadXML($xml))
                {
                    // If there are any errors, set error message
                    if($xmlDom->getElementsByTagName('Errors')->length > 0)
                    {
                        $media_source = (string)$xmlDom->getElementsByTagName('SourceFile')->item(0)->textContent;
                        $error_xml = $xmlDom->saveXML($xmlDom->getElementsByTagName('Errors')->item(0));

                        //update record in db
                        $this->db->reconnect();
                        $query = $this->db->get_where('video_catalog', array('media_source' => $media_source));
                        if (isset($query) && $query->num_rows() > 0)
                        {
                            //update info
                            $this->db->reconnect();

                            $this->db->where('media_source', $media_source);
                            $this->db->update('video_catalog', array(
                                'encoding_xml_error' => $error_xml
                            ));
                        }
                    }
                    elseif ($xmlDom->getElementsByTagName('MediaShortLink')->length > 0 && $xmlDom->getElementsByTagName('Status')->length > 0) {
                        // If message received, set OK message
                        $success_response['short_link'] = (string)$xmlDom->getElementsByTagName('MediaShortLink')->item(0)->textContent;
                        $success_response['status'] = (string)$xmlDom->getElementsByTagName('Status')->item(0)->textContent;

                        $successful = TRUE;
                        if (strtolower($success_response['status']) == 'finished')
                        {
                            //update record in db
                            $this->db->reconnect();

                            $this->db->where('vidly_url', $success_response['short_link']);
                            $this->db->update('video_catalog', array(
                                'encoded' => 1,
                                'date_encoded' => date('Y-m-d')
                            ));
                        }
                    }
                }
            }
            catch(Exception $e)
            {
                // If wrong XML response received
                $error = $e->getMessage();
            }
        }

        //[POST]
        //called to update media
        public function updateMediaPosterResponse()
        {
            try
            {
                // Creating new object from response XML
                $xml = $this->input->post('xml');
                $xmlDom = new DOMDocument();
                
                if ($xmlDom->loadXML($xml))
                {
                    // If there are any errors, set error message
                    if($xmlDom->getElementsByTagName('Errors')->length > 0)
                    {
                        $media_source = (string)$xmlDom->getElementsByTagName('SourceFile')->item(0)->textContent;
                        $error_xml = $xmlDom->saveXML($xmlDom->getElementsByTagName('Errors')->item(0));

                        //update record in db
                        $this->db->reconnect();
                        $query = $this->db->get_where('video_catalog', array('media_source' => $media_source));
                        if (isset($query) && $query->num_rows() > 0)
                        {
                            //update info
                            $this->db->where('media_source', $media_source);
                            $this->db->update('video_catalog', array(
                                'encoding_xml_error' => $error_xml
                            ));
                        }
                    }
                    elseif ($response->getElementsByTagName('Success')->item(0)->length > 0) {
                        // If message received, set OK message
                        $success_response['message'] = (string)$xmlDom->getElementsByTagName('Message')->item(0)->textContent;
                        $success_response['message_code'] = (string)$xmlDom->getElementsByTagName('MessageCode')->item(0)->textContent;
                        $success_response['media_source'] = (string)$xmlDom->getElementsByTagName('SourceFile')->item(0)->textContent;
                        $success_response['short_link'] = (string)$xmlDom->getElementsByTagName('ShortLink')->item(0)->textContent;
                        $successful = TRUE;
                        
                        //update record in db
                        $this->db->reconnect();

                        $this->db->where('vidly_url', $success_response['short_link']);
                        $this->db->update('video_catalog', array(
                            'poster_modified' => date('Y-m-d')
                        ));
                    }
                }
            }
            catch(Exception $e)
            {
                // If wrong XML response received
                $error = $e->getMessage();
            }
        }

        //[POST]
        //called by encoding when processing successful or failed
        public function deleteMediaEncResponse()
        {
            try
            {
                // Creating new object from response XML
                $xml = $this->input->post('xml');
                $xmlDom = new DOMDocument();
                
                if ($xmlDom->loadXML($xml))
                {
                    // If there are any errors, set error message
                    if($xmlDom->getElementsByTagName('Errors')->length > 0)
                    {
                        $media_source = (string)$xmlDom->getElementsByTagName('SourceFile')->item(0)->textContent;
                        $error_xml = $xmlDom->saveXML($xmlDom->getElementsByTagName('Errors')->item(0));

                        //update record in db
                        $this->db->reconnect();
                        $query = $this->db->get_where('video_catalog', array('media_source' => $media_source));
                        if (isset($query) && $query->num_rows() > 0)
                        {
                            //update info
                            $this->db->where('media_source', $media_source);
                            $this->db->update('video_catalog', array(
                                'encoding_xml_error' => $error_xml
                            ));
                        }
                    }
                    elseif ($xmlDom->getElementsByTagName('Success')->item(0)->length > 0) {
                        // If message received, set OK message
                        $success_response['message'] = (string)$xmlDom->getElementsByTagName('Message')->item(0)->textContent;
                        $success_response['message_code'] = (string)$xmlDom->getElementsByTagName('MessageCode')->item(0)->textContent;
                        $success_response['short_link'] = (string)$xmlDom->getElementsByTagName('ShortLink')->item(0)->textContent;
                        $successful = TRUE;
                        
                        //delete record in db
                        $this->db->reconnect();
                        $this->db->delete('video_catalog', array('vidly_url', $success_response['short_link']));
                    }
                }
            }
            catch(Exception $e)
            {
                // If wrong XML response received
                $error = $e->getMessage();
            }
        }

        //[POST]
        //called by encoding when status of encoding is requsted
        public function getMediaEncStatusResponse()
        {
            try
            {
                // Creating new object from response XML
                $xml = $this->input->post('xml');
                $xmlDom = new DOMDocument();
                
                if ($xmlDom->loadXML($xml))
                {
                    // If there are any errors, set error message
                    if($response->getElementsByTagName('Errors')->length > 0)
                    {
                        $media_source = (string)$xmlDom->getElementsByTagName('SourceFile')->item(0)->textContent;
                        $error_xml = $xmlDom->saveXML($xmlDom->getElementsByTagName('Errors')->item(0));

                        //update record in db
                        $this->db->reconnect();
                        $query = $this->db->get_where('video_catalog', array('media_source' => $media_source));
                        if (isset($query) && $query->num_rows() > 0)
                        {
                            //update info
                            $this->db->where('media_source', $media_source);
                            $this->db->update('video_catalog', array(
                                'encoding_xml_error' => $error_xml
                            ));
                        }
                    }
                    elseif ($xmlDom->getElementsByTagName('MediaShortLink')->length > 0) {
                        // If message received, set OK message
                        $success_response['message'] = (string)$xmlDom->getElementsByTagName('Message')->item(0)->textContent;
                        $success_response['message_code'] = (string)$xmlDom->getElementsByTagName('MessageCode')->item(0)->textContent;
                        $success_response['user_id'] = (string)$xmlDom->getElementsByTagName('UserID')->item(0)->textContent;
                        $success_response['short_link'] = (string)$xmlDom->getElementsByTagName('MediaShortLink')->item(0)->textContent;
                        $success_response['media_status'] = (string)$xmlDom->getElementsByTagName('Status')->item(0)->textContent;
                        $success_response['created'] = (string)$xmlDom->getElementsByTagName('Created')->item(0)->textContent;
                        $success_response['updated'] = (string)$xmlDom->getElementsByTagName('Updated')->item(0)->textContent;

                        $successful = TRUE;
                        
                        //delete record in db
                        $this->db->reconnect();

                        $this->db->where('vidly_url', $success_response['short_link']);
                        $this->db->update('video_catalog', array(
                            'enc_status' => $success_response['media_status']
                        ));
                    }
                }
            }
            catch(Exception $e)
            {
                // If wrong XML response received
                $error = $e->getMessage();
            }
        }
    }