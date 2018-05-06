<?php

class Inschrijven_personeelslid extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Toont een overzicht van inschrijfbare opties aan het personeelslid.
     */

    public function index(){
        $data["titel"] = "Inschrijven";
        $data["verantwoordelijke"] = "Arno Stoop";

        $partials = array('hoofding' => 'views_personeelslid/personeelslid_navbar',
            'content' => '',
            'sidenav' => 'views_personeelslid/personeelslid_sidebar',
            'footer' => 'main_footer'
        );

        if(!$this->session->has_userdata('personeeelslid')){
            //Redirect
            $data["functionaliteit"] = "Foutmelding!";
            $partials['content'] = 'views_personeelslid/foutpaginas/fout_general';
        } else{
            $data["functionaliteit"] = "Hier kan je als personeelslid inschrijven voor de verschillende mogelijke opties";
            $partials['content'] = 'views_personeelslid/personeelslid_inschrijven';

            $this->load->model("personeelsfeest_model");
            $personeelsfeest = $this->personeelsfeest_model->getLastPersoneelsfeest();
            $this->load->model("dagonderdeel_model");
            $dagonderdelen = $this->dagonderdeel_model->getAllWherePfid($personeelsfeest->id);
            $data["dagonderdelen"] = $dagonderdelen;
        }

        $this->template->load('main_master', $partials, $data);
    }


    public function inschrijven(){
        var_dump($_POST);
    }
}