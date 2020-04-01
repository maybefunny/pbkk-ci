<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("category_model");
        $this->load->library('form_validation');
        $this->load->model("user_model");
		if($this->user_model->isNotLogin()) redirect(site_url('admin/login'));
		if($this->session->user_logged->role != "admin") redirect(site_url('admin/overview'));
    }

    public function index()
    {
        $data["categories"] = $this->category_model->getAll();
        $this->load->view("admin/category/list", $data);
    }

    public function add()
    {
		if($this->session->user_logged->role != "admin") redirect(site_url('admin/categories'));
        $category = $this->category_model;
        $validation = $this->form_validation;
        $validation->set_rules($category->rules());

        if ($validation->run()) {
            $category->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/category/new_form");
    }

    public function edit($id = null)
    {
		if($this->session->user_logged->role != "admin") redirect(site_url('admin/categories'));
        if (!isset($id)) redirect('admin/categories');
       
        $category = $this->category_model;
        $validation = $this->form_validation;
        $validation->set_rules($category->rules());

        if ($validation->run()) {
            $category->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["category"] = $category->getById($id);
        if (!$data["category"]) show_404();
        
        $this->load->view("admin/category/edit_form", $data);
    }

    public function delete($id=null)
    {
		if($this->session->user_logged->role != "admin") redirect(site_url('admin/categories'));
        if (!isset($id)) show_404();
        
        if ($this->category_model->delete($id)) {
            redirect(site_url('admin/categories'));
        }
    }
}
