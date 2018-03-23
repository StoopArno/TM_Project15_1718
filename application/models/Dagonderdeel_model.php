<?php

class Dagonderdeel_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Ophalen alle dagonderdelen en bijhorende locaties van een bepaald personeelsfeest
     */

    function getAllWherePfidWithLocaties($personeelsfeestid){
        $this->db->where("personeelsfeestid", $personeelsfeestid);
        $query = $this->db->get("dagonderdeel");
        $dagonderdelen = $query->result();

        $this->load->model("locatie_model");
        foreach($dagonderdelen as $dagonderdeel){
            $dagonderdeel->begintijd = DateTime::createFromFormat("Y-m-d H:i:s", $dagonderdeel->begintijd);
            $dagonderdeel->eindtijd = DateTime::createFromFormat("Y-m-d H:i:s", $dagonderdeel->eindtijd);
            if($dagonderdeel->locatieId != null){
                $dagonderdeel->locatie = $this->locatie_model->get($dagonderdeel->locatieId)->locatie;
            }
        }

        return $dagonderdelen;
    }

    /**
     * Ophalen alle dagonderdelen en bijhorende opties, taken en shiften van een bepaald personeelsfeest
     */

    function getAllWherePfIdWithOpties_Taken_Shiften($personeelsfeestId){
        $this->db->where("personeelsfeestid", $personeelsfeestId);
        $query = $this->db->get("dagonderdeel");
        $dagonderdelen = $query->result();


        $this->load->model("Optie_model");
        foreach ($dagonderdelen as $dagonderdeel){
            $begintijd = DateTime::createFromFormat("Y-m-d H:i:s", $dagonderdeel->begintijd);
            $eindtijd = DateTime::createFromFormat("Y-m-d H:i:s", $dagonderdeel->eindtijd);
            $dagonderdeel->begintijd = $begintijd;
            $dagonderdeel->eindtijd = $eindtijd;
            $dagonderdeel->opties = $this->Optie_model->getAllWhereDagonderdeelidWithTaken_Shiften($dagonderdeel->id);
        }

        return $dagonderdelen;
    }
}