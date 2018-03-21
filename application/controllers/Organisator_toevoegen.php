<?php
/**
 * Created by PhpStorm.
 * User: Linde
 * Date: 20/03/2018
 * Time: 17:51
 */

class Organisator_toevoegen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!$this->authex->isAdmin()) {
            redirect('aanmelden/index');
        }

    }

    public function organisatorToevoegen() {
        $data['titel'] = "Aanmelden - Login";
        $data['verantwoordelijke'] = 'Lindert Van de Poel';

        $this->load->model('persoon_model');
        $data['admins'] = $this->persoon_model->getAllAdmin();

        $partials = array('hoofding' => 'views_admin/admin_header',
            'inhoud' => 'views_admin/organisator_toevoegen',
            'footer' => 'main_footer',);
        $this->template->load('main_master', $partials, $data);
    }

    public function voegToe() {
        $this->load->model('persoon_model');
        $naam = $this->input->post('familienaam');
        $voornaam = $this->input->post('voornaam');
        $email = $this->input->post('email');
        $gsm = $this->input->post('gsm');
        $wachtwoord = $this->input->post('wachtwoord');
        $this->persoon_model->organisatorToevoegen($naam, $voornaam, $email, $gsm, $wachtwoord);
        redirect('organisator_toevoegen/organisatorToevoegen');
    }

    public function verwijderOrganisator($id) {
        $this->load->model('persoon_model');
        $this->persoon_model->verwijder($id);
        $this->organisatorToevoegen();

    }
}