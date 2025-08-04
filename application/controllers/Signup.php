<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {

    public function index() {
        $this->load->library('form_validation');

        // Set validation rules
        $this->form_validation->set_rules('firstname', 'First Name', 'required|alpha');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required|alpha');
        $this->form_validation->set_rules('emailid', 'Email Id', 'required|valid_email|is_unique[users.emailid]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_message('is_unique', 'This email already exists.');

        if ($this->form_validation->run() == TRUE) {
            $fname = $this->input->post('firstname', TRUE);
            $lname = $this->input->post('lastname', TRUE);
            $emailid = $this->input->post('emailid', TRUE);
            $password = $this->input->post('password', TRUE);

            $this->load->model('Signup_Model');

            $insert = $this->Signup_Model->insert_user($fname, $lname, $emailid, $password);

            if ($insert) {
                $this->session->set_flashdata('success', 'Registration successful! You can now sign in.');
                redirect('Signin');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
                redirect('Signup');
            }
        } else {
            $this->load->view('signup');
        }
    }
}
