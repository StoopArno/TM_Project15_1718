
<?php

class Aanmelden extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    public function index() {
        if(!$this->authex->isAdmin()){
            $data['titel'] = 'Admin - Login';
            $this->load->view('views_admin/admin_login', $data);
        } else {
            $this->home();
        }

    }

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

    public function home() {
        if($this->authex->isAdmin()) {
            $data['verantwoordelijke'] = 'Lindert Van de Poel & Arno Stoop';
            $data['titel'] ='Homepagina';
            $data['functionaliteit'] = "Geen functionaliteit. Dit is de homepagina.";

            $data['admin'] = $this->authex->getGebruikerInfo();

            $this->load->model('personeelsfeest_model');
            if($this->session->has_userdata('actiefPersoneelsfeest')){
                $actiefPersoneelsfeest = $this->session->userdata('actiefPersoneelsfeest');
            } else{
                $actiefPersoneelsfeest = $this->personeelsfeest_model->getLastPersoneelsfeest();
            }
            $data["actiefPersoneelsfeest"] = $actiefPersoneelsfeest;

            $feesten = $this->personeelsfeest_model->getAllOrderByDatum();
            $data['feesten'] = $feesten;

            $partials = array('hoofding' => 'views_admin/admin_navbar',
                'sidenav' => 'views_admin/admin_sidebar',
                'content' => 'views_admin/home',
                'footer' => 'main_footer');
            $this->template->load('main_master', $partials, $data);

        } else {
            $this->index();
        }
    }

    public function meldAf() {
        $this->authex->meldAf();
        redirect(base_url());
    }

    public function VeranderPersoneeelsfeest(){
        $pfId = $this->input->post('feestId');
        $this->load->model('personeelsfeest_model');
        $personeelsfeest = $this->personeelsfeest_model->get($pfId);
        $this->session->set_userdata('actiefPersoneelsfeest', $personeelsfeest);
        redirect(base_url() . "index.php/Aanmelden");
    }




}



