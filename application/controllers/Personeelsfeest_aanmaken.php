<?php
/**
 * Created by PhpStorm.
 * User: Linde
 * Date: 22/03/2018
 * Time: 18:35
 */

class Personeelsfeest_aanmaken extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!$this->authex->isAdmin()) {
            redirect('aanmelden/index');
        }
    }

    public function index() {
        $data['titel'] = "Personeelsfeest aanmaken";
        $data['verantwoordelijke'] = 'Lindert Van de Poel';
        $data['functionaliteit'] = "Personeelsfeest aanmaken (in de analysefase organisator toevoegen). Hier kan je als
        organisator/admin een personeelsfeest aanmaken";

        $this->load->model('personeelsfeest_model');
        $data["personeelsfeesten"] = $this->personeelsfeest_model->getPersoneelsfeesten();


        $partials = array('hoofding' => 'views_admin/admin_navbar',
            'sidenav' => 'views_admin/admin_sidebar',
            'content' => 'views_admin/admin_personeelsfeest_aanmaken',
            'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function maakAan() {
        $datePersoneelsfeest = zetOmNaarYYYYMMDD($_POST["personeelsfeestDate"]);
        $this->load->model('personeelsfeest_model');
        $this->personeelsfeest_model->maakPersoneelsfeest($datePersoneelsfeest);
        redirect('personeelsfeest_aanmaken/index');
    }

    public function verwijder($id) {
        $this->load->model('personeelsfeest_model');
        $this->personeelsfeest_model->delete($id);
        redirect('personeelsfeest_aanmaken/index');
    }

}
