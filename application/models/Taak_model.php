<?php

/**
 * @class Taak_model
 * @brief Bevar alle CRUD-methoden voor de tabel 'Taak'.
 */
class Taak_model extends CI_Model
{
    /**
     * Taak_model constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Ophalen specifieke taak
     * @param $id
     * @return mixed
     */
    function get($id){
        $this->db->where("id", $id);
        $query = $this->db->get("taak");
        return $query->row();
    }

    /**
     * Updaten van een taak.
     * @param $taak
     */
    function update($taak){
        $this->db->where("id", $taak->id);
        $this->db->update("taak", $taak);
    }

    /**
     * Toevoegen van een nieuwe taak.
     * @param $taak
     */
    function insert($taak){
        $this->db->insert("taak", $taak);
    }

    /**
     * Verwijderen bepaalde taak.
     * @param $id
     */
    function delete($id){
        $this->db->where("id", $id);
        $this->db->delete("taak");
    }


    /**
     * Ophalen alle taken en bijhorende shiften van een bepaalde optie.
     * @param $optieid
     * @return mixed
     */
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

    /**
     * Deze functie haalt alle opties per ID op.
     * @param $optieId
     * @return mixed
     */
    function getAllByOptieId($optieId) {
        $this->db->where('optieId', $optieId);
        $query = $this->db->get('taak');
        return $query->result();
    }

        function getAllwithshiften(){

            $query = $this->db->get('taak');
            $taken = $query->result();

            $this->load->model('Shift_model');
            foreach ($taken as $taak){
                $taak->shiften = $this->Shift_model->getAllWhereTaakidWithInschrijvingen($taak->id);
            }
            return $taken;


}


    /**
     * Ophalen alle taken en bijhorende shiften van een bepaald dagonderdeel.
     * @param $dagonderdeelId
     * @return mixed
     */
    function getAllWheredagonderdeelIdWithShiften($dagonderdeelId){
        $this->db->where("dagonderdeelId", $dagonderdeelId);
        $query = $this->db->get('taak');
        $taken = $query->result();

        $this->load->model('Shift_model');
        foreach ($taken as $taak){
            $taak->shiften = $this->Shift_model->getAllWhereTaakid($taak->id);
        }
        return $taken;
    }

    /**
     * Ophalen alle taken voor een bepaald personeelsfeest met bijhorende dagonderdelen en, indoen van toepassing, bijhorende opties.
     * @param $personeelsfeestId
     * @return mixed
     */
    function getAllWherePfIdWithDagonderdelen_Opties($personeelsfeestId){
        $this->db->where("personeelsfeestId", $personeelsfeestId);
        $this->db->order_by("dagonderdeelId", "desc");
        $query = $this->db->get("taak");
        $taken = $query->result();

        $this->load->model("dagonderdeel_model");
        $this->load->model("optie_model");
        foreach($taken as $taak){
            $taak->dagonderdeel = $this->dagonderdeel_model->get($taak->dagonderdeelId);
            if($taak->optieId != null){
                $taak->optie = $this->optie_model->get($taak->optieId);
            }
        }
        return $taken;
    }

    
}