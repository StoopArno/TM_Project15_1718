<?php

class Shift_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Ophalen van een bepaalde shift.
     * @param $id
     * @return mixed
     */
    function get($id){
        $this->db->where("id", $id);
        $query = $this->db->get("shift");
        return $query->row();
    }

    /**
     * Updaten van een shift.
     * @param $shift
     */
    function update($shift){
        $this->db->where("id", $shift->id);
        $this->db->update("shift", $shift);
    }

    function updateHelperAantal($id) {
        $shift = $this->get($id);
        $nieuwAantal = $shift->aantalHelpers + 1;
        $data = array('aantalHelpers' => $nieuwAantal);
        $this->db->where('id', $id);
        $this->db->update('shift', $data);
    }

    function updateHelperAantalMin($id) {
        $shift = $this->get($id);
        $nieuwAantal = $shift->aantalHelpers - 1;
        $data = array('aantalHelpers' => $nieuwAantal);
        $this->db->where('id', $id);
        $this->db->update('shift', $data);
    }

    /**
     * Toevoegen van een nieuwe shift.
     * @param $shift
     */
    function insert($shift){
        $this->db->insert("shift", $shift);
    }

    /**
     * verwijderen van een bepaalde shift.
     * @param $id
     */
    function delete($id){
        $this->db->where("id", $id);
        $this->db->delete("shift");
    }


    /**
     * Ophalen alle Shiften van een bepaalde taak
     * @param $taakid
     * @return mixed
     */
    function getAllWhereTaakid($taakid){
        $this->db->where('taakid', $taakid);
        $query = $this->db->get('shift');
        $shiften = $query->result();

        foreach($shiften as $shift){
            $beginuur = DateTime::createFromFormat("Y-m-d H:i:s", $shift->beginuur);
            $einduur = DateTime::createFromFormat("Y-m-d H:i:s", $shift->einduur);
            $shift->beginuur = $beginuur;
            $shift->einduur = $einduur;
        }

        return $shiften;
    }
    function  getAllShiftUren(){
        $this->db->select('*');
        $this->db->order_by("beginuur", "asc");
        $this->db->group_by('beginuur,einduur');
        $query = $this->db->get('shift');
        $shiften = $query->result();
        return $shiften;
    }
    function  getAllShiften(){
        $this->db->order_by("beginuur", "asc");
        $query = $this->db->get('shift');
        $shiften = $query->result();
        return $shiften;
    }
function getAllWhereTaakidWithInschrijvingen($taakid){
    $this->db->where('taakid', $taakid);
    $query = $this->db->get('shift');
    $shiften = $query->result();
    $this->load->model('Shiftinschrijving_model');
    foreach($shiften as $shift){
        $shift->inschrijvingen = $this->Shiftinschrijving_model->getAllInschrijvingenWhereShiftId($shift->id);;

    }
    return $shiften;

}


}