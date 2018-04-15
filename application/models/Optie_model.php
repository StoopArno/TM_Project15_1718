<?php

class Optie_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Ophalen bepaalde optie.
     * @param $id
     * @return mixed
     */
    function get($id){
        $this->db->where("id", $id);
        $query = $this->db->get("optie");
        return $query->row();
    }

    /**
     * Updaten van een optie.
     * @param $optie
     */
    function update($optie){
        $this->db->where("id", $optie->id);
        $this->db->update("optie", $optie);
    }

    /**
     * Toevoegen van een nieuwe optie.
     * @param $optie
     */
    function insert($optie){
        $this->db->insert("optie", $optie);
    }

    /**
     * Verwijderen van een bepaalde optie.
     * @param $id
     */
    function delete($id){
        $this->db->where("id", $id);
        $this->db->delete("optie");
    }


    /**
     * Ophalen alle opties van een bepaald dagonderdeel
     * @param $dagonderdeelId
     * @return mixed
     */
    function getAllWhereDagonderdeelid($dagonderdeelId){
        $this->db->where("dagonderdeelId", $dagonderdeelId);
        $query = $this->db->get("optie");

        return $query->result();
    }

    /**
     * Ophalen alle opties voor een array van dagonderdelen.
     * De naam van de dagonderdelen zelf wordt ook gereturned.
     * @param $dagonderdeelIds
     * @return mixed
     */
    function getAllWhereDagonderdeeidsWithDagonderdelen($dagonderdeelIds){
        $this->db->where("dagonderdeelId", $dagonderdeelIds[0]);
        for ($i = 1; $i < count($dagonderdeelIds); $i++) {
            $this->db->or_where("dagonderdeelId", $dagonderdeelIds[$i]);
        }
        $this->db->order_by("dagonderdeelId", "asc");
        $query = $this->db->get("optie");
        $opties = $query->result();
        $this->load->model("dagonderdeel_model");
        foreach($opties as $optie){
            $optie->dagonderdeel = $this->dagonderdeel_model->get($optie->dagonderdeelId)->naam;
        }

        return $opties;
    }

    /**
     * Ophalen alle Opties en bijhorende taken en shiften van een bepaald dagonderdeel
     * @param $dagonderdeelid
     * @return mixed
     */
    function getAllWhereDagonderdeelidWithTaken_Shiften($dagonderdeelid){
        $this->db->where('dagonderdeelid', $dagonderdeelid)->order_by("optie", "asc");
        $query = $this->db->get('optie');
        $opties = $query->result();

        $this->load->model('Taak_model');
        foreach ($opties as $optie){
            $optie->taken = $this->Taak_model->getAllWhereOptieidWithShiften($optie->id);
        }

        return $opties;
    }

    /**
     * Ophalen van alle opties met bijhorende inschrijvingen op die opties.
     * @param $dagonderdeelid
     * @return mixed
     */
    function getAllByDagonderdeelIdWithInschrijvingen($dagonderdeelid){
        $this->db->where('dagonderdeelid', $dagonderdeelid);

        $query = $this->db->get('optie');
        $opties = $query->result();
        $this->load->model('Inschrijving_model');
        foreach ($opties as $optie){

            $optie->inschrijvingen = $this->Inschrijving_model->getAllByOptieId($optie->id);
        }

        return $opties;
    }

    function getAllOptiesWithDagonderdeel(){
        $query = $this->db->get('optie');
        $opties = $query->result();
        $this->load->model('Dagonderdeel_model');
        foreach ($opties as $optie){

            $optie->dagonderdeel = $this->Dagonderdeel_model->getByDagonderdeelId($optie->dagonderdeelId);
        }
        return $opties;
    }
}


