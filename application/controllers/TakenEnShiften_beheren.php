<?php

/**
 * @class TakenEnShiften_beheren
 * @brief Controller-klasse voor TakenEnShiften_beheren
 *
 * Controller-klasse met alle methoden i.v.m. het beheren van alle taken en shiften.
 */
class TakenEnShiften_beheren extends CI_Controller
{
    /**
     * TakenEnShiften_beheren constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if(!$this->authex->isAdmin()) {
            redirect('aanmelden/index');
        }
    }

    /**
     * Toont een overzicht van alle taken en biedt de mogelijkheid deze aan te passen.
     */
    public function index() {
        $data['verantwoordelijke'] = 'Arno Stoop';
        $data['titel'] = 'Taken en shiften beheren';
        $data['functionaliteit'] = "Taken en shiften beheren. Hier kan je als organisator nieuwe taken en shiften toevoegen, verwijderen of aanpassen.";

        if($this->session->has_userdata('actiefPersoneelsfeest')){
            $personeelsfeest = $this->session->userdata("actiefPersoneelsfeest");
        } else{
            $this->load->model("personeelsfeest_model");
            $personeelsfeest = $this->personeelsfeest_model->getLastPersoneelsfeest();
        }

        $this->load->model("dagonderdeel_model");
        $dagonderdelen = $this->dagonderdeel_model->getAllWherePfIdAndLocatieIdIsNull($personeelsfeest->id);
        $data["dagonderdelen"] = $dagonderdelen;

        //Ophalen dagonderdelen waarvan de opties geen taken hebben. Dit is enkel als het dagonderdeel een locatie heeft.
        $data["dagonderdelenDropdown"] = $this->dagonderdeel_model->getAllWherePfIdAndLocatieIdIsNotNull($personeelsfeest->id);

        $dagonderdeelIds = array();
        foreach ($dagonderdelen as $dagonderdeel){
            array_push($dagonderdeelIds, $dagonderdeel->id);
        }

        $this->load->model("optie_model");
        $data["opties"] = $this->optie_model->getAllWhereDagonderdeeidsWithDagonderdelen($dagonderdeelIds);

        $this->load->model("taak_model");
        $data["taken"] = $this->taak_model->getAllWherePfIdWithDagonderdelen_Opties($personeelsfeest->id);

        $this->load->model("locatie_model");
        $data["locaties"] = $this->locatie_model->getAll();

        //Als de pagina herladen wordt omwille van een aanpassing aan een shift, zal hetzelfde ovrezicht van shiften getoond worden.
        if($this->session->has_userdata("taakToClick")){
            $data["taakToClick"] = $this->session->userdata('taakToClick');
            $this->session->unset_userdata("taakToClick");
        }

        $partials = array('hoofding' => 'views_admin/admin_navbar',
            'content' => 'views_admin/TakenEnShiften_beheren/admin_overzicht_TakenShiften',
            'sidenav' => 'views_admin/admin_sidebar',
            'footer' => 'main_footer'
        );
        $this->template->load('main_master', $partials, $data);
    }

    /**
     * Wijzigen van een taak.
     * De indexpagina wordt opnieuw geladen.
     */
    public function taakWijzigen(){
        $taak = $this->newTaak();
        $taak->id = $this->input->post("taakId");
        $taak->naam = $this->input->post("taakNaam");
        $taak->omschrijving = $this->input->post("taakOmschrijving");
        $taak->locatieId = $this->input->post("locatieId");
        $this->load->model("optie_model");
        $taakheeftOptie = $this->input->post("taakHeeftOptie");

        //Bepalen of de taak een bij een optie hoort of rechtstreeks onder een dagonderdeel staat.
        if(isset($taakheeftOptie)){
            //bepalen van het dagonderdeel adhv de gekozen optie.
            //aangezien de optie niet rechtstreeks gekozen kan worden.
            $taak->optieId = $this->input->post("optieId");
            $taak->dagonderdeelId = $this->optie_model->get($taak->optieId)->dagonderdeelId;
//            echo $taak->dagonderdeelId; exit;
        } else{

            $taak->optieId = null;
            $taak->dagonderdeelId = $this->input->post("dagonderdeelId");
        }


        $this->load->model("taak_model");
        $this->taak_model->update($taak);

        redirect("TakenEnShiften_beheren");
    }

    /**
     * Toevoegen van een nieuwe taak.
     */
    public function taakToevoegen(){
        $taak = $this->newTaak();
        $this->load->model("taak_model");
        $this->taak_model->insert($taak);

        redirect("TakenEnShiften_beheren");
    }

    /**
     * Verwijderen van een bepaalde taak.
     * De indexpagina wordt opnieuw geladen.
     * @param $id
     */
    public function taakVerwijderen($id){
        $this->load->model("taak_model");
        $this->taak_model->delete($id);

        redirect("TakenEnShiften_beheren");
    }

    /**
     * Wijzigen van een shift.
     */
    public function shiftWijzigen(){
        $shift = $this->newShift();
        $shift->id = $this->input->post("shiftId");
        $shift->omschrijving = $this->input->post("shiftOmschrijving");
        $shift->beginuur = DateTime::createFromFormat("H:i", $this->input->post("shiftBegin"));
        $shift->einduur = DateTime::createFromFormat("H:i", $this->input->post("shiftEind"));
        $shift->taakid = $this->input->post("shiftTaakId");

        //Geeft aan welke taak er aangeklikt moet worden bij het herladen van de pagina.
        $this->session->set_userdata('taakToClick', $shift->taakid);

        $this->load->model("shift_model");
        $this->shift_model->update($shift);

        redirect("TakenEnShiften_beheren");
    }

    /**
     * Voegt een nieuwe shift toe bij een bepaalde taak.
     * De indexpagina wordt opnieuw geladen.
     * @param $id
     */
    public function shiftToevoegen($id){
        $shift = $this->newShift();
        $shift->taakid = $id;

        //De begintijd en eindtijd komen standaard overeen met de begin-en eindtijd van hun dagonderdeel.
        $this->load->model("taak_model");
        $taak = $this->taak_model->get($id);
        $this->load->model("dagonderdeel_model");
        $dagonderdeel = $this->dagonderdeel_model->get($taak->dagonderdeelId);
        $shift->beginuur = $dagonderdeel->begintijd;
        $shift->einduur = $dagonderdeel->eindtijd;

        $this->load->model("shift_model");
        $this->shift_model->insert($shift);

        //Geeft aan welke taak er aangeklikt moet worden bij het herladen van de pagina.
        $this->session->set_userdata('taakToClick', $id);

        redirect("TakenEnShiften_beheren");
    }

    /**
     * Verwijderen van een bepaalde shift.
     * De indexpagina wordt opnieuw geladen.
     * @param $id
     */
    public function shiftVerwijderen($id){
        $this->load->model("shift_model");
        $shift = $this->shift_model->get($id);
        $this->shift_model->delete($id);

        //Geeft aan welke taak er aangeklikt moet worden bij het herladen van de pagina.
        $this->session->set_userdata('taakToClick', $shift->taakid);

        redirect("TakenEnShiften_beheren");
    }


    /**
     * Geeft een object van de StdClass met de attributen van een taak.
     * @return mixed
     */
    public function newTaak(){
        $taak = new stdClass();
        $taak->id = 0;
        $taak->naam = " ";
        $taak->dagonderdeelId = 1;
        $taak->optieId = 1;
        $taak->omschrijving = " ";
        $taak->locatieId = 1;
        $taak->personeelsfeestId = 2;

        return $taak;
    }

    /**
     * Geeft een object van de StdClass met de attributen van een shift.
     * @return stdClass
     */
    public function newShift(){
        $shift = new stdClass();
        $shift->id = 0;
        $shift->omschrijving = " ";
        $shift->beginuur = new DateTime();
        $shift->einduur = new DateTime();
        $shift->taakid = 1;

        return $shift;
    }


    public function haalAjaxOp_TaakDetails($id){
        $data["taakId"] = $id;
        $this->load->model("shift_model");
        $data["shiften"] = $this->shift_model->getAllWhereTaakid($id);

        $this->load->view("views_admin/TakenEnShiften_beheren/ajax_taakDetails", $data);
    }
}