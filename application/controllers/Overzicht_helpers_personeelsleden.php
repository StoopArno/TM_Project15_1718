<?php
/**
 * Created by PhpStorm.
 * User: sande
 * Date: 23/03/2018
 * Time: 11:21
 */

class Overzicht_helpers_personeelsleden extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();

    }

 public function index(){

     $data['titel'] = "Overzicht helpers en personeelsleden";
     $data['verantwoordelijke'] = 'Sander Philipsen';
     $data['functionaliteit'] = "Overzicht helpers en personeelsleden";

     $data['admin'] = $this->authex->getGebruikerInfo();

     $this->load->model('persoon_model');
     $data['personeelsleden'] = $this->persoon_model->getAllPersoneelsleden();
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