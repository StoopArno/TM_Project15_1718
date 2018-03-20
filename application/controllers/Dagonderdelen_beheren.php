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

    public function overzichtDagonderdelen(){
        $data['verantwoordelijke'] = 'Arno Stoop';

        $this->load->model("dagonderdeel_model");
        $data["dagonderdelen"] = $this->dagonderdeel_model->getAllWherePersoneelsfeestIdWithOpties(2);

        $partials = array('hoofding' => 'views_admin/admin_header',
            'inhoud' => 'views_admin/admin_overzicht_dagonderdelen',
            'footer' => 'main_footer'
        );

        $this->template->load('main_master', $partials, $data);
    }
}