<?php
defined('BASEPATH') or exit('No direct script access allowed');
require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;



class TwitterAuth extends CI_Controller
{

    private $consumer_key;
    private $consumer_secret;
    private $callback_url;

    public function __construct()
    {
        parent::__construct();

        // Load configuration (replace placeholders with your actual values)
        $this->config->load('twitter');
        $this->load->model('Users_model');
        $this->consumer_key = $this->config->item('consumer_key');
        $this->consumer_secret = $this->config->item('consumer_secret');
        $this->callback_url = $this->config->item('callback_url'); // Update with your callback URL
    }

    public function index()
    {
        $twitteroauth = new TwitterOAuth($this->consumer_key, $this->consumer_secret);

        $request_token = $twitteroauth->oauth('oauth/request_token', array('oauth_callback' => $this->callback_url));

        if ($twitteroauth->getLastHttpCode() === 200) {
            // Store request token and secret in session
            $this->session->set_userdata('oauth_token', $request_token['oauth_token']);
            $this->session->set_userdata('oauth_token_secret', $request_token['oauth_token_secret']);

            // Build authorization URL
            $auth_url = $twitteroauth->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));

            redirect($auth_url);
        } else {
            // Handle error: Failed to get request token
            echo 'Failed to get request token. Error code: ' . $twitteroauth->getLastHttpCode();
        }
    }

    public function callback()
    {
        $oauth_token = $this->session->userdata('oauth_token');
        $oauth_token_secret = $this->session->userdata('oauth_token_secret');
        $oauth_verifier = $this->input->get('oauth_verifier');

        $twitteroauth = new TwitterOAuth($this->consumer_key, $this->consumer_secret, $oauth_token, $oauth_token_secret);
        $access_token = $twitteroauth->oauth('oauth/access_token', array('oauth_verifier' => $oauth_verifier));

        $this->session->unset_userdata('oauth_token');
        $this->session->unset_userdata('oauth_token_secret');

        if ($access_token && !empty($access_token['oauth_token']) && !empty($access_token['oauth_token_secret'])) {
            // Authorization successful, use $access_token
            $oauth = new TwitterOAuth($this->consumer_key, $this->consumer_secret, $access_token['oauth_token'], $access_token['oauth_token_secret']);
            $oauth->setApiVersion('1.1');
            try {
              
                $user_info = $oauth->get('account/verify_credentials', array('include_email' => 'true', 'include_entities' => 'false', 'skip_status' => 'true'));
                $user = $this->Users_model->get_user_by_twitter_id($user_info->id);
                if(!empty($user)){
                    $this->session->set_userdata('user_id', $user['id']);
                        redirect('dashboard');
                }else{
                        $data = array(
                            'twitter_id' => $user_info->id,
                            'name' => $user_info->name,
                            'email' => $user_info->email,
                            'picture' => $user_info->profile_image_url_https
                        );
                        $value = $this->db->insert('users', $data);
                }
                $this->session->set_userdata('user_id', $user['id']);
                redirect('dashboard');

            } catch (Exception $e) {
                echo 'Error getting user information: ' . $e->getMessage();
            }
        } else {
            // Authorization failed
            echo 'Authorization failed. Please try again.';
        }
        
    }
}
