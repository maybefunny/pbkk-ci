<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model("transaction_model");
        $this->load->library('form_validation');
        $this->load->model("user_model");
        $this->load->model("product_model");
        $this->load->model("category_model");
		if($this->user_model->isNotLogin()) redirect(site_url('admin/login'));
    }

    public function index()
    {
        $data["transactions"] = $this->transaction_model->getAll();
        $this->load->view("admin/transaction/list", $data);
    }

    public function add()
    {
        $data["categories"] = $this->category_model->getAll();
        $data["products"] = $this->product_model->getAll();

        $this->load->view("admin/transaction/new_form", $data);
	}

	public function addUtil(){
        $transaction = $this->transaction_model;
        $validation = $this->form_validation;
		$validation->set_rules($transaction->rules());
		// var_dump('test');

        if ($validation->run()) {
			$data = $transaction->save();
			echo(json_encode($data));
			return;
		}
		var_dump(validation_errors());
	}
	
    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->transaction_model->delete($id)) {
            redirect(site_url('transactions'));
        }
    }
}
