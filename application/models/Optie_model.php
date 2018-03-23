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
}