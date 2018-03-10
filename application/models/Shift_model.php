<?php

class Shift_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getAllWhereTaakid($taakid){
        $this->db->where('taakid', $taakid);
        $query = $this->db->get('shift');
        return $query->result();
    }
}