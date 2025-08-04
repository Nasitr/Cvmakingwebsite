<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Redirect to signin if user is not logged in
        if (!$this->session->userdata('uid')) {
            redirect('signin');
        }
    }

    public function index() {
        // Get user info from session
        $data = [
            'firstname' => $this->session->userdata('fname'),
            'username'  => $this->session->userdata('user_name')
        ];

        // Load the welcome view with user data
        $this->load->view('welcome', $data);
    }
}
