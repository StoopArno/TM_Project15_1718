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

        $this->load->model("personeelsfeest_model");
        $personeelsfeest = $this->personeelsfeest_model->getLastPersoneelsfeest();

        $this->load->model("dagonderdeel_model");
        $dagonderdelen = $this->dagonderdeel_model->getAllWherePfidWithLocaties($personeelsfeest->id);

        $data["dagonderdelen"] = $dagonderdelen;

        $partials = array('hoofding' => 'views_admin/admin_header',
            'inhoud' => 'views_admin/admin_overzicht_dagonderdelen',
            'footer' => 'main_footer'
        );

        $this->template->load('main_master', $partials, $data);
    }


}