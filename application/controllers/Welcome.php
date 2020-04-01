<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
		if($this->user_model->isNotLogin()) redirect(site_url('admin/login'));
    }
	public function index()
	{
		$this->load->view('admin/overview.php');
	}
	public function about()
	{
		$this->load->view('about');
	}
	public function contact()
	{
		$this->load->view('contact');
	}
}
