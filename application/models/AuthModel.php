<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {

    public function get_user($username) {
        return $this->db->get_where('users', array('username' => $username))->row();
    }

    public function create_user($username, $password) {
        $data = array(
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        );
        $this->db->insert('users', $data);
    }
}
