<?php

class Helper extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
     //   $this->load->view("test");

        $partials = array('hoofding' => 'helper_header',
            'inhoud' => 'test');
        $this->template->load('main_master', $partials);
    }
}