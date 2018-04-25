<?php

class Foto_bekijken extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $data["titel"] = "Foto's bekijken";
        $data["verantwoordelijke"] = "Arno Stoop";
        $data["functionaliteit"] = "Fotos bekijken. Hier kan je de foto's van alle voorbije jaren bekijken.";

        $this->load->model("personeelsfeest_model");
        $data["personeelsfeesten"] = $this->personeelsfeest_model->getAllOrderByDatum();

        $data["jaarIdToClick"] = $this->personeelsfeest_model->getLastPersoneelsfeest()->id;

        $partials = array('hoofding' => 'views_personeelslid/personeelslid_navbar',
            'content' => 'views_personeelslid/foto_bekijken/fotos_bekijken',
            'sidenav' => 'views_personeelslid/personeelslid_sidebar',
            'footer' => 'main_footer'
        );

        $this->template->load('main_master', $partials, $data);
    }

    /**
     * Returned de view van een bepaald jaar.
     * @param $id
     */
    public function haalAjaxOp_Foto($id){
        $this->load->model("foto_model");
        $fotos = $this->foto_model->getAllWherePfId($id);
        $data["fotos"] = $fotos;
        $data["personeelsfeestId"] = $id;

        $this->load->view("views_personeelslid/foto_bekijken/ajax_foto_specifiekJaar", $data);
    }
}