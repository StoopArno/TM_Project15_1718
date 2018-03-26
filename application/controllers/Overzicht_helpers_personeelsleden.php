



<?php

class Overzicht_helpers_personeelsleden extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();

    }

 public function index($filter =null){
    if( $filter== null){
    $data['titel'] = "Overzicht helpers en personeelsleden";
    $data['verantwoordelijke'] = 'Sander Philipsen';
    $this->load->model('persoon_model');
    $data['personeelsleden'] = $this->persoon_model->getAllPersoneelsleden();
    $this->load->model('dagonderdeel_model');
    $data['dagonderdelen'] = $this->dagonderdeel_model->getAllByBegintijdWithOpties();
    $this->load->model('tekst_model');
    $data['tekst'] = $this->tekst_model->getByNaam('Overzicht helpers en personeel');
}
else{

}

     $partials = array('hoofding' => 'views_admin/admin_navbar',
         'sidenav' => 'views_admin/admin_sidebar',
         'content' => 'views_admin/admin_overzicht_helpers_personeel',
         'footer' => 'main_footer',);
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

}