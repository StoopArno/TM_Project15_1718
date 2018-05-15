<?php

/**
 * @class Foto_bekijken
 * @brief Controller-klasse voor Foto-bekijken.
 *
 * Controller-klasse met alle methoden i.v.m. het bekijken van foto's voor personeelsleden.
 */
class Foto_bekijken extends CI_Controller
{
    /**
     * Foto_bekijken constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Toont een overzicht van alle foto's van het laatste jaar.
     * Met de mogelijkheid om andere jaren te selecteren.
     * @see Personeelsfeest_model::getAllOrderByDatum()
     * @see Personeelsfeest_model::getLastPersoneelsfeest()
     * @see views_personeelslid/foto_bekijken/fotos_bekijken.php
     */
    public function index(){
        $data["titel"] = "Foto's bekijken";
        $data["verantwoordelijke"] = "Arno Stoop";
        $data["functionaliteit"] = "Fotos bekijken. Hier kan je de foto's van alle voorbije jaren bekijken.";

        $this->load->model("personeelsfeest_model");
        $data["personeelsfeesten"] = $this->personeelsfeest_model->getAllOrderByDatum();

        $data["jaarIdToClick"] = $this->personeelsfeest_model->getLastPersoneelsfeest()->id;

        $partials = array('hoofding' => 'views_personeelslid/personeelslid_navbar',
            'content' => 'views_personeelslid/foto_bekijken/fotos_bekijken',
            'footer' => 'main_footer_personeelslid'
        );

        $this->template->load('main_master_personeelslid', $partials, $data);
    }

    /**
     * Returned de view van een bepaald jaar.
     * @param $id
     * @see Foto_model::getAllWherePfId()
     * @see views_personeelslid/foto_bekijken/ajax_foto_specifiekJaar.php
     */
    public function haalAjaxOp_Foto($id){
        $this->load->model("foto_model");
        $fotos = $this->foto_model->getAllWherePfId($id);
        $data["fotos"] = $fotos;
        $data["personeelsfeestId"] = $id;

        $this->load->view("views_personeelslid/foto_bekijken/ajax_foto_specifiekJaar", $data);
    }
}