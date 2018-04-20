<?php

class Foto_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getAllWithPersoneelsfeest(){
        $query = $this->db->get("foto");
        $fotos = $query->result();

        $this->model->load("personeelsfeest_model");
        foreach($fotos as $foto){
            $foto->personeelsfeest = $this->personeelsfeest_model->get($foto->personeelsfeestId);
        }

        return $fotos;
    }
}