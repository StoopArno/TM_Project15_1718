<?php

class Shift_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Ophalen alle Shiften van een bepaalde shift
     */

    function getAllWhereTaakid($taakid){
        $this->db->where('taakid', $taakid);
        $query = $this->db->get('shift');
        $shiften = $query->result();

        foreach($shiften as $shift){
            $beginuur = DateTime::createFromFormat("Y-m-d H:i:s", $shift->beginuur);
            $einduur = DateTime::createFromFormat("Y-m-d H:i:s", $shift->einduur);
            $shift->beginuur = $beginuur;
            $shift->einduur = $einduur;
        }

        return $shiften;
    }
}