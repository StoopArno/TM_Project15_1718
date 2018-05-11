<?php
/**
 * Created by PhpStorm.
 * User: Linde
 * Date: 22/03/2018
 * Time: 0:52
 */

class teksten_aanpassen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!$this->authex->isAdmin()) {
            redirect('aanmelden/index');
        }
    }

    /**
     * Deze functie brengt je naar de pagina om teksten aan te passen. Deze teksten zijn de teksten die de personeelsleden en helpers
     * te zien krijgen als ze via de inschrijflink naar de applicatie gaan.
     */
    public function index() {
        $data['verantwoordelijke'] = "Lindert Van de Poel";
        $data['titel'] = "Teksten aanpassen";
        $data['functionaliteit'] = "Teksten aanpassen. Hier kan de organisator de teksten aanpassen die op de applicatie
        zichtbaar zijn voor de helpers en/of personeelsleden.";
        $this->load->model('tekst_model');
        $data['teksten'] = $this->tekst_model->getTeksten();


        $partials = array('hoofding' => 'views_admin/admin_navbar',
            'sidenav' => 'views_admin/admin_sidebar',
            'content' => 'views_admin/admin_teksten_aanpassen',
            'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    /**
     * Deze functie past de tekst effectief aan in de database.
     * @param $id
     */
    public function pasTekstAan($id) {
        $omschrijving = $this->input->post($id);

        $this->load->model('tekst_model');
        $this->tekst_model->pasTekstAan($id, $omschrijving);

        redirect('teksten_aanpassen/index');

    }
}