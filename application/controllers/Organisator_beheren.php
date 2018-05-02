<?php
/**
 * Created by PhpStorm.
 * User: Linde
 * Date: 20/03/2018
 * Time: 17:51
 */

class Organisator_beheren extends CI_Controller
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
        $data['functionaliteit'] = "Organisatoren beheren (in de analysefase organisator toevoegen). Hier kan je als
        organisator/admin een extra admin toevoegen en/of verwijderen. Je kan hier ook de nodige info raadplegen";

        $this->load->model('persoon_model');
        $data['admins'] = $this->persoon_model->getAllAdmin();

        $partials = array('hoofding' => 'views_admin/admin_navbar',
            'sidenav' => 'views_admin/admin_sidebar',
            'content' => 'views_admin/admin_organisator_beheren',
            'footer' => 'main_footer');
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
        redirect('organisator_beheren/organisatorToevoegen');
    }

    public function verwijderOrganisator($id) {
        $this->load->model('persoon_model');
        $this->persoon_model->verwijder($id);
        $this->organisatorToevoegen();
    }
}