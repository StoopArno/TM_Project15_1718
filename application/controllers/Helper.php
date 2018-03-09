<?php

class Helper extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){


        $partials = array('hoofding' => 'views_helper/helper_header',
            'inhoud' => 'hello_world',
            'footer' => 'main_footer'

    );
        $this->template->load('main_master', $partials);
    }
}