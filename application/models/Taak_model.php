<?php

class Taak_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getAllWhereoptieIdWithShiften($optieid){
        $this->db->where('optieid', $optieid);
        $query = $this->db->get('taak');
        $taken = $query->result();

        $this->load->model('Shift_model');
        foreach ($taken as $taak){
            $taak->shiften = $this->Shift_model->getAllWhereTaakid($taak->id);
        }

        return $taken;
    }
}