<?php

class Locatie_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Ophalen bepaalde locatie
     */

    function get($locatieid){
        $this->db->where("id", $locatieid);
        $query = $this->db->get("locatie");

        return $query->row();
    }
}