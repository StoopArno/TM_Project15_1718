
<?php

class Aanmelden extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

    }


    /**
     * Kijkt na of je al aangemeld bent als administrator. Indien dit niet is dan stuurt deze functie
     * je door naar de aanmeldpagina.
     */

    public function index() {
        if(!$this->authex->isAdmin()){
            $data['titel'] = 'Admin - Login';
            $this->load->view('views_admin/admin_login', $data);
        } else {
            $this->home();
        }

    }

    /**
     * Haalt de loginnaam en wachtwoord op, kijkt of dit overeenkomt met de admins in de database.
     * Indien dit overeenkomt meldt hij aan, anders krijg je een error message.
     */
    public function meldAan() {

        $login = $_POST['admin_login'];
        $wachtwoord = $_POST['admin_pass'];

        $admin = $this->authex->meldAan($login, $wachtwoord);

        if($admin == null) {
            $this->session->set_flashdata('error','Onjuist wachtwoord en/of login!');
            redirect(base_url());
        } else {
            $this->home();
        }
    }

    /**
     * Hier kom je terecht als je aangemeld bent.
     * Dit is de homepagina van de administrators.
     */
    public function home() {
        if($this->authex->isAdmin()) {
            $data['verantwoordelijke'] = 'Lindert Van de Poel';

            $data['titel'] ='Homepagina';

            $data['functionaliteit'] = "Geen functionaliteit. Dit is de homepagina.";

            $data['admin'] = $this->authex->getGebruikerInfo();

            $partials = array('hoofding' => 'views_admin/admin_navbar',
                'sidenav' => 'views_admin/admin_sidebar',
                'content' => 'views_admin/home',
                'footer' => 'main_footer');
            $this->template->load('main_master', $partials, $data);

        } else {
            $this->index();
        }
    }

    /**
     * Hier kun je mee afmelden
     */
    public function meldAf() {
        $this->authex->meldAf();
        redirect(base_url());
    }




}



