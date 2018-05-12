<?php

class Helpers_personeelsleden_toevoegen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * De pagina waar je helpers & personeelsleden kunt toevoegen.
     */
    public function index()
    {
        $data['titel'] = "Helpers & personeelsleden toevoegen";
        $data['verantwoordelijke'] = 'Lindert Van de Poel';
        $data['functionaliteit'] = "Hier kan men de helpers toevoegen die het personeelsfeest in goede banen moeten leiden.
        De personeelsleden kan men hier ook toevoegen.";

        $partials = array('hoofding' => 'views_admin/admin_navbar',
            'sidenav' => 'views_admin/admin_sidebar',
            'content' => 'views_admin/helpers_personeelsleden_toevoegen',
            'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    /**
     * De functie om personeelsleden toe te voegen.
     */

    public function personeelslidToevoegen() {
        $this->load->model('persoon_model');
        $naam = $this->input->post('familienaam');
        $voornaam = $this->input->post('voornaam');
        $email = $this->input->post('email');
        $gsm = $this->input->post('gsm');
        $hashcode = $this->getHash(50);
        $this->persoon_model->helperToevoegen($naam, $voornaam, $email, $gsm, $hashcode);
        redirect('helpers_personeelsleden_toevoegen/index');
    }

    /**
     * De functie om helpers toe te voegen.
     */

    public function helperToevoegen() {
        $this->load->model('persoon_model');
        $naam = $this->input->post('familienaam');
        $voornaam = $this->input->post('voornaam');
        $email = $this->input->post('email');
        $gsm = $this->input->post('gsm');
        $hashcode = $this->getHash(50);
        $this->persoon_model->personeelslidToevoegen($naam, $voornaam, $email, $gsm, $hashcode);
        redirect('helpers_personeelsleden_toevoegen/index');
    }

    /**
     * Deze functie geeft een hashcode mee aan de controller (en later model).
     * Hiermee weet de applicatie welke helper/organisator/personeelslid er aangemeld is.
     * @param $len
     * @return bool|string
     */

    public function getHash($len) {
        return substr(md5(openssl_random_pseudo_bytes(20)), -$len);
    }
}