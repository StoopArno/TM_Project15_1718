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
            'footer' => 'main_footer'
        );

        if(!$this->session->has_userdata('personeelslid')){
            $data["functionaliteit"] = "Foutmelding!";
            $partials['content'] = 'views_personeelslid/foutpaginas/fout_general';
        } else{
            $data["functionaliteit"] = "Hier kan je als personeelslid inschrijven voor de verschillende mogelijke opties";
            $partials['content'] = 'views_personeelslid/personeelslid_inschrijven';
            $personeelslid = $this->session->userdata('personeelslid');



            $this->load->model("personeelsfeest_model");
            $personeelsfeest = $this->personeelsfeest_model->getLastPersoneelsfeest();
            $this->load->model("dagonderdeel_model");
            $dagonderdelen = $this->dagonderdeel_model->getAllWherePfidWithOpties_Inschrijving($personeelsfeest->id, $personeelslid->id);
            $data["dagonderdelen"] = $dagonderdelen;
        }

        $this->template->load('main_master_personeelslid', $partials, $data);
    }

    /**
     * Een personeelslid inschrijven.
     * als er geen personeelslid in de sesssie zit wordt er een fout weergegeven.
     * De pagina wordt opnieuw geladen na succesvolle inschrijving.
     */
    public function inschrijven(){
        if(!$this->session->has_userdata('personeelslid')){
            $this->sessieverlopen();
        } else{
            $opmerking = "";
            if($this->input->post('opmerking') != null){
                $opmerking = $this->input->post('opmerking');
            }
            $dagonderdeelKey = $this->input->post('dagonderdeelKey');
            $optieid = $this->input->post($dagonderdeelKey);
            $persoon = $this->session->userdata('personeelslid');
            $this->load->model('inschrijving_model');
            $this->inschrijving_model->insert($persoon->id, $optieid, $opmerking);
            redirect(base_url() . "index.php/Inschrijven_personeelslid");
        }
    }

    /**
     * De inschrijving van een personeelslid wijzigen.
     * als er geen personeelslid in de sesssie zit wordt er een fout weergegeven.
     * De pagina wordt opnieuw geladen na succesvolle wijziging.
     */
    public function wijzigen(){
        if(!$this->session->has_userdata('personeelslid')){
            $this->sessieverlopen();
        } else{
            $opmerking = "";
            if($this->input->post('opmerking') != null){
                $opmerking = $this->input->post('opmerking');
            }
            $dagonderdeelKey = $this->input->post('dagonderdeelKey');
            //echo $dagonderdeelKey; exit;
            $optieid = $this->input->post($dagonderdeelKey);
            $inschrijvingId = $this->input->post('inschrijvingId');
            $this->load->model('inschrijving_model');
            $this->inschrijving_model->update($inschrijvingId, $optieid, $opmerking);
            redirect(base_url() . "index.php/Inschrijven_personeelslid");
        }
    }

    /**
     * De inschrijving van een personeelslid verwijderen.
     * @param $id Het id van de inschrijving.
     */
    public function uitschrijven($id){
        if(!$this->session->has_userdata('personeelslid')){
            $this->sessieverlopen();
        } else{
            $this->load->model('inschrijving_model');
            $this->inschrijving_model->delete($id);
            redirect(base_url() . "index.php/Inschrijven_personeelslid");
        }
    }

    public function sessieverlopen(){
        $data["titel"] = "Inschrijven";
        $data["verantwoordelijke"] = "Arno Stoop";
        $data["functionaliteit"] = "Foutmelding!";
        $partials = array('hoofding' => 'views_personeelslid/personeelslid_navbar',
            'content' => 'views_personeelslid/foutpaginas/fout_general',
            'footer' => 'main_footer'
        );
    }
}