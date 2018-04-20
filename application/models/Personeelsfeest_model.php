<?php

class Personeelsfeest_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Ophalen Van het laatst aangemaakt personeelsfeest
     */

    function get($id){
        $this->db->where("id", $id);
        $query = $this->db->get("personeelsfeest");
    }

    function getLastPersoneelsfeest(){
        $this->db->order_by("id", "desc")->limit(1);
        $query = $this->db->get("personeelsfeest");

        return $query->row();
    }


}