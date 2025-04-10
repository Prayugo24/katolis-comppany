<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('AuthModel'); 
        $this->load->library('session'); 
        $this->load->helper(array('url', 'form'));
		$this->load->helper('url');
		$this->load->helper('form');
    }

    public function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
        $this->load->view('backend/Login/login');
    }

	public function sample() {
		var_dump($this->session->flashdata('error_message'));
		echo "Form Submitted!";
	}

    public function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->AuthModel->get_user($username);

        if ($user && password_verify($password, $user->password)) {
            $session_data = array(
                'username' => $user->username,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($session_data);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error_login', 'Username atau Password salah');
            redirect('control-panel');
        }
    }

    public function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('username');
        $this->session->sess_destroy();
        redirect('control-panel');
    }

	public function create() {
		$this->AuthModel->create_user('admin', 'password123');
		print_r("sukses create");

	}

}
