<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->library('session');
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }
	public function index()
	{	
		$this->load->view('backend/Dashboard/nav/header');
		$this->load->view('backend/Dashboard/index');
		$this->load->view('backend/Dashboard/nav/footer');
	}

}
