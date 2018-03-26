<?php

class Optie_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Ophalen alle Oties en bijhorende taken en shiften van een bepaald dagonderdeel
     */

    function getAllWhereDagonderdeelidWithTaken_Shiften($dagonderdeelid){
        $this->db->where('dagonderdeelid', $dagonderdeelid)->order_by("optie", "asc");
        $query = $this->db->get('optie');
        $opties = $query->result();

        $this->load->model('Taak_model');
        foreach ($opties as $optie){
            $optie->taken = $this->Taak_model->getAllWhereOptieidWithShiften($optie->id);
        }

        return $opties;
    }
    /**
     * Ophalen van alle opties met bijhorende inschrijvingen op die opties
     */
    function getAllByDagonderdeelIdWithInschrijvingen($dagonderdeelid){
        $this->db->where('dagonderdeelid', $dagonderdeelid);

        $query = $this->db->get('optie');
        $opties = $query->result();
        $this->load->model('Inschrijving_model');
        foreach ($opties as $optie){

            $optie->inschrijvingen = $this->Inschrijving_model->getAllByOptieId($optie->id);
        }

        return $opties;
    }
}