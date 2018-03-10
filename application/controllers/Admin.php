<?php

class Admin extends CI_Controller
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