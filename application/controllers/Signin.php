<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends CI_Controller {

    public function index() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('emailid', 'Email id', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            $email = $this->input->post('emailid', TRUE);
            $password = $this->input->post('password', TRUE);

            $this->load->model('Signin_Model');
            $validate = $this->Signin_Model->validate_user($email, $password);

            if ($validate) {
                // Set session data
                $this->session->set_userdata('uid', $validate->id);
                $this->session->set_userdata('fname', $validate->firstname);
                $this->session->set_userdata('user_name', $validate->firstname); // or username if exists

                redirect('Welcome');
            } else {
                $this->session->set_flashdata('error', 'Invalid login credentials. Please try again.');
                redirect('Signin');
            }
        } else {
            // Load signin view with validation errors
            $this->load->view('signin');
        }
    }
}
