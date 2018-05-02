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

    function getInschrijvingPersoon($persoonId) {
        $this->db->where('persoonId', $persoonId);
        $query = $this->db->get('shiftinschrijving');
        $inschrijving = $query->result();
        return $inschrijving;
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

    function schrijfUit($persoonId, $shiftId) {
        $this->db->where('persoonId', $persoonId);
        $this->db->where('shiftId', $shiftId);
        $this->db->delete('shiftinschrijving');
    }

    function bestaatOfNiet($persoonId, $shiftId) {
        $this->db->where('persoonId', $persoonId);
        $this->db->where('shiftId', $shiftId);
        $query = $this->db->get('shiftinschrijving');
        $inschrijving = $query->row();

        if($inschrijving == null) {
            $trueFalse = false;
        } else {
            $trueFalse = true;
        }

        return $trueFalse;
    }

}

