<?php

class Personeelslid extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    //Hashcode voorbeeld-personeelslid : 307a3008430f2817d37bc619212ab39b

    /**
     * Toont de startpagina van het personeelslid.
     * @param string|null $hashcode
     */
    public function index($hashcode = null){
        $data["titel"] = "Homepagina";
        $data["verantwoordelijke"] = "Arno Stoop";
        $data["functionaliteit"] = "Geen functionaliteit, dit is de homepagina";

        if($this->session->has_userdata("personeelslid")){
            $persoon = $this->session->userdata('personeelslid');
        } else{
            $persoon = $this->bepaalGebruiker($hashcode);
        }

        if($persoon != null){
            $this->session->set_userdata("personeelslid", $persoon);
            $data["personeelslid"] = $persoon;

            $partials = array('hoofding' => 'views_personeelslid/personeelslid_navbar',
                'content' => 'views_personeelslid/home',
                'footer' => 'main_footer_personeelslid'
            );

            $this->template->load('main_master_personeelslid', $partials, $data);
        }

    }

    /**
     * Bepaal de persoon adhv de hashcode. Toon een foutmelding als deze persoon geen personeelslid is.
     * Geeft het persoon object terug enkel als de persoon een personeelslid is.
     * @param $hashcode
     * @return mixed personeelslid
     */
    function bepaalGebruiker($hashcode){
        $persoon = null;

        if($hashcode == null){
            $this->toonFout('views_personeelslid/foutpaginas/fout_general');
        } else{
            $this->load->model('persoon_model');
            $persoon = $this->persoon_model->getPersoonWhereHashcode($hashcode);
            if($persoon->type == "organisator"){
                var_dump($persoon);
                $persoon = null;
                $this->toonFout('views_personeelslid/foutpaginas/fout_persoonisadmin');
            } else if($persoon->type == "helper"){
                $persoon = null;
                $data["hashcode"] = $hashcode;
                $this->toonFout('views_personeelslid/foutpaginas/fout_persoonishelper', $data);
            } else if(!$persoon->type == 'personeelslid'){
                $persoon = null;
                $this->toonFout('views_personeelslid/foutpaginas/fout_general');
            }
        }


        return $persoon;
    }

    /**
     * Toon een bepaalde foutmelding.
     * @param $viewpad het pad naar de file met foutmelding.
     * @param mixed|null $dataToAdd eventuele data die meegestuurd moet worden.
     */
    function toonFout($viewpad, $dataToAdd = null){
        $data["titel"] = "Homepagina";
        $data["verantwoordelijke"] = "Arno Stoop";
        $data["functionaliteit"] = "Foutmelding!";

        if($dataToAdd != null){
            foreach($dataToAdd as $extraData=>$value){
                $data[$extraData] = $value;
            }
        }

        $partials = array('hoofding' => 'views_personeelslid/personeelslid_navbar',
            'content' => $viewpad,
            'footer' => 'main_footer_personeelslid'
        );
        $this->template->load('main_master_personeelslid', $partials, $data);
    }
}