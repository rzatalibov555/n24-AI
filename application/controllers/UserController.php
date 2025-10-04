<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("user/AdminsModel");
        $this->load->model("user/AdvertisingModel");
        $this->load->model("user/CategoriesModel");
        $this->load->model("user/NewsModel");
        $this->load->model("user/SettingsModel");
    }

    public function index()
    {
        $this->load->view("front/pages/index");
    }

    public function about()
    {
        $this->load->view("front/pages/about-us");
    }

    public function category($id)
    {
        $this->load->view("front/pages/categories-style-01");
    }

    public function detail($id)
    {
        $this->load->view("front/pages/blog-single-01");
    }

}