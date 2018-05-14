<?php

/**
 * @class Dagonderdeel_model
 * @brief Bevat alle CRUD-methoden voor de tabel 'Dagonderdeel'.
 */
class Dagonderdeel_model extends CI_Model
{
    /**
     * Dagonderdeel_model constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Ophalen specifiek dagonderdeel.
     * @param $id
     * @return mixed
     */
    function get($id){
        $this->db->where("id", $id);
        $query = $this->db->get("dagonderdeel");
        return $query->row();
    }

    /**
     * Updaten van een dagonderdeel
     * @param $dagonderdeel
     */
    function update($dagonderdeel){
        $this->db->where("id", $dagonderdeel->id);
        $this->db->update("dagonderdeel", $dagonderdeel);
    }

    /**
     * Toevoegen van een nieuw dagonderdeel
     * @param $dagonderdeel
     */
    function insert($dagonderdeel){
        $this->db->insert("dagonderdeel", $dagonderdeel);
    }

    /**
     * Verwijderen van een dagonderdeel
     * @param $id
     */
    function delete($id){
        $this->db->where("id", $id);
        $this->db->delete("dagonderdeel");
    }


    /**
     * Ophalen alle dagonderdelen van een bepaald personeelsfeest.
     * @param $personeelsfeestid
     * @return mixed array van dagonderdelen.
     */
    function getAllWherePfid($personeelsfeestid){
        $this->db->where("personeelsfeestId", $personeelsfeestid);
        $query = $this->db->get("dagonderdeel");

        $dagonderdelen = $query->result();
        foreach($dagonderdelen as $dagonderdeel){
            $dagonderdeel->begintijd = DateTime::createFromFormat("Y-m-d H:i:s", $dagonderdeel->begintijd);
            $dagonderdeel->eindtijd = DateTime::createFromFormat("Y-m-d H:i:s", $dagonderdeel->eindtijd);
        }

        return $dagonderdelen;
    }

    /**
     * Ophalen alle dagonderdelen van een bepaald personeelsfeest met bijhorende opties.
     * Per dagonderdeel wordt ook bepaald of er al een inschrijving bestaat voor één van de bijhorende opties.
     * @param $personeelsfeestid
     * @param $persoonid
     * @return mixed array van dagonderdelen.
     */
    function getAllWherePfidWithOpties_Inschrijving($personeelsfeestid, $persoonid){
        $this->db->where("personeelsfeestId", $personeelsfeestid);
        $query = $this->db->get("dagonderdeel");

        $this->load->model("optie_model");
        $this->load->model('inschrijving_model');
        $dagonderdelen = $query->result();
        foreach($dagonderdelen as $dagonderdeel){
            $dagonderdeel->begintijd = DateTime::createFromFormat("Y-m-d H:i:s", $dagonderdeel->begintijd);
            $dagonderdeel->eindtijd = DateTime::createFromFormat("Y-m-d H:i:s", $dagonderdeel->eindtijd);
            $dagonderdeel->opties = $this->optie_model->getAllWhereDagonderdeelid($dagonderdeel->id);

            $dagonderdeel->heeftInschrijving = false;
            foreach($dagonderdeel->opties as $optie){
                $optie->aantalInschrijvingen = $this->inschrijving_model->getAantalInschrijvingenPerOptie($optie->id);
                $inschrijving = $this->inschrijving_model->getWherePersoonIdAndOptieId($persoonid, $optie->id);
                if($inschrijving != null){
                    $dagonderdeel->heeftInschrijving = true;
                    $dagonderdeel->inschrijving = $inschrijving;
                }
            }

        }

        return $dagonderdelen;
    }

    /**
     * Ophalen alle dagonderdelen en bijhorende locaties van een bepaald personeelsfeest.
     * @param $personeelsfeestid
     * @return mixed
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
     * @param $personeelsfeestId
     * @return mixed
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

    /**
     * Ophalen alle dagonderdelen en bijhorende opties met de inschrijvingen op die opties.
     * @return mixed
     */
    function getAllByBegintijdWithOpties(){
        $this->db->order_by('begintijd', 'asc');
        $query = $this->db->get("dagonderdeel");
        $dagonderdelen = $query->result();
        $this->load->model("Optie_model");
        foreach ($dagonderdelen as $onderdeel){
            $onderdeel->opties = $this->Optie_model->getAllByDagonderdeelIdWithInschrijvingen($onderdeel->id);
        }


        return $dagonderdelen;
    }




    /**
     * Ophalen alle dagonderdelen van een bepaald personeelsfeest waarvan het locatieId niet null is.
     * @return mixed
     */
    function getAllWherePfIdAndLocatieIdIsNotNull($personeelsfeestId){
        $this->db->where("personeelsfeestId", $personeelsfeestId);
        $this->db->where("locatieId !=", null);
        $query = $this->db->get("dagonderdeel");
        return $query->result();
    }

    /**
     * Ophalen alle dagonderdelen van een bepaald personeelsfeest waarvan het locatieId wel null is.
     * @param $personeelsfeestId
     * @return mixed
     */
    function getAllWherePfIdAndLocatieIdIsNull($personeelsfeestId){
        $this->db->where("personeelsfeestId", $personeelsfeestId);
        $this->db->where("locatieId =", null);
        $query = $this->db->get("dagonderdeel");
        return $query->result();
    }


    function getByDagonderdeelId($id){
        $this->db->where("id", $id);
        $this->db->order_by("id", "asc");
        $query = $this->db->get("dagonderdeel");
        return $query->row();

    }

}