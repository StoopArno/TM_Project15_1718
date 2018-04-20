<?php

class Inschrijven_optie extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $data["titel"] = "Inschrijven";
        $data["verantwoordelijke"] = "Arno Stoop";
        $data["functionaliteit"] = "Hier kan je als personeelslid inschrijven voor de verschillende mogelijke opties";

        $this->load->model("personeelsfeest_model");
        $personeelsfeest = $this->personeelsfeest_model->getLastPersoneelsfeest();
        $this->load->model("dagonderdeel_model");
        $dagonderdelen = $this->dagonderdeel_model->getAllWherePfid($personeelsfeest->id);
        $this->load->model("optie_model");
        foreach ($dagonderdelen as $dagonderdeel){
            $dagonderdeel->opties = $this->optie_model->getAllWhereDagonderdeelId($dagonderdeel->id);
        }


        $data["dagonderdelen"] = $dagonderdelen;

        $partials = array('hoofding' => 'views_personeelslid/personeelslid_navbar',
            'content' => 'views_personeelslid/personeelslid_inschrijven',
            'sidenav' => 'views_personeelslid/personeelslid_sidebar',
            'footer' => 'main_footer'
        );

        $this->template->load('main_master', $partials, $data);
    }
}