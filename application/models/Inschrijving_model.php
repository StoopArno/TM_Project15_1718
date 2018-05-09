<?php

class Inschrijving_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Ophalen bepaalde inschrijving.
     * @param $id
     * @return mixed|null De inschrijving die bij het id hoort.
     */
    function get($id){
        $this->db->where('id', $id);
        $query = $this->db->get('inschrijving');
        return $query->row();
    }

    /**
     * Toevoegen inschrijving.
     * @param $persoonid
     * @param $optieid
     * @param $commentaar
     */
    function insert($persoonid, $optieid, $opmerking){
        $inschrijving = new stdClass();
        $inschrijving->persoonid = $persoonid;
        $inschrijving->optieid = $optieid;
        $inschrijving->opmerking = $opmerking;

        $this->db->insert('inschrijving', $inschrijving);
    }

    /**
     * Wijzigen van een bepaalde inschrijving.
     * @param $id id van de inschrijving
     * @param $optieid
     * @param $opmerking
     */
    function update($id, $optieid, $opmerking){
        $inschrijving = new stdClass();
        $inschrijving->optieid = $optieid;
        $inschrijving->opmerking = $opmerking;

        $this->db->where('id', $id);
        $this->db->update('inschrijving', $inschrijving);
    }

    /**
     * Verwijderen bepaalde inschrijving.
     * @param $id
     */
    function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('inschrijving');
    }

    /**
     * Bepaalt of een combinatie van persoon en optie bestaat in inschrijving.
     * @param $persoonid
     * @param $optieid
     * @return null|mixed null als de combinatie niet bestaat, als deze wel bestaat wordt de row teruggegeven.
     */
    function getWherePersoonIdAndOptieId($persoonid, $optieid){
        $this->db->where('persoonid', $persoonid);
        $this->db->where('optieid', $optieid);
        $query = $this->db->get('inschrijving');
        if($query == null){
            return null;
        } else{
            return $query->row();
        }
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

    /**
     * Geeft het aantal inschrjvingen voor een bepaalde optie.
     * @param $optieid
     * @return int aantal inschrijvingen
     */
    function getAantalInschrijvingenPerOptie($optieid){
        $this->db->where('optieid', $optieid);
        $this->db->from('inschrijving');
        return $this->db->count_all_results();
    }

function getAllByPersoonId($personeelslidid){

}
function schrijfIn($persoonid,$optieid){
    $inschrijving = new stdClass();
    $inschrijving->persoonid = $persoonid;
    $inschrijving->optieid = $optieid;

    $this->db->insert('inschrijving', $inschrijving);
}
}

