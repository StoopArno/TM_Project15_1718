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
    function getAllPersoneelsleden(){
        $this->db->where('type', 'personeelslid');
        $query = $this->db->get('persoon');
        return $query->result();
    }


}