<?php

class Helper extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
    }

    public function index(){

        $data["titel"] = "Homepagina";
        $data["verantwoordelijke"] = "Arno Stoop";
        $data["functionaliteit"] = "Geen functionaliteit, dit is de homepagina";

        $partials = array('hoofding' => 'views_helper/helper_navbar',
            'content' => 'views_helper/home',
            'sidenav' => 'views_helper/helper_sidebar',
            'footer' => 'main_footer'
        );

        $this->template->load('main_master', $partials, $data);
    }
}