<?php
/**
 * Created by PhpStorm.
 * User: Linde
 * Date: 20/03/2018
 * Time: 17:53
 */

class Dagonderdelen_beheren extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

    }


    /**
     * Toont een overzicht van alle dagonderdelen
     */

    public function index(){
        $data['verantwoordelijke'] = 'Arno Stoop';
        $data['titel'] = 'Dagonderdelen beheren';
        $data['functionaliteit'] = "Dagonderdelen beheren. Hier kan je als organisator nieuwe dagonderdelen toevoegen,
        oude verwijderen of aanpassen en hun bijhorende taken te zien krijgen";

        $this->load->model("personeelsfeest_model");
        $personeelsfeest = $this->personeelsfeest_model->getLastPersoneelsfeest();

        $this->load->model("dagonderdeel_model");
        $dagonderdelen = $this->dagonderdeel_model->getAllWherePfidWithLocaties($personeelsfeest->id);

        $data["dagonderdelen"] = $dagonderdelen;

        $partials = array('hoofding' => 'views_admin/admin_navbar',
            'content' => 'views_admin/admin_overzicht_dagonderdelen',
            'sidenav' => 'views_admin/admin_sidebar',
            'footer' => 'main_footer'
        );

        $this->template->load('main_master', $partials, $data);
    }


}