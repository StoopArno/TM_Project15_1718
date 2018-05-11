<?php

class Personeelsfeest_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    /**
     * Ophalen specifiek personeelsfeest
     * @param $id
     * @return mixed
     */
    function get($id){
        $this->db->where("id", $id);
        $query = $this->db->get("personeelsfeest");
        return $query->row();
    }

    /**
     * Ophalen alle personeelsfeesten
     * @return mixed
     */
    function getAllOrderByDatum(){
        $this->db->order_by("datum", "desc");
        $query = $this->db->get("personeelsfeest");
        $personeelsfeesten = $query->result();
        foreach($personeelsfeesten as $personeelsfeest){
            $personeelsfeest->datum = DateTime::createFromFormat("Y-m-d", $personeelsfeest->datum);
        }

        return $personeelsfeesten;
    }

    /**
     * Ophalen Van het laatst aangemaakt personeelsfeest
     */
    function getLastPersoneelsfeest(){
        $this->db->order_by("id", "desc")->limit(1);
        $query = $this->db->get("personeelsfeest");

        return $query->row();
    }

    /**
     * Deze functie maakt een nieuw personeelsfeest aan.
     * @param $datum
     */
    function maakPersoneelsfeest($datum) {
        $personeelsfeest = new stdClass();
        $personeelsfeest->datum = $datum;
        $this->db->insert('personeelsfeest', $personeelsfeest);
    }

    /**
     * Deze functie haalt alle personeelsfeesten op.
     * @return mixed
     */
    function getPersoneelsfeesten() {
        $query = $this->db->get('personeelsfeest');
        return $query->result();
    }

    /**
     * Deze functie laat je toe een personeelsfeest te verwijderen.
     * @param $id
     */
    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('personeelsfeest');
    }

    /**
     * Deze functie laat je toe een personeelsfeest te wijzigen.
     * @param $id
     * @param $date
     */
    function wijzig($id, $date) {
        $data = array('datum' => $date);
        $this->db->where('id', $id);
        $this->db->update('personeelsfeest', $data);
    }

}