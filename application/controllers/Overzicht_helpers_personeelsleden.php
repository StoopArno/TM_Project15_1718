
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
     $zoekstring = $this->input->get('filter');




     $data['admin'] = $this->authex->getGebruikerInfo();
     $this->load->model('optie_model');
     $data['opties'] = $this->optie_model->getAllOptiesWithDagonderdeel();
     $this->load->model('persoon_model');
     $data['personeelsleden'] = $this->persoon_model->getAllPersoneelsleden($zoekstring);
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
    public function voegPersoneelslidToe(){


        $this->load->model('persoon_model');
        $naam = $this->input->post('familienaam');
        $voornaam = $this->input->post('voornaam');
        $email = $this->input->post('email');
        $gsm = $this->input->post('gsm');

        $this->persoon_model->personeelslidToevoegen($naam, $voornaam, $email, $gsm);
     $this->index();



    }
    public function  filter($id =null){
        $data['titel'] = "Overzicht helpers en personeelsleden";
        $data['verantwoordelijke'] = 'Sander Philipsen';
        $data['functionaliteit'] = "Overzicht helpers en personeelsleden";
        $id=1;

        $data['admin'] = $this->authex->getGebruikerInfo();
        $this->load->model('optie_model');
        $data['opties'] = $this->optie_model->getAllOptiesWithDagonderdeel();
        $this->load->model('persoon_model');
        $data['personeelsleden'] = $this->persoon_model->getAllPersoneelsledenWhereOptieId($id);
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


}