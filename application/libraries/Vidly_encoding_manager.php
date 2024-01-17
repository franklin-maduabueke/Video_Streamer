<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class EncodingRequest {
        public function __construct($_id, $_key, $_action, $_notifyurl = '')
        {
            if ( ! isset($_id, $_key, $_action)) 
                throw new Exception('user_id, userkey, and action must be specified for encoding!');

            $this->user_id = $_id;
            $this->user_key = $_key;
            $this->action = $_action;
            $this->notify_url = $_notifyurl;
        }

        public $user_id, $user_key, $action, $notify_url;
    }

    class EncodingResponse {
        public function __construct($_msg, $_msg_code)
        {
            $this->message = $_msg;
            $this->message_code = $_msg_code;
        }

        public $message, $message_code;
    }
    
    //poco for encoding request data
    class AddMediaRequest extends EncodingRequest {
        private $CI;

        //@param _id: id of encoding account user
        //@param _key: key of encoding account user
        //@param _source_name: the name of the video file from media_source directory
        public function __construct($_id, $_key, $_source_name, $_title, $_description = '', $_gen_hd_files = FALSE, $_viewers_ip = array())
        {
            parent::__construct($_id, $_key, 'AddMedia', base_url() . 'index.php/api/hook/add-media-resp');
            $this->CI = get_instance();

            $this->media_source_name = $_source_name;
            $this->media_title = $_title;
            $this->media_description = $_description;
            $this->gen_for_hd = $_gen_hd_files;
            $this->viewership_iplist = is_array($_viewers_ip) ? $_viewers_ip : array();
        }

        //call to get serialized xml
        public function getXmlString()
        {
            $ftppath = $this->CI->config->item('ftp_get_media_source_path');

            $xml = '<?xml version="1.0"?>' . 
                    "<Query>
                        <Action>{$this->action}</Action>
                        <UserID>{$this->user_id}</UserID>
                        <UserKey>{$this->user_key}</UserKey>
                        <Notify>{$this->notify_url}</Notify>
                        <Source>
                            <SourceFile>{$ftppath}{$this->media_source_name}</SourceFile>
                            <VideoPlayer>
                                <Vendor>vidly</Vendor>
                            </VideoPlayer>
                            <EmbedDomainPrivacy>enabled</EmbedDomainPrivacy>
                            <Title>{$this->media_title}</Title>
                            <Description>{$this->media_description}</Description>
                        </Source>
                    </Query>";

            return $xml;
        }

        public $media_source_name, $media_title, $media_description;
        public $gen_for_hd = FALSE; //should hd format be created
        public $viewership_iplist = array();
    }

    //poco for deleting media
    class UpdateMediaRequest extends EncodingRequest {
        private $CI;

        //@param _id: id of encoding account user
        //@param _key: key of encoding account user
        public function __construct($_id, $_key, $_shortlink, $_sourceurl, $_title, $_description = '')
        {
            parent::__construct($_id, $_key, 'UpdateMedia', base_url() . 'index.php/api/hook/update-media-resp');

            $this->CI = get_instance();
            $this->media_shortlink = $_shortlink;
            $this->media_source_url = $_sourceurl;
            $this->media_title = $_title;
            $this->media_description = $_description;
        }

        //call to get serialized xml
        public function getXmlString()
        {
            $ftppath = $this->CI->config->item('ftp_get_media_source_path');

            $xml = '<?xml version="1.0"?>' . 
                    "<Query>
                        <Action>{$this->action}</Action>
                        <UserID>{$this->user_id}</UserID>
                        <UserKey>{$this->user_key}</UserKey>
                        <Notify>{$this->notify_url}</Notify>
                        <Source>
                            <MediaShortLink>{$this->media_shortlink}</MediaShortLink>
                            <SourceFile>{$ftppath}{$this->media_source_name}</SourceFile>
                            <VideoPlayer>
                                <Vendor>vidly</Vendor>
                            </VideoPlayer>
                            <EmbedDomainPrivacy>enabled</EmbedDomainPrivacy>
                            <Title>{$this->media_title}</Title>
                            <Description>{$this->media_description}</Description>
                        </Source>
                    </Query>";

            return $xml;
        }

        public $action, $notify_url;
        public $media_shortlink, $media_source_name, $media_description, $media_title;
    }

    //poco to request media poster update
    class UpdatePosterRequest extends EncodingRequest {
        //@param _id: id of encoding account user
        //@param _key: key of encoding account user
        public function __construct($_id, $_key, $_shortlink, $_posterurl)
        {
            parent::__construct($_id, $_key, 'UpdatePoster', base_url() . 'index.php/api/hook/update-mediaposter-resp');

            if ( ! isset($_shortlink, $_posterurl))
                throw new Exception('$_shortlink and $_posterurl must be specified!');

            $this->media_shortlink = $_shortlink;
            $this->poster_url = $_posterurl;
        }

        //call to get serialized xml
        public function getXmlString()
        {
            $xml = '<?xml version="1.0"?>' . 
                    "<Query>
                        <Action>{$this->action}</Action>
                        <UserID>{$this->user_id}</UserID>
                        <UserKey>{$this->user_key}</UserKey>
                        <Notify>{$this->notify_url}</Notify>
                        <Source>
                            <MediaShortLink>{$this->media_shortlink}</MediaShortLink>
                            <PosterUrl>{$this->poster_url}</PosterUrl>
                        </Source>
                    </Query>";

            return $xml;
        }

        public $poster_url;
        public $media_shortlink;
    }

    //poco for deleting media
    class DeleteMediaRequest extends EncodingRequest {
        //@param _id: id of encoding account user
        //@param _key: key of encoding account user
        public function __construct($_id, $_key, $_shortlink)
        {
            parent::__construct($_id, $_key, 'DeleteMedia', base_url() . 'index.php/api/hook/delete-media-resp');
            if ( ! isset($_shortlink))
                throw new Exception('Media short-link must be specified!');

            $this->media_shortlink = $_shortlink;
        }

        //call to get serialized xml
        public function getXmlString()
        {
            $xml = '<?xml version="1.0"?>' . 
                    "<Query>
                        <Action>{$this->action}</Action>
                        <UserID>{$this->user_id}</UserID>
                        <UserKey>{$this->user_key}</UserKey>
                        <MediaShortLink>{$this->media_shortlink}</MediaShortLink>
                    </Query>";

            return $xml;
        }

        public $media_shortlink;
    }

    
    //poco to get media encoding status
    class GetStatusRequest extends EncodingRequest {
        //@param _id: id of encoding account user
        //@param _key: key of encoding account user
        public function __construct($_id, $_key, $_shortlink)
        {
            parent::__construct($_id, $_key, 'GetStatus', base_url() . 'index.php/api/hook/get-mediastatus-resp');

            if ( ! isset($_shortlink))
                throw new Exception('shortlink must be specified!');

            $this->media_shortlink = $_shortlink;
        }

        //call to get serialized xml
        public function getXmlString()
        {
            $xml = '<?xml version="1.0"?>' . 
                    "<Query>
                        <Action>{$this->action}</Action>
                        <UserID>{$this->user_id}</UserID>
                        <UserKey>{$this->user_key}</UserKey>
                        <Notify>{$this->notify_url}</Notify>
                        <MediaShortLink>{$this->media_shortlink}</MediaShortLink>                        
                    </Query>";

            return $xml;
        }

        public $media_shortlink;
    }

    //poco to get users media list
    class GetMediaListRequest extends EncodingRequest {
        //@param _id: id of encoding account user
        //@param _key: key of encoding account user
        public function __construct($_id, $_key, $_status_query = '', $_offset = 0, $_limit = 1000)
        {
            parent::__construct($_id, $_key, 'GetMediaList', '');
            $this->media_status_query = $_status_query;
            $this->query_offset = $_offset;
            $this->query_limit = $_limit;
        }

        //call to get serialized xml
        public function getXmlString()
        {
            $xml = '<?xml version="1.0"?>' . 
                    "<Query>
                        <Action>{$this->action}</Action>
                        <UserID>{$this->user_id}</UserID>
                        <UserKey>{$this->user_key}</UserKey>
                        <Status>{$this->media_status_query}</Notify>
                        <From>{$this->query_offset}</From>
                        <Count>{$this->query_limit}</Count>                  
                    </Query>";

            return $xml;
        }

        public $media_status_query, $query_offset, $query_limit;
    }

    //poco to get users media list
    class GetEmbedCodeRequest extends EncodingRequest {
        //@param _id: id of encoding account user
        //@param _key: key of encoding account user
        public function __construct($_id, $_key, $_shortlink, $_embed_type = 'responsive', $_use_https = 'no')
        {
            parent::__construct($_id, $_key, 'GetEmbedCode', '');
            $this->media_shortlink = $_shortlink;
            $this->embed_type = $_embed_type;
            $this->use_https = $_use_https;
        }

        //call to get serialized xml
        public function getXmlString()
        {
            $xml = '<?xml version="1.0"?>' . 
                    "<Query>
                        <Action>{$this->action}</Action>
                        <UserID>{$this->user_id}</UserID>
                        <UserKey>{$this->user_key}</UserKey>
                        <MediaShortLink>{$this->media_shortlink}</MediaShortLink>
                        <Type>{$this->embed_type}</Type>
                        <HTTPS>{$this->use_https}</HTTPS>                  
                    </Query>";

            return $xml;
        }

        public $media_shortlink, $embed_type, $use_https;        
    }
        

    class Vidly_encoding_manager
    {
        const VIDLY_ENC_URL = 'http://m.vid.ly/api/';
        const FTP_MEDIA_SOURCE = 'ftp://<HostingIp>/folder/';

        //call to request video encoding service
        public function addMedia($enc_request_obj)
        {
            $successful = FALSE;
            $success_response = array();
            $enc_class = 'AddMediaRequest';
            $error = '';

            if ($enc_request_obj instanceof $enc_class)
            {
                $vidly_resp = $this->sendRequest($enc_request_obj->getXmlString());

                if ($vidly_resp != FALSE)
                {
                    try
                    {
                        // Creating new object from response XML
                        $xmlDom =  new DOMDocument();
                        if ($xmlDom->loadXML($vidly_resp))
                        {
                            // If there are any errors, set error message
                            if($xmlDom->getElementsByTagName('Errors')->length > 0)
                            {
                                $error = $xmlDom->getElementsByTagName('Errors')->item(0) . '';
                            }
                            elseif ($xmlDom->getElementsByTagName('Success')->length > 0) {
                                // If message received, set OK message
                                $success_response['message'] = (string)$xmlDom->getElementsByTagName('Message')->item(0)->textContent;
                                $success_response['message_code'] = (string)$xmlDom->getElementsByTagName('MessageCode')->item(0)->textContent;
                                $success_response['short_link'] = (string)$xmlDom->getElementsByTagName('ShortLink')->item(0)->textContent;
                                $success_response['media_id'] = (string)$xmlDom->getElementsByTagName('MediaID')->item(0)->textContent;
                                $success_response['qrcode'] = $xmlDom->getElementsByTagName('QRCode')->item(0)->textContent;
                                $success_response['html_embed'] = (string)$xmlDom->getElementsByTagName('HtmlEmbed')->item(0)->textContent;
                                $success_response['responsive_embed'] = base64_encode((string)$xmlDom->getElementsByTagName('ResponsiveEmbed')->item(0)->textContent); //need to encode this as problem with script tag saving on db
                                $success_response['email_embed'] = (string)$xmlDom->getElementsByTagName('EmailEmbed')->item(0)->textContent;
                                
                                $successful = TRUE;
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
            else
                throw new Exception("enc_reuqest_obj must be of type {$enc_class}!");

            //request and return response
            return array('success'=>$successful, 
                         'successinfo'=>$success_response, 
                         'errorinfo'=>$error); //request failure
        }

        //call to request update of media with new source
        public function updateMedia($update_request_obj)
        {
            $successful = FALSE;
            $success_response = array();
            $enc_class = 'UpdateMediaRequest';
            $error = '';

            if ( $update_request_obj instanceof $enc_class)
            {
                $vidly_resp = sendRequest($update_request_obj->getXmlString());

                if ($vidly_resp != FALSE)
                {
                    try
                    {
                        // Creating new object from response XML
                        $xmlDom = new DOMDocument();
                        $xmlDom->loadXML($vidly_resp);
                    
                        // If there are any errors, set error message
                        if($xmlDom->getElementsByTagName('Error')->length > 0)
                            $error = $xmlDom->getElementsByTagName('Error')->item(0) . '';
                        elseif ($xmlDom->getElementsByTagName('Success')->length > 0) {
                            // If message received, set OK message
                            $success_response['message'] = (string)$xmlDom->getElementsByTagName('Message')->item(0)->textContent;
                            $success_response['message_code'] = (string)$xmlDom->getElementsByTagName('MessageCode')->item(0)->textContent;
                            $success_response['media_source_file'] = (string)$xmlDom->getElementsByTagName('SourceFile')->item(0)->textContent;
                            $success_response['media_short_link'] = (string)$xmlDom->getElementsByTagName('ShortLink')->item(0)->textContent;
                            $successful = TRUE;
                        }
                    }
                    catch(Exception $e)
                    {
                        // If wrong XML response received
                        $error = $e->getMessage();
                    }
                }
            }
            else
                throw new Exception("update_request_obj must be of type {$enc_class}!");

            //request and return response
            return array('success'=>$successful, 
                         'successinfo'=>$success_response, 
                         'errorinfo'=>$error); //request failure
        }

        //call to update poster image for video
        public function updatePoster($poster_update_req_obj)
        {
            $enc_class = 'UpdatePosterRequest';
            $successful = FALSE;
            $success_response = array();
            $error = '';

            if ($poster_update_req_obj instanceof $enc_class)
            {
                $vidly_resp = sendRequest($poster_update_req_obj->getXmlString());

                if ($vidly_resp != FALSE)
                {
                    try
                    {
                        // Creating new object from response XML
                        $xmlDom = new DOMDocument();
                        $xmlDom->loadXML($vidly_resp);
                    
                        // If there are any errors, set error message
                        if($xmlDom->getElementsByTagName('Errors')->length > 0)
                            $error = $xmlDom->getElementsByTagName('Errors')->item(0) . '';
                        elseif ($xmlDom->getElementsByTagName('Success')->length > 0) {
                            // If message received, set OK message
                            $success_response['message'] = (string)$xmlDom->getElementsByTagName('Message')->item(0)->textContent;
                            $success_response['message_code'] = (string)$xmlDom->getElementsByTagName('MessageCode')->item(0)->textContent;
                            $success_response['media_short_link'] = (string)$xmlDom->getElementsByTagName('ShortLink')->item(0)->textContent;
                            $successful = TRUE;
                        }
                    }
                    catch(Exception $e)
                    {
                        // If wrong XML response received
                        $error = $e->getMessage();
                    }
                }
            }
            else
                throw new Exception("poster_update_req_obj must be of type {$enc_class}!");

            //request and return response
            return array('success'=>$successful, 
                        'successinfo'=>$success_response, 
                        'errorinfo'=>$error); //request failure
        }

        //call to request media deletion
        public function deleteMedia($del_request_obj)
        {
            $enc_class = 'DeleteMediaRequest';
            $successful = FALSE;
            $success_response = array();
            $error = '';

            if ($del_request_obj instanceof $enc_class)
            {
                $vidly_resp = sendRequest($del_request_obj->getXmlString());

                if ($vidly_resp != FALSE)
                {
                    try
                    {
                        // Creating new object from response XML
                        $xmlDom = new DOMDocument();
                        $xmlDom->loadXML($vidly_resp);
                    
                        // If there are any errors, set error message
                        if($xmlDom->getElementsByTagName('Errors')->length > 0)
                            $error = $xmlDom->getElementsByTagName('Errors')->item(0) . '';
                        elseif ($xmlDom->getElementsByTagName('Success')->item(0) > 0) {
                            // If message received, set OK message
                            $success_response['message'] = (string)$xmlDom->getElementsByTagName('Message')->item(0)->textContent;
                            $success_response['message_code'] = (string)$xmlDom->getElementsByTagName('MessageCode')->item(0)->textContent;
                            $success_response['media_short_link'] = (string)$xmlDom->getElementsByTagName('MediaShortLink')->item(0)->textContent;
                            $successful = TRUE;
                        }
                    }
                    catch(Exception $e)
                    {
                        // If wrong XML response received
                        $error = $e->getMessage();
                    }
                }
            }
            else
                throw new Exception("del_request_obj must be of type {$enc_class}!");

            //request and return response
            return array('success'=>$successful, 
                        'successinfo'=>$success_response, 
                        'errorinfo'=>$error); //request failure
        }

        //call to request media status
        public function getMediaStatus($mediastatus_request_obj)
        {
            $enc_class = 'GetStatusRequest';
            $successful = FALSE;
            $success_response = array();
            $error = '';

            if ($mediastatus_request_obj instanceof $enc_class)
            {
                $vidly_resp = sendRequest($mediastatus_request_obj->getXmlString());

                if ($vidly_resp != FALSE)
                {
                    try
                    {
                        // Creating new object from response XML
                        $xmlDom = new DOMDocument();
                        $xmlDom->loadXML($vidly_resp);
                    
                        // If there are any errors, set error message
                        if($xmlDom->getElementsByTagName('Errors')->length > 0)
                            $error = $xmlDom->getElementsByTagName('Errors')->item(0) . '';
                        elseif ($xmlDom->getElementsByTagName('Success')->length > 0) {
                            // If message received, set OK message
                            $success_response['message'] = (string)$xmlDom->getElementsByTagName('Message')->item(0)->textContent;
                            $success_response['message_code'] = (string)$xmlDom->getElementsByTagName('MessageCode')->item(0)->textContent;
                            $success_response['user_id'] = (string)$xmlDom->getElementsByTagName('UserID')->item(0)->textContent;
                            $success_response['media_short_link'] = (string)$xmlDom->getElementsByTagName('MediaShortLink')->item(0)->textContent;
                            $success_response['media_status'] = (string)$xmlDom->getElementsByTagName('Status')->item(0)->textContent;
                            $success_response['created'] = (string)$xmlDom->getElementsByTagName('Created')->item(0)->textContent;
                            $success_response['updated'] = (string)$xmlDom->getElementsByTagName('Updated')->item(0)->textContent;
                            $successful = TRUE;
                        }
                    }
                    catch(Exception $e)
                    {
                        // If wrong XML response received
                        $error = $e->getMessage();
                    }
                }
            }
            else
                throw new Exception("mediastatus_request_obj must be of type {$enc_class}!");

            //request and return response
            return array('success'=>$successful, 
                        'successinfo'=>$success_response, 
                        'errorinfo'=>$error); //request failure
        }

        //call to request media list
        public function getMediaList($medialist_request_obj)
        {
            $enc_class = 'GetMediaListRequest';
            $successful = FALSE;
            $success_response = array();
            $error = '';

            if ($medialist_request_obj instanceof $enc_class)
            {
                $vidly_resp = sendRequest($medialist_request_obj->getXmlString());

                if ($vidly_resp != FALSE)
                {
                    try
                    {
                        // Creating new object from response XML
                        $xmlDom = new DOMDocument();
                        $xmlDom->loadXML($vidly_resp);
                    
                        // If there are any errors, set error message
                        if($xmlDom->getElementsByTagName('Errors')->length > 0)
                            $error = $response->errors->error[0] . '';
                        elseif ($xmlDom->getElementsByTagName('Success')->length > 0) {
                            // If message received, set OK message
                            $success_response['message'] = (string)$xmlDom->getElementsByTagName('Message')->textContent;
                            $success_response['message_code'] = (string)$xmlDom->getElementsByTagName('MessageCode')->textContent;

                            foreach ($xmlDom->getElementsByTagName('Media') as $media)
                            {
                                $success_response[(string)$media->getElementByTagName('MediaShortLink')->item(0)->textContent] = array(
                                    'shortlink' => $media->getElementByTagName('MediaShortLink')->item(0)->textContent,
                                    'notify' => $media->getElementByTagName('Notify')->item(0)->textContent,
                                    'created' => $media->getElementByTagName('Created')->item(0)->textContent,
                                    'updated' => $media->getElementByTagName('Updated')->item(0)->textContent,
                                    'status' => $media->getElementByTagName('Status')->item(0)->textContent,
                                    'storagesize' => $media->getElementByTagName('Storage')->item(0)->textContent,
                                    'title' => $media->getElementByTagName('Title')->item(0)->textContent,
                                    'description' => $media->getElementByTagName('Description')->item(0)->textContent
                                );
                            }

                            $successful = TRUE;
                        }
                    }
                    catch(Exception $e)
                    {
                        // If wrong XML response received
                        $error = $e->getMessage();
                    }
                }
            }
            else
                throw new Exception("medialist_request_obj must be of type {$enc_class}!");

            //request and return response
            return array('success'=>$successful, 
                        'successinfo'=>$success_response, 
                        'errorinfo'=>$error); //request failure
        }

        //call to request media list
        public function getEmbedCode($embedcode_request_obj)
        {
            $enc_class = 'GetEmbedCodeRequest';
            $successful = FALSE;
            $success_response = array();
            $error = '';

            if ($embedcode_request_obj instanceof $enc_class)
            {
                $vidly_resp = sendRequest($embedcode_request_obj->getXmlString());

                if ($vidly_resp != FALSE)
                {
                    try
                    {
                        // Creating new object from response XML
                        $xmlDom = new DOMDocument();
                        $xmlDom->loadXML($vidly_resp);
                    
                        // If there are any errors, set error message
                        if($xmlDom->getElementsByTagName('Errors')->length > 0)
                            $error = $response->errors->error[0] . '';
                        elseif ($xmlDom->getElementsByTagName('Success')->length > 0) {
                            // If message received, set OK message
                            $success_response['message'] = (string)$xmlDom->getElementsByTagName('Messaage')->item(0)->textContent;
                            $success_response['message_code'] = (string)$xmlDom->getElementsByTagName('MessaageCode')->item(0)->textContent;
                            $success_response['media_shortlink'] = (string)$xmlDom->getElementsByTagName('MediaShortLink')->item(0)->textContent;
                            $success_response['embed_code'] = (string)$xmlDom->getElementsByTagName('EmbedCode')->item(0)->textContent;

                            $successful = TRUE;
                        }
                    }
                    catch(Exception $e)
                    {
                        // If wrong XML response received
                        $error = $e->getMessage();
                    }
                }
            }
            else
                throw new Exception("embedcode_request_obj must be of type {$enc_class}!");

            //request and return response
            return array('success'=>$successful, 
                        'successinfo'=>$success_response, 
                        'errorinfo'=>$error); //request failure
        }

        //call to get poster image for encoded video
        public function getPosterImage($media_shortlink, $image = 1)
        {
            if (isset($media_shortlink, $image) && $image >= 1 && $image <= 10)
            {
                switch ($image)
                {
                    case 1:
                        return $media_shortlink . '/poster';
                    case 2:
                        return $media_shortlink . '/poster2';
                    case 3:
                        return $media_shortlink . '/poster3';
                    case 4:
                        return $media_shortlink . '/poster_hd';
                    case 5:
                        return $media_shortlink . '/poster2_hd';
                    case 6:
                        return $media_shortlink . '/poster3_hd';
                    case 7:
                        return $media_shortlink . '/qrposter';
                    case 8:
                        return $media_shortlink . '/thumbnail1';
                    case 9:
                        return $media_shortlink . '/thumbnail2';
                    case 10:
                        return $media_shortlink . '/thumbnail3';
                }
            }

            return NULL;
        }

        //send request code
        private function sendRequest($xml)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, self::VIDLY_ENC_URL);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "xml=" . urlencode($xml));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);

            return curl_exec($ch);
        } 
    }