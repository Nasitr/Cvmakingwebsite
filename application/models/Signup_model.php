<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup_Model extends CI_Model {
    public function insert_user($fname, $lname, $emailid, $password) {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $data = array(
            'firstname' => $fname,
            'lastname' => $lname,
            'emailid'  => $emailid, 
            'password' => $hashed_password
        );

        $query = $this->db->insert('users', $data);

        if ($query) {
            $this->session->set_flashdata('success', 'Registration successful, now you can login.');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
        }

        redirect('signin');
    }
}
