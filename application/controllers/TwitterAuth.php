<?php
defined('BASEPATH') or exit('No direct script access allowed');
require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterAuth extends CI_Controller
{

    private $consumer_key = 'xjb0Ljw69O3QoMEbT4dYes6O4';
    private $consumer_secret = 'xTuevolyUzD8ePNCFcyYDaeLK2Lw2FJmDvH5jnuGGE5iNxDJ2n';
    private $callback_url = 'http://localhost/Oauth/twitterauth/callback'; // Update with your callback URL

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $twitteroauth = new TwitterOAuth($this->consumer_key, $this->consumer_secret);
        $request_token = $twitteroauth->oauth('oauth/request_token', array('oauth_callback' => 'oob'));
        $this->session->set_userdata('oauth_token', $request_token['oauth_token']);
        $this->session->set_userdata('oauth_token_secret', $request_token['oauth_token_secret']);
        $url = $twitteroauth->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
        redirect($url);
    }

    // public function callback()
    // {
    //     $oauth_token = $this->session->userdata('oauth_token');
    //     $oauth_token_secret = $this->session->userdata('oauth_token_secret');
    //     $oauth_verifier = $this->input->get('oauth_verifier');

    //     $twitteroauth = new TwitterOAuth($this->consumer_key, $this->consumer_secret, $oauth_token, $oauth_token_secret);
    //     $access_token = $twitteroauth->oauth('oauth/access_token', array('oauth_verifier' => $oauth_verifier));

    //     $this->session->unset_userdata('oauth_token');
    //     $this->session->unset_userdata('oauth_token_secret');


    //     $twitteroauth = new TwitterOAuth($this->consumer_key, $this->consumer_secret, $access_token['oauth_token'], $access_token['oauth_token_secret']);
    //     $user_info = $twitteroauth->get('account/verify_credentials', ['include_email' => 'true']);

    //     // Assuming you have a users table in your database
    //     // You can modify this part to fit your database structure
    //     $data = array(
    //         'twitter_id' => $user_info->id,
    //         'name' => $user_info->name,
    //         'email' => $user_info->email,
    //         'profile_image_url' => $user_info->profile_image_url_https
    //     );

    //     // $access_token contains user's access token and secret
    //     // Use this to retrieve user information or perform other actions
    //    print_r($data);
    // }

    public function callback()
    {
        $oauth_token = $this->session->userdata('oauth_token');
        $oauth_token_secret = $this->session->userdata('oauth_token_secret');
        $oauth_verifier = $this->input->get('oauth_verifier');

        $twitteroauth = new TwitterOAuth($this->consumer_key, $this->consumer_secret, $oauth_token, $oauth_token_secret);
        $access_token = $twitteroauth->oauth('oauth/access_token', array('oauth_verifier' => $oauth_verifier));

        $this->session->unset_userdata('oauth_token');
        $this->session->unset_userdata('oauth_token_secret');

        // Process the PIN code (oauth_verifier) entered by the user
        if ($access_token) {
            // Authorization successful, do something with $access_token
            var_dump($access_token);
        } else {
            // Authorization failed
            echo 'Authorization failed. Please try again.';
        }
    }
    
    public function enter_pin()
    {
        // Display a form for the user to enter the PIN code
        $this->load->view('enter_pin_form');
    }

    public function process_pin()
    {
        $pin = $this->input->post('pin');
        // Process the PIN code entered by the user
        // This could include validating the PIN and completing the authorization process
        // For simplicity, we'll just redirect back to the callback method with the PIN
        redirect('twitterauth/callback?oauth_verifier=' . $pin);
    }
}
