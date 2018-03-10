<?php

class Dagonderdeel_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getAllWherePersoneelsfeestIdWithOpties($peronseelsfeestId){
        $this->db->where("personeelsfeestid", $peronseelsfeestId);
        $query = $this->db->get("dagonderdeel");
        $dagonderdelen = $query->result();


        $this->load->model("Optie_model");
        foreach ($dagonderdelen as $onderdeel){
            $onderdeel->opties = $this->Optie_model->getAllWhereDagonderdeelidWithTaken($onderdeel->id);
        }

        return $dagonderdelen;
    }
}