<?php

/**
 * @class Shiftinschrijving_model
 * @brief Bevat alle CRUD-methoden voor de tabel 'Shiftinschrijving'.
 */
class Shiftinschrijving_model extends CI_Model
{
    /**
     * Shiftinschrijving_model constructor.
     */
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

    /**
     * Deze functie haalt alle inschrijvingen op van een bepaald persoon.
     * @param $persoonId
     * @return mixed
     */
    function getInschrijvingPersoon($persoonId) {
        $this->db->where('persoonId', $persoonId);
        $query = $this->db->get('shiftinschrijving');
        $inschrijving = $query->result();
        return $inschrijving;
    }

    /**
     * Deze functie haalt alle inschrijvingen op.
     * @return mixed
     */
function getAllinschrijvingen(){

    $query = $this->db->get('shiftinschrijving');

    $inschrijvingen = $query->result();
    return $inschrijvingen;
}

    /**
     * Deze functie schrijft een persoon in voor een bepaalde shift.
     * @param $persoonid
     * @param $shiftid
     */
    function schrijfIn($persoonid,$shiftid){
        $inschrijving = new stdClass();
        $inschrijving->persoonid = $persoonid;
        $inschrijving->shiftid = $shiftid;

        $this->db->insert('shiftinschrijving', $inschrijving);
    }

    /**
     * Deze functie laat toe een persoon uit te schrijven.
     * @param $persoonId
     * @param $shiftId
     */
    function schrijfUit($persoonId, $shiftId) {
        $this->db->where('persoonId', $persoonId);
        $this->db->where('shiftId', $shiftId);
        $this->db->delete('shiftinschrijving');
    }

    /**
     * Deze functie gaat na of een persoon al ingeschreven is voor een bepaalde shift.
     * @param $persoonId
     * @param $shiftId
     * @return bool
     */
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

