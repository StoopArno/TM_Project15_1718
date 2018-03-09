<?php

class Helper extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
    }

    public function index(){


        $partials = array('hoofding' => 'views_helper/helper_header',
            'inhoud' => 'views_helper/helper_index',
            'footer' => 'main_footer'

    );
        $this->template->load('main_master', $partials);
    }
}