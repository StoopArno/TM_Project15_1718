<?php
/**
 * @class Tekst_model
 * @brief Bevat alle CRUD-methoden voor de tabel 'Tekst'.
 */
class Tekst_model extends CI_Model
{
    /**
     * Tekst_model constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Deze functie haalt alle teksten die aangepast moeten worden op uit de database.
     * @return mixed
     */
    function getTeksten() {
        $query = $this->db->get("tekst");
        $teksten = $query->result();
        return $teksten;
    }

    /**
     * Deze functie past een tekst uit de database aan.
     * @param $id
     * @param $omschrijving
     */
    function pasTekstAan($id, $omschrijving) {
        $data = array('omschrijving' => $omschrijving);

        $this->db->where('id', $id);
        $this->db->update('tekst', $data);
    }

    /**
     * Deze functie haalt een bepaalde tekst uit de database op (d.m.v. een naam).
     * @param $naam
     * @return mixed
     */
    function getByNaam($naam){
        $this->db->where('naam', $naam);
        $query = $this->db->get("tekst");

        $tekst = $query->row();
        return $tekst;

}
}