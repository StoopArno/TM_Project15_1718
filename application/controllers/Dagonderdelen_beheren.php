<?php

class Dagonderdelen_beheren extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!$this->authex->isAdmin()) {
            redirect('aanmelden/index');
        }

    }

    /**
     * Toont een overzicht van alle dagonderdelen
     */
    public function index(){
        $data['verantwoordelijke'] = 'Arno Stoop';
        $data['titel'] = 'Dagonderdelen beheren';
        $data['functionaliteit'] = "Dagonderdelen beheren. Hier kan je als organisator nieuwe dagonderdelen toevoegen,
        oude verwijderen of aanpassen en hun bijhorende taken te zien krijgen";

        if($this->session->has_userdata('actiefPersoneelsfeest')){
            $personeelsfeest = $this->session->userdata("actiefPersoneelsfeest");
        } else{
            $this->load->model("personeelsfeest_model");
            $personeelsfeest = $this->personeelsfeest_model->getLastPersoneelsfeest();
        }

        $this->load->model("dagonderdeel_model");
        $dagonderdelen = $this->dagonderdeel_model->getAllWherePfidWithLocaties($personeelsfeest->id);

        $this->load->model("locatie_model");
        $locaties = $this->locatie_model->getAll();

        $data["dagonderdelen"] = $dagonderdelen;
        $data["locaties"] = $locaties;

        //Als de pagina herladen wordt omwille van een aanpassing aan een optie, zal hetzelfde overzicht van opties getoond worden.
        if($this->session->has_userdata("dagonderdeelToClick")){
            $data["dagonderdeelToClick"] = $this->session->userdata('dagonderdeelToClick');
            $this->session->unset_userdata("dagonderdeelToClick");
        }

        $partials = array('hoofding' => 'views_admin/admin_navbar',
            'content' => 'views_admin/dagonderdelen_beheren/admin_overzicht_dagonderdelen',
            'sidenav' => 'views_admin/admin_sidebar',
            'footer' => 'main_footer'
        );

        $this->template->load('main_master', $partials, $data);
    }

    /**
     * Wijzigen van een dagonderdeel.
     * De pagina wordt opnieuw geladen.
     */
    public function dagonderdeelWijzigen(){
        $dagonderdeel = $this->newDagonderdeel();
        $dagonderdeel->id = $this->input->post("dagonderdeelid");
        $dagonderdeel->naam = $this->input->post("dagonderdeelNaam");

        $dagonderdeel->begintijd = DateTime::createFromFormat("H:i", $this->input->post("dagonderdeelBegin"));
        $dagonderdeel->eindtijd = DateTime::createFromFormat("H:i", $this->input->post("dagonderdeelEind"));

        $dagonderdeel->begintijd = $dagonderdeel->begintijd->format("Y-m-d G:i:s");
        $dagonderdeel->eindtijd = $dagonderdeel->eindtijd->format("Y-m-d G:i:s");

        $dagonderdeel->personeelsfeestId = $this->input->post("personeelsfeestId");
        if($this->input->post("locatieId") != null){
            $dagonderdeel->locatieId = $this->input->post("locatieId");

        } else{
            $dagonderdeel->locatieId = null;
        }

        $this->load->model("dagonderdeel_model");
        $this->dagonderdeel_model->update($dagonderdeel);

        redirect("Dagonderdelen_beheren");
    }

    /**
     * Toevoegen van een nieuw dagonderdeel.
     * De pagina wordt opnieuw geladen.
     */
    public function dagonderdeelToevoegen(){
        $dagonderdeel = $this->newDagonderdeel();

        if($this->session->has_userdata('actiefPersoneelsfeest')){
            $personeelsfeest = $this->session->userdata("actiefPersoneelsfeest");
        } else{
            $this->load->model("personeelsfeest_model");
            $personeelsfeest = $this->personeelsfeest_model->getLastPersoneelsfeest();
        }

        $dagonderdeel->personeelsfeestId = $personeelsfeest->id;

        $this->load->model("dagonderdeel_model");
        $this->dagonderdeel_model->insert($dagonderdeel);

        redirect("Dagonderdelen_beheren");
    }

    /**
     * Verwijderen van een dagonderdeel.
     * De pagina wordt opnieuw geladen.
     * @param $id
     */
    public function dagonderdeelVerwijderen($id){
        $this->load->model("dagonderdeel_model");
        $this->dagonderdeel_model->delete($id);

        redirect("Dagonderdelen_beheren");
    }

    /**
     * Wijzigen van een dagonderdeel.
     * De pagina wordt opnieuw geladen.
     */
    public function optieWijzigen(){
        $optie = $this->newOptie($this->input->post("optieHeeftLocatie"));
        $optie->id = $this->input->post("optieid");
        $optie->optie = $this->input->post("optieNaam");
        $optie->minAantalInschrijvingen = $this->input->post("minInschrijvingen");
        $optie->maxAantalInschrijvingen = $this->input->post("maxInschrijvingen");
        $optie->dagonderdeelId = $this->input->post("dagonderdeelId");
        if($this->input->post("helper_nodig") == "ja"){
            $optie->helper_nodig = "ja";
        }
        if($this->input->post("personeel_kan_inschrijven") == "ja"){
            $optie->personeel_kan_inschrijven = "ja";
        }
        $locatieId = $this->input->post("optieHeeftLocatie");
        if(isset($locatieId)){
            $optie->locatieId = $this->input->post("locatieId");
        }
        $this->load->model("optie_model");
        $this->optie_model->update($optie);

        //Geeft aan welk dagonderdeel er aangeklikt moet worden bij het herladen van de pagina.
        $this->session->set_userdata("dagonderdeelToClick", $optie->dagonderdeelId);

        redirect("Dagonderdelen_beheren");
    }

    /**
     * Toevoegen van een nieuwe optie.
     * @param $dagonderdeelId Zodat in de view naar het juiste dagonderdeel verwezen kan worden.
     */
    public function optieToevoegen($dagonderdeelId){
        $this->load->model("dagonderdeel_model");
        $dagonderdeel = $this->dagonderdeel_model->get($dagonderdeelId);
        if($dagonderdeel->locatieId == null){
            $optie = $this->newOptie(true);
        } else{
            $optie = $this->newOptie(false);
        }

        $optie->dagonderdeelId = $dagonderdeelId;

        $this->load->model("optie_model");
        $this->optie_model->insert($optie);

        //Geeft aan welk dagonderdeel er aangeklikt moet worden bij het herladen van de pagina.
        $this->session->set_userdata("dagonderdeelToClick", $dagonderdeelId);

        redirect("Dagonderdelen_beheren");

    }

    /**
     * Verwijderen van een optie.
     * @param $id
     */
    public function optieVerwijderen($id){
        $this->load->model("optie_model");
        $optie = $this->optie_model->get($id);
        $this->optie_model->delete($id);

        //Geeft aan welk dagonderdeel er aangeklikt moet worden bij het herladen van de pagina.
        $this->session->set_userdata("dagonderdeelToClick", $optie->dagonderdeelId);

        redirect("Dagonderdelen_beheren");
    }


    /**
     * Geeft een object van de stdClass met de attributen van een dagonderdeel.
     * @return stdClass
     */
    public function newDagonderdeel(){
        $dagonderdeel = new stdClass();

        $dagonderdeel->id = null;
        $dagonderdeel->naam = " ";
        $dagonderdeel->begintijd = DateTime::createFromFormat("H:i", "00:00");
        $dagonderdeel->eindtijd = DateTime::createFromFormat("H:i", "00:00");
        $dagonderdeel->personeelsfeestId = 0;
        $dagonderdeel->locatieId = null;

        return $dagonderdeel;
    }

    /**
     * Geeft een object van de stdClass met de attributen van een optie.
     * @param bool $heeftLocatie
     * @return stdClass
     */
    public function newOptie($heeftLocatie = true){
        $optie = new stdClass();
        $optie->optie = " ";
        $optie->minAantalInschrijvingen = 0;
        $optie->maxAantalInschrijvingen = 1000;
        $optie->dagonderdeelId = 0;
        if($heeftLocatie){
            $optie->locatieId = 1;
        } else{
            $optie->locatieId = null;
        }
        $optie->helper_nodig = "nee";
        $optie->personeel_kan_inschrijven = "nee";

        return $optie;
    }


    /**
     * Return view met de details van een dagonderdeel.
     * View verschilt als de taken aan de shiften gekoppeld zijn of niet.
     * @param $id
     */
    public function haalAjaxOp_dagonderdeelDetails($id){
        $data["dagonderdeelId"] = $id;

        $this->load->model("locatie_model");
        $data["locaties"] = $this->locatie_model->getAll();

        $this->load->model("optie_model");
        $this->load->model("taak_model");

        $data["opties"] = $this->optie_model->getAllWhereDagonderdeelid($id);
        $this->load->view("views_admin/dagonderdelen_beheren/ajax_dagonderdeelDetails", $data);
    }


    /**
     * Toont een JSON object met alle locaties
     */
    public function getLocaties(){
        $this->load->model("locatie_model");
        $locaties = $this->locatie_model->getAll();

        echo json_encode($locaties);
    }

    /**
     * Toont een JSON object met alle dagonderdelen van een bepaald personeelsfeest en waarvan de locatie niet null is.
     */
    public function getDagonderdelenLocatieNotNull(){
        if($this->session->has_userdata('actiefPersoneelsfeest')){
            $personeelsfeest = $this->session->userdata("actiefPersoneelsfeest");
        } else{
            $this->load->model("personeelsfeest_model");
            $personeelsfeest = $this->personeelsfeest_model->getLastPersoneelsfeest();
        }
        $pfId = $personeelsfeest->id;
        $this->load->model("dagonderdeel_model");
        $dagonderdelen = $this->dagonderdeel_model->getAllWherePfIdAndLocatieIdIsNotNull($pfId);

        echo json_encode($dagonderdelen);
    }

    /**
     * Toont een JSON object van alle opties die taken hebben. Maw waarvan het dagonderdeel geen locatieId heeft.
     * De namen van de bijhorende dagonderdelen worden ook weergegeven.
     */
    public function getOptiesWithTaken(){
        if($this->session->has_userdata('actiefPersoneelsfeest')){
            $personeelsfeest = $this->session->userdata("actiefPersoneelsfeest");
        } else{
            $this->load->model("personeelsfeest_model");
            $personeelsfeest = $this->personeelsfeest_model->getLastPersoneelsfeest();
        }
        $pfId = $personeelsfeest->id;

        $this->load->model("dagonderdeel_model");
        $dagonderdelen = $this->dagonderdeel_model->getAllWherePfIdAndLocatieIdIsNull($pfId);
        $dagonderdeelIds = array();
        foreach ($dagonderdelen as $dagonderdeel){
            array_push($dagonderdeelIds, $dagonderdeel->id);
        }

        $this->load->model("optie_model");
        $opties = $this->optie_model->getAllWhereDagonderdeeidsWithDagonderdelen($dagonderdeelIds);

        echo json_encode($opties);
    }

}