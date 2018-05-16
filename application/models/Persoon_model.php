<?php

/**
 * @class Persoon_model
 * @brief Bevat alle CRUD-methoden voor de tabel 'Persoon'.
 *
 *Alle methoden waarmee data uit de tabel 'Persoon' wordt gehaald, bewerkt of weggeschreven, is hier terug te vinden.
 */
class Persoon_model extends CI_Model
{
    /**
     * Persoon_model constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Ophalen bepaalde persoon adhv hashcode.
     * @param $hashcode
     * @return mixed|null de persson die bij de hashcode hoort of null als de hashcode niet bestaat.
     */
    function getPersoonWhereHashcode($hashcode){
        $this->db->where('hashcode', $hashcode);
        $query = $this->db->get('persoon');
        return $query->row();
    }

    /**
     * Ophalen van de gegevens van een persoon
     * @param $id
     * @return mixed | null de persoon die bij de id hoort of null als de id niet bestaat.


    /**
     * Ophalen bepaalde persoon adhv id.
     * @param $id
     * @return mixed

     */
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('persoon');
        return $query->row();
    }

    /**
     * Ophalen van de inloggegevens van een admin
     * @param $login
     * @param $wachtwoord
     * @return mixed | null Als De persoon van het type organisator die bij de login en wachtwoord hoort of null indien iets niet correct


    /**
     * Ophalen admin.
     * @param $login
     * @param $wachtwoord
     * @return null

     */
    function getAdmin($login, $wachtwoord) {

        $this->db->where('type', 'organisator');
        $this->db->where('voornaam', $login);
        $query = $this->db->get('persoon');

        if($query->num_rows() == 1) {
            $admin = $query->row();

            if(password_verify($wachtwoord, $admin->wachtwoord)) {
                return $admin;
            } else {
                return null;
            }
        }
        else {
            return null;
        }
    }
    /**
     * Ophalen van alle personen van het type organisator
     * @return mixed
     */
    function getAllAdmin() {
        $this->db->where('type', 'organisator');
        $query = $this->db->get('persoon');
        return $query->result();
    }

    /**
     * Het toevoegen van een persoon met het type organisator
     * @param $naam
     * @param $voornaam
     * @param $email
     * @param $gsm
     * @param $wachtwoord
     */
    function organisatorToevoegen($naam, $voornaam, $email, $gsm, $wachtwoord) {
        $admin = new stdClass();
        $admin->naam = $naam;
        $admin->voornaam = $voornaam;
        $admin->email = $email;
        $admin->type = "organisator";
        $admin->gsm_nummer = $gsm;
        $admin->wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
        $this->db->insert('persoon', $admin);
    }
    /**
     * Verwijderen van een persoon
     * @param id
     *
     */
    function verwijder($id) {
        $this->db->where('id', $id);
        $this->db->delete('persoon');
    }

    /**
     * Ophalen van alle personeelsleden
     * @param $zoekstring
     * @return mixed | null geeft de personeelsleden terug die aan de zoekstring voldoen of null als er niets gelijk is aan die zoekstring
     */
    function getAllPersoneelsleden($zoekstring){
        $this->db->where('type', 'personeelslid');

            $this->db->like('naam', $zoekstring, 'after');

        $query = $this->db->get('persoon');
        return $query->result();
    }

    /**
     * Ophalen van het type van een persoon
     * @param $persoonid
     * @return mixed | null geeft een persoon terug of null als id niet bestaat
     */
function getTypeBYPersoonId($persoonid){
        $this->db->where('id',$persoonid);

}
    /**
     * Ophalen van alle personen van het type helper


    /**
     * Ophalen alle personen van het type 'helper'.

     * @return mixed
     */
    function getAllHelpers(){
        $this->db->where('type', 'helper');
        $query = $this->db->get('persoon');
        return $query->result();
    }

    /**
     * Deze functie laat je een personeelslid aan de database toevoegen.
     * @param $naam
     * @param $voornaam
     * @param $email
     * @param $gsm
     * @param $hashcode
     */
    function personeelslidToevoegen($naam, $voornaam, $email, $gsm, $hashcode) {
        $personeelslid = new stdClass();
        $personeelslid->naam = $naam;
        $personeelslid->voornaam = $voornaam;
        $personeelslid->email = $email;
        $personeelslid->gsm_nummer = $gsm;
        $personeelslid->type = "personeelslid";
        $personeelslid->hashcode = $hashcode;
        $this->db->insert('persoon', $personeelslid);
    }

    /**
     * Deze functie laat je een helper aan de database toevoegen.
     * @param $naam
     * @param $voornaam
     * @param $email
     * @param $gsm
     * @param $hashcode
     */
    function helperToevoegen($naam, $voornaam, $email, $gsm, $hashcode) {
        $helper = new stdClass();
        $helper->naam = $naam;
        $helper->voornaam = $voornaam;
        $helper->email = $email;
        $helper->gsm_nummer = $gsm;
        $helper->type = "helper";
        $helper->hashcode = $hashcode;

        $this->db->insert('persoon', $helper);
    }

    /**
     *  Deze functie haalt een bepaald personeelslid op.
     * @param $id
     * @return mixed
     */
    function getpersoneelslid($id){
        $this->db->where('id', $id);
        $query = $this->db->get('persoon');
        return $query->row();
    }

    /**
     * Deze functie haalt iemand op per naam en voornaam.
     * @param $naam
     * @param $voornaam
     * @return mixed
     */
    function getByNaam($naam,$voornaam){
        $this->db->where('naam', $naam);
        $this->db->where('voornaam', $voornaam);
        $query = $this->db->get('persoon');
        return $query->row();
    }

    /**
     * Deze functie haalt personeelsleden op met een optieID.
     * @param $id
     * @return mixed
     */
    function getAllPersoneelsledenWhereOptieId($id){
        $this->db->where('type', 'personeelslid');
        $query = $this->db->get('personen');
        $personeelsleden = $query->result();
        foreach ($personeelsleden as $personeelslid){

            $personeelslid->inschrijvingen = $this->Inschrijving_model->getAllByPersoonId($personeelslid->id);
        }
        return $query->result();
    }



    /**
     * Deze functiehaalt een persoon op
     * @param $id
     * @return mixed | null geeft een persoon terug of null als de id niet bestaat
     */
function getByIdWithInschrijvingen($id){
    $this->db->where('id', $id);
    $query = $this->db->get('persoon');
    return $query->row();
}
    /**
     * Deze functie wijzigt een persoon
     * @param $id
     * @param $voornaam
     * @param $naam
     * @param $email
     * @param $gsm
     */
    function updatePersoon($id,$voornaam,$naam,$email,$gsm){
        $this->db->where('id', $id);
        $persoon = new stdClass();
        $persoon->naam = $naam;
        $persoon->voornaam = $voornaam;
        $persoon->email = $email;
        $persoon->gsm_nummer = $gsm;

        $this->db->update("persoon", $persoon);



    }




    /**
     * Deze functie haalt een persoon op a.d.h.v. een hashcode. Zo weet de applicatie wie er aangemeld is.
     * @param $hashcode
     * @return mixed
     */
    function getPersoon($hashcode) {
        $this->db->where('type', 'helper');
        $this->db->where('hashcode', $hashcode);
        $query = $this->db->get('persoon');
        return $query->row();
    }

}