<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signin_Model extends CI_Model {

    public function validate_user($email, $password) {
        // Use correct column name: emailid
        $this->db->where('emailid', $email);
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            $user = $query->row();

            // Verify password using password_verify
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }

        return false;
    }
}
