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
        $data['verantwoordelijke'] = 'Dean Clerckx';
        $data['functionaliteit'] = "Personeelsfeest aanmaken (in de analysefase organisator toevoegen). Hier kan je als
        organisator/admin een personeelsfeest aanmaken";

        

        $partials = array('hoofding' => 'views_admin/admin_navbar',
            'sidenav' => 'views_admin/admin_sidebar',
            'content' => 'views_admin/admin_personeelsfeest_aanmaken',
            'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
}