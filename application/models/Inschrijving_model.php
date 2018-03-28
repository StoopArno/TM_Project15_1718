<?php

class Inschrijving_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    /**
     * Ophalen van alle inschrijvingen van een meegeven optie.
     */
    function getAllByOptieId($optieid){
        $this->db->where('optieid', $optieid);

        $query = $this->db->get('inschrijving');

        $inschrijvingen = $query->result();
        return $inschrijvingen;

    }
function getAllByPersoonId($personeelslidid){

}
}

