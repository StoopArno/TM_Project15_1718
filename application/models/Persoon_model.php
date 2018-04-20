<?php

class Persoon_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('persoon');
        return $query->row();
    }
    function getAdmin($login, $wachtwoord) {

        $this->db->where('type', 'organisator');
        $this->db->where('voornaam', $login);
        $query = $this->db->get('persoon');

        if($query->num_rows() == 1) {
            $admin = $query->row();

            if(password_verify($wachtwoord, $admin->wachtwoord)) {
                return $admin;
            } else {
                return null;
            }
        }
        else {
            return null;
        }
    }
    /**
     * Ophalen van alle personen van het type organisator
     */
    function getAllAdmin() {
        $this->db->where('type', 'organisator');
        $query = $this->db->get('persoon');
        return $query->result();
    }
    /**
     * Het toevoegen van een persoon met het type organisator
     */
    function organisatorToevoegen($naam, $voornaam, $email, $gsm, $wachtwoord) {
        $admin = new stdClass();
        $admin->naam = $naam;
        $admin->voornaam = $voornaam;
        $admin->email = $email;
        $admin->type = "organisator";
        $admin->gsm_nummer = $gsm;
        $admin->wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
        $this->db->insert('persoon', $admin);
    }
    /**
     * Verwijderen van een persoon
     */
    function verwijder($id) {
        $this->db->where('id', $id);
        $this->db->delete('persoon');
    }

    /**
     * Ophalen van alle personeelsleden
     */
    function getAllPersoneelsleden($zoekstring){
        $this->db->where('type', 'personeelslid');

            $this->db->like('naam', $zoekstring, 'after');

        $query = $this->db->get('persoon');
        return $query->result();
    }
    function getAllHelpers(){
        $this->db->where('type', 'helper');
        $query = $this->db->get('persoon');
        return $query->result();
}

    function personeelslidToevoegen($naam, $voornaam, $email, $gsm) {
        $personeelslid = new stdClass();
        $personeelslid->naam = $naam;
        $personeelslid->voornaam = $voornaam;
        $personeelslid->email = $email;
        $personeelslid->type = "personeelslid";
        $personeelslid->gsm_nummer = $gsm;

        $this->db->insert('persoon', $personeelslid);
    }
    function helperToevoegen($naam, $voornaam, $email, $gsm) {
        $personeelslid = new stdClass();
        $personeelslid->naam = $naam;
        $personeelslid->voornaam = $voornaam;
        $personeelslid->email = $email;
        $personeelslid->type = "helper";
        $personeelslid->gsm_nummer = $gsm;

        $this->db->insert('persoon', $personeelslid);
    }
function getpersoneelslid($id){
    $this->db->where('id', $id);
    $query = $this->db->get('persoon');
    return $query->row();
}
    function getByNaam($naam,$voornaam){
        $this->db->where('naam', $naam);
        $this->db->where('voornaam', $voornaam);
        $query = $this->db->get('persoon');
        return $query->row();
    }
function getAllPersoneelsledenWhereOptieId($id){
    $this->db->where('type', 'personeelslid');
    $query = $this->db->get('personen');
    $personeelsleden = $query->result();
    foreach ($personeelsleden as $personeelslid){

        $personeelslid->inschrijvingen = $this->Inschrijving_model->getAllByPersoonId($personeelslid->id);
    }
    return $query->result();
}

}