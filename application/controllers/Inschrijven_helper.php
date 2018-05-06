git <?php

class Inschrijven_helper extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /*
     *  Testen zonder email:
     *  index:
     *  http://localhost:81/project15_1718/index.php/inschrijven_helper/index/fe751ada57b4dc95db43d67fa430d7e8
     * http://localhost:81/project15_1718/index.php/inschrijven_helper/inschrijfPagina/30ba315b4ffb9f3431b38b94cec1ac7c
     *  schrijfIn:
     *  http://localhost:81/project15_1718/index.php/inschrijven_helper/schrijfIn/.../fe751ada57b4dc95db43d67fa430d7e8
     *  Helper 1
     */

    public function index($hashcode) {
         $helper = $this->getPersoon($hashcode);
         $data['helper'] = $helper;
         $this->load->model('tekst_model');
         $data['tekst'] = $this->tekst_model->getByNaam('home_helper');
         $data['titel'] = "Homepagina helper inschrijven";
         $data['verantwoordelijke'] = 'Lindert Van de Poel';
         $data['functionaliteit'] = "Als de helper de link van de email volgt komt hij op deze startpagina terecht.";

        $partials = array('hoofding' => 'views_helper/helper_navbar',
            'content' => 'views_helper/home',
            'footer' => 'views_helper/template_helper/main_footer');
        $this->template->load('views_helper/template_helper/main_master', $partials, $data);
    }

    public function inschrijfPagina($hashcode) {

        $helper = $this->getPersoon($hashcode);
        $data['helper'] = $helper;
        $this->load->model('shiftinschrijving_model');
        $inschrijvingen = $this->shiftinschrijving_model->getInschrijvingPersoon($helper->id);

        $this->load->model('shift_model');
        if($inschrijvingen != null) {
            foreach($inschrijvingen as $inschrijving) {
                $inschrijving->shift = $this->shift_model->get($inschrijving->shiftid);
                /*echo $inschrijving->shift->omschrijving;*/
            }
        }
        $data['ingeschreven'] = $inschrijvingen;
            $this->load->model('personeelsfeest_model');
        $personeelsfeest = $this->personeelsfeest_model->getAllOrderByDatum();
        $personeelsfeestId = $personeelsfeest[0]->id;
        $this->load->model('dagonderdeel_model');
        $this->load->model('optie_model');
        $dagonderdelen = $this->dagonderdeel_model->getAllWherePfid($personeelsfeestId);
        $this->load->model('taak_model');
        foreach($dagonderdelen as $dag) {
            $dag->opties = $this->optie_model->getAllWhereDagonderdeelid($dag->id);
            foreach($dag->opties as $dagOptie) {
                $dagOptie->taken = $this->taak_model->getAllByOptieId($dagOptie->id);
                foreach($dagOptie->taken as $dagOptieTaak) {
                    $dagOptieTaak->shiften = $this->shift_model->getAllWhereTaakid($dagOptieTaak->id);
                }
            }

        }
        $data['dagonderdelen'] =  $dagonderdelen;

        $data['titel'] = "Helper inschrijven";
        $data['verantwoordelijke'] = 'Lindert Van de Poel';
        $data['functionaliteit'] = "Hier kan de helper zich hier inschrijven om te komen helpen.";

        $partials = array('hoofding' => 'views_helper/helper_navbar',
            'content' => 'views_helper/helper_inschrijfpagina',
            'footer' => 'views_helper/template_helper/main_footer');
        $this->template->load('views_helper/template_helper/main_master', $partials, $data);
    }

    public function schrijfIn($shiftId, $hashcode) {
        $this->load->model('shift_model');
        $this->load->model('shiftinschrijving_model');
        $shift = $this->shift_model->get($shiftId);
        $persoon = $this->getPersoon($hashcode);
        if($shift->aantalHelpers == $shift->maxAantalHelpers) {
                /*     HIER MOET NOG IETS KOMEN  */
        } else {
            if($this->shiftinschrijving_model->bestaatOfNiet($persoon->id, $shiftId) == null) {

                $persoonId = $persoon->id;
                $this->shiftinschrijving_model->schrijfIn($persoonId, $shiftId);
                $this->load->model('shift_model');
                $this->shift_model->updateHelperAantal($shiftId);
            } else {
                /* HIER MOET NOG IETS KOMEN */
            }

        }

        redirect('inschrijven_helper/inschrijfPagina/' . $hashcode);
    }

    public function schrijfUit($shiftId, $hashcode) {
        $this->load->model('shift_model');
        $shift = $this->shift_model->get($shiftId);
        if($shift->aantalHelpers == 0) {
            /* HIER MOET NOG IETS KOMEN */
        } else {
            $persoon = $this->getPersoon($hashcode);
            $persoonId = $persoon->id;
            $this->load->model('shiftinschrijving_model');
            $this->shiftinschrijving_model->schrijfUit($persoonId, $shiftId);
            $this->shift_model->updateHelperAantalMin($shiftId);
        }

        redirect('inschrijven_helper/inschrijfPagina/' . $hashcode);
    }

    public function getPersoon($hashcode) {
        $this->load->model('persoon_model');
        return $this->persoon_model->getPersoon($hashcode);
    }

    public function haalHelpersOp() {

        $shiftId = $this->input->get('shiftId');
        $this->load->model('shift_model');
        $shift = $this->shift_model->get($shiftId);
        $data['shift'] = $shift;
        $this->load->model('shiftinschrijving_model');
        $shiftInschrijvingen = $this->shiftinschrijving_model->getAllInschrijvingenWhereShiftId($shiftId); // geeft persoonids

        $this->load->model('persoon_model');
        foreach($shiftInschrijvingen as $SI) {
            $SI->persoon = $this->persoon_model->get($SI->persoonid);
        }

        $data['shiftInschrijvingen'] = $shiftInschrijvingen;
        $this->load->view('views_helper/helperDialog', $data);
    }

    public function fotoPagina($hashcode) {
        $helper = $this->getPersoon($hashcode);
        $data['helper'] = $helper;
        $this->load->model("foto_model");
        $this->load->model('personeelsfeest_model');
        $personeelsfeesten = $this->personeelsfeest_model->getAllOrderByDatum();
        $data['personeelsfeesten'] = $personeelsfeesten;
        $data['personeelsfeestId'] = $personeelsfeesten[0]->id;
        $data["fotos"] = $this->foto_model->getAllWherePfId($personeelsfeesten[0]->id);

        $data['titel'] = "Foto's voorbije personeelsfeesten";
        $data['verantwoordelijke'] = 'Lindert Van de Poel';
        $data['functionaliteit'] = "Haal leuke herinneringen op en bekijk enkele foto's van voorbije jaren.";

        $partials = array('hoofding' => 'views_helper/helper_navbar',
            'content' => 'views_helper/helper_fotos_raadplegen',
            'footer' => 'views_helper/template_helper/main_footer');
        $this->template->load('views_helper/template_helper/main_master', $partials, $data);
    }

    public function haalFotosOp($hashcode, $personeelsfeestId) {
        $helper = $this->getPersoon($hashcode);
        $data['helper'] = $helper;
        $this->load->model("foto_model");
        $this->load->model('personeelsfeest_model');
        $personeelsfeesten = $this->personeelsfeest_model->getAllOrderByDatum();
        $data['personeelsfeesten'] = $personeelsfeesten;
        $data["fotos"] = $this->foto_model->getAllWherePfId($personeelsfeestId);

        $data['titel'] = "Foto's voorbije personeelsfeesten";
        $data['verantwoordelijke'] = 'Lindert Van de Poel';
        $data['functionaliteit'] = "Haal leuke herinneringen op en bekijk enkele foto's van voorbije jaren.";

        $partials = array('hoofding' => 'views_helper/helper_navbar',
            'content' => 'views_helper/helper_fotos_raadplegen',
            'footer' => 'views_helper/template_helper/main_footer');
        $this->template->load('views_helper/template_helper/main_master', $partials, $data);

    }

    public function faq($hashcode) {
        $helper = $this->getPersoon($hashcode);
        $data['helper'] = $helper;

        $data['titel'] = "Frequently Asked Questions";
        $data['verantwoordelijke'] = 'Dean Clerckx';
        $data['functionaliteit'] = "Hier geeft men een antwoord op enkele vragen die voor de hand liggend zijn..";

        $partials = array('hoofding' => 'views_helper/helper_navbar',
            'content' => 'views_helper/faq_helper',
            'footer' => 'views_helper/template_helper/main_footer');
        $this->template->load('views_helper/template_helper/main_master', $partials, $data);
    }
}