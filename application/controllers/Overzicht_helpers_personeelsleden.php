<?php
class Overzicht_helpers_personeelsleden extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
    }



    public function index($id=null){

        $data['titel'] = "Overzicht helpers en personeelsleden";
        $data['verantwoordelijke'] = 'Sander Philipsen';
        $data['functionaliteit'] = "Overzicht helpers en personeelsleden";
        $zoekstring = null;
        $data['admin'] = $this->authex->getGebruikerInfo();

        $this->load->model('optie_model');
        $this->load->model('shift_model');
        $data['shifturen'] = $this->shift_model->getAllShiftUren();
        $data['opties'] = $this->optie_model->getAllOptiesWithDagonderdeel();
        $this->load->model('persoon_model');
        $this->load->model('taak_model');
        $this->load->model('shiftinschrijving_model');
        $data['inschrijvingenshiften'] = $this->taak_model->getAllwithshiften();
        $data['shiftinschrijvingen'] = $this->shiftinschrijving_model->getAllinschrijvingen();
        $data['personeelsleden'] = $this->persoon_model->getAllPersoneelsleden($zoekstring);

        $data['helpers'] = $this->persoon_model->getAllHelpers();
        if ($id != null){
            $data['lid'] = $this->persoon_model->getpersoneelslid($id);
        }
        else{
            $data['lid'] = "";
        }
        $this->load->model('dagonderdeel_model');
        $data['dagonderdelen'] = $this->dagonderdeel_model->getAllByBegintijdWithOpties();
        $this->load->model('tekst_model');
        $data['tekst'] = $this->tekst_model->getByNaam('Overzicht helpers en personeel');
        $partials = array('hoofding' => 'views_admin/admin_navbar',
            'sidenav' => 'views_admin/admin_sidebar',
            'content' => 'views_admin/admin_overzicht_helpers_personeel',
            'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);

    }


 public function verwijderPersoneelslid($id){

     $this->load->model('persoon_model');
     $this->persoon_model->verwijder($id);

     $this->index();

 }
    public function verwijderHelper($id){

        $this->load->model('persoon_model');
        $this->persoon_model->verwijder($id);

        $this->index();

    }
    public function voegPersoneelslidToe(){

        $this->load->model('persoon_model');
        $naam = $this->input->post('familienaam');
        $this->load->model('optie_model');
        $voornaam = $this->input->post('voornaam');
        $email = $this->input->post('email');
        $gsm = $this->input->post('gsm');
        $this->persoon_model->personeelslidToevoegen($naam, $voornaam, $email, $gsm);
        $persoon = $this->persoon_model->getByNaam($naam,$voornaam);
        $persoonid = $persoon->id;
        $this->load->model('inschrijving_model');

        $inschrijvingen = $this->input->post('inschrijvingen');
            if ($inschrijvingen != null) {


                foreach ($inschrijvingen as $inschrijving) {

                    $optieid = $inschrijving;
                    $this->inschrijving_model->schrijfIn($persoonid, $optieid);
                }
            }

                redirect("/overzicht_helpers_personeelsleden/index");
    }



public function voegHelperToe(){

    $naam = $this->input->post('familienaam');

    $voornaam = $this->input->post('voornaam');
    $email = $this->input->post('email');
    $gsm = $this->input->post('gsm');
    $this->load->model('persoon_model');
    $inschrijvingen = $this->input->post('inschrijvingenhelper');
    $this->persoon_model->helperToevoegen($naam, $voornaam, $email, $gsm);
    $this->load->model('shiftinschrijving_model');
    $persoon = $this->persoon_model->getByNaam($naam,$voornaam);
    $persoonid = $persoon->id;
    if ($inschrijvingen != null) {
        foreach ($inschrijvingen as $inschrijving) {

            $this->shiftinschrijving_model->schrijfIn($persoonid, $inschrijving);
        }
    }





    redirect("/overzicht_helpers_personeelsleden/index");
}
public function editPersoneelslid($personeelslidid){
    $data['titel'] = "Overzicht helpers en personeelsleden";
    $data['verantwoordelijke'] = 'Sander Philipsen';
    $data['functionaliteit'] = "Overzicht helpers en personeelsleden";
    $this->load->model('persoon_model');
    $data['persoon'] = $this->persoon_model->getByIdWithInschrijvingen($personeelslidid);

    $partials = array('hoofding' => 'views_admin/admin_navbar',
        'sidenav' => 'views_admin/admin_sidebar',
        'content' => 'views_admin/admin_wijzig_persoon',
        'footer' => 'main_footer');
    $this->template->load('main_master', $partials, $data);

}
    public function persoon($personeelslidid){
        $data['titel'] = "Overzicht helpers en personeelsleden";
        $data['verantwoordelijke'] = 'Sander Philipsen';
        $data['functionaliteit'] = "Overzicht helpers en personeelsleden";
        $this->load->model('persoon_model');
        $data['persoon'] = $this->persoon_model->getByIdWithInschrijvingen($personeelslidid);
        $this->load->model('inschrijving_model');
        $data['inschrijvingen'] = $this->inschrijving_model->getAllByPersoonId($personeelslidid);
        $partials = array('hoofding' => 'views_admin/admin_navbar',
            'sidenav' => 'views_admin/admin_sidebar',
            'content' => 'views_admin/admin_wijzig_persoon',
            'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);

    }
    public function wijzigpersoon(){
        $id = $this->input->post('id');
        $naam = $this->input->post('familienaam');
        $voornaam = $this->input->post('voornaam');
        $email = $this->input->post('email');
        $gsm = $this->input->post('gsm');
        $this->load->model('persoon_model');


        $data['persoon'] = $this->persoon_model->updatePersoon($id,$voornaam,$naam,$email,$gsm);



        redirect("/overzicht_helpers_personeelsleden/index");
    }


}