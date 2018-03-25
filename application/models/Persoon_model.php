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

    function getAllAdmin() {
        $this->db->where('type', 'organisator');
        $query = $this->db->get('persoon');
        return $query->result();
    }

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

    function verwijder($id) {
        $this->db->where('id', $id);
        $this->db->delete('persoon');
    }


}