<?php

class Tekst_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getTeksten() {
        $query = $this->db->get("tekst");
        $teksten = $query->result();
        return $teksten;
    }

    function pasTekstAan($id, $omschrijving) {
        $data = array('omschrijving' => $omschrijving);

        $this->db->where('id', $id);
        $this->db->update('tekst', $data);
    }
    function  getByNaam($naam){
        $this->db->where('naam', $naam);
        $query = $this->db->get("tekst");

        $tekst = $query->row();
        return $tekst;

}
}