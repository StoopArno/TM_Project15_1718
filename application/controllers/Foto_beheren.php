<?php

class Foto_beheren extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!$this->authex->isAdmin()) {
            redirect('aanmelden/index');
        }
    }

    /**
     * Toont een overzicht van alle jaren met de bijhorende foto's.
     * Er is ook de optie een foto toe te voegen of te verwijderen.
     */
    public function index(){
        $data["titel"] = "Foto's beheren";
        $data["verantwoordelijke"] = "Arno Stoop";
        $data["functionaliteit"] = "Fotos beheren. Hier kan je de foto's beheren die iedereneen te zien krijgt.";

        $this->load->model("personeelsfeest_model");
        $data["personeelsfeesten"] = $this->personeelsfeest_model->getAllOrderByDatum();

        if($this->session->has_userdata("jaarIdToClick")){
            $data["jaarIdToClick"] = $this->session->userdata("jaarIdToClick");
        } else{
            $data["jaarIdToClick"] = $this->personeelsfeest_model->getLastPersoneelsfeest()->id;
        }

        $partials = array('hoofding' => 'views_admin/admin_navbar',
            'content' => 'views_admin/fotos_beheren/admin_fotos_beheren',
            'sidenav' => 'views_admin/admin_sidebar',
            'footer' => 'main_footer'
        );

        $this->template->load('main_master', $partials, $data);
    }

    /**
     * Geeft een object van StdClass terug met de eigenschappen van een foto.
     * @return stdClass
     */
    public function newFoto(){
        $foto = new stdClass();
        $foto->fotonaam = "";
        $foto->personeelsfeestid = null;
        return $foto;
    }

    /**
     * Toevoegen van een nieuwe foto.
     * Alle details van de foto worden via POST en FILES opgehaald.
     * In de sessie wordt het jaar gezet waartoe de foto behoort zodat dit jaar bij het herladen aangeklikt kan worden.
     */
    public function fotoToevoegen(){
        $pfId = $this->input->post('personeelsfeestId');
        $this->session->set_userdata("jaarIdToClick", $pfId);

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userImage'))
        {
            $error = array('error' => $this->upload->display_errors());
            echo var_dump($error);

            exit;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());

            $this->load->helper('My_html_helper');
            $foto = $this->newFoto();
            $foto->personeelsfeestid = $pfId;
            $foto->fotonaam = str_replace(' ', '_', $_FILES['userImage']['name']);


            $this->load->model("Foto_model");
            $this->Foto_model->insert($foto);

            redirect('foto_beheren');
        }



    }

    /**
     * Verwijderen van een bepaalde foto.
     * In de sessie wordt het jaar gezet waartoe de foto behoorde zodat dit jaar bij het herladen aangeklikt kan worden.
     * @param $id
     */
    public function fotoVerwijderen($id){
        $this->load->model('foto_model');
        $foto = $this->foto_model->get($id);
        $this->session->set_userdata("jaarIdToClick", $foto->personeelsfeestid);
        $this->foto_model->delete($id);

        redirect('Foto_beheren');
    }

    /**
     * Returned de view van een bepaald jaar.
     * @param $id
     */
    public function haalAjaxOp_Foto($id){
        $this->load->model("foto_model");
        $fotos = $this->foto_model->getAllWherePfId($id);
        $data["fotos"] = $fotos;
        $data["personeelsfeestId"] = $id;

        $this->load->view("views_admin/fotos_beheren/ajax_foto_specifiekJaar", $data);
    }
}