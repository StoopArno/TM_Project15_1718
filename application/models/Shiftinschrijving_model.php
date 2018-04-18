<?php

class Shiftinschrijving_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    /**
     * Ophalen van alle inschrijvingen van een meegeven optie.
     */
    function getAllInschrijvingenWhereShiftId($shiftid)
    {
        $this->db->where('shiftid', $shiftid);

        $query = $this->db->get('shiftinschrijving');

        $inschrijvingen = $query->result();
        return $inschrijvingen;

    }
function getAllinschrijvingen(){

    $query = $this->db->get('shiftinschrijving');

    $inschrijvingen = $query->result();
    return $inschrijvingen;
}
    function schrijfIn($persoonid,$shiftid){
        $inschrijving = new stdClass();
        $inschrijving->persoonid = $persoonid;
        $inschrijving->shiftid = $shiftid;

        $this->db->insert('shiftinschrijving', $inschrijving);
    }

}

