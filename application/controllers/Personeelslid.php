<?php

class Personeelslid extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $data["titel"] = "Homepagina";
        $data["verantwoordelijke"] = "Arno Stoop";
        $data["functionaliteit"] = "Geen functionaliteit, dit is de homepagina";

        $partials = array('hoofding' => 'views_personeelslid/personeelslid_navbar',
            'content' => 'views_personeelslid/home',
            'sidenav' => 'views_personeelslid/personeelslid_sidebar',
            'footer' => 'main_footer'
        );

        $this->template->load('main_master', $partials, $data);
    }
}