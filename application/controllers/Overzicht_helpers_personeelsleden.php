<?php
/**
 * @class Overzicht_helpers_personeelsleden
 * @brief Controller-klasse voor Overzicht_helpers_personeelsleden.
 *
 * Controller-klasse met alle methoden i.v.m. het beheren van personeelsleden en helpers .
 */
class Overzicht_helpers_personeelsleden extends CI_Controller
{


    public function __construct()
    {
        /**
         * Beheer helpers en personeelsleden constructor.
         */
        parent::__construct();

        $this->load->helper('form');
    }

    /**
     * Toont een overzicht van alle personeelsleden waarvoor ze zijn ingeschreven en een overzicht van alle werknemers die komen helpen.
     * @param $id
     * @see Shift_model::getAllShiften()
     * @see Shift_model::getAllShiftUren()
     * @see Optie_model::getAllOptiesWithDagonderdeel()
     * @see Persoon_model::getAllPersoneelsleden($zoekstring)
     * @see Persoon_model::getAllHelpers()
     * @see Dagonderdeel_model::getAllByBegintijdWithOpties()
     * @see Tekst_model::getByNaam()
     */

    public function index()
    {

        $data['titel'] = "Overzicht helpers en personeelsleden";
        $data['verantwoordelijke'] = 'Sander Philipsen';
        $data['functionaliteit'] = "Overzicht helpers en personeelsleden";
        $zoekstring = null;
        $data['admin'] = $this->authex->getGebruikerInfo();

        $this->load->model('optie_model');
        $this->load->model('shift_model');
        $this->load->model('shiftinschrijving_model');
        $data['shifturen'] = $this->shift_model->getAllShiftUren();
        $data['shiften'] = $this->shift_model->getAllShiften();
        $data['opties'] = $this->optie_model->getAllOptiesWithDagonderdeel();
        $data['shiftinschrijvingen'] = $this->shiftinschrijving_model->getAllinschrijvingen();
        $this->load->model('persoon_model');
        $this->load->model('taak_model');


        $data['personeelsleden'] = $this->persoon_model->getAllPersoneelsleden($zoekstring);

        $data['helpers'] = $this->persoon_model->getAllHelpers();

        $this->load->model('dagonderdeel_model');
        $data['dagonderdelen'] = $this->dagonderdeel_model->getAllByBegintijdWithOpties();
        $this->load->model('tekst_model');
        $data['tekst'] = $this->tekst_model->getByNaam('Overzicht helpers en personeel');
        $partials = array('hoofding' => 'views_admin/admin_navbar',
            'sidenav' => 'views_admin/admin_sidebar',
            'content' => 'views_admin/admin_overzicht_helpers_personeel',
            'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);

    }

    /**
     *verwijderd een personeelslid
     * @param $id
     * @see Persoon_model::verwijder($id)
     */

    public function verwijderPersoneelslid($id)
    {

        $this->load->model('persoon_model');
        $this->persoon_model->verwijder($id);

        $this->index();

    }

    /**
     *verwijderd een Helper
     * @param $id
     * @see Persoon_model::verwijder($id)
     */

    public function verwijderHelper($id)
    {

        $this->load->model('persoon_model');
        $this->persoon_model->verwijder($id);

        $this->index();

    }

    /**
     *Voegt een personeelslid toe met bijhorende inschrijvingen
     * @see Persoon_model::personeelslidToevoegen()
     * @see Persoon_model::getByNaam();
     * @see Inschrijving_model::schrijfIn();
     */
    public function voegPersoneelslidToe()
    {


        $this->load->model('persoon_model');
        $naam = $this->input->post('familienaam');
        $this->load->model('optie_model');
        $voornaam = $this->input->post('voornaam');
        $email = $this->input->post('email');
        $gsm = $this->input->post('gsm');
        $hashcode = "test";
        $this->persoon_model->personeelslidToevoegen($naam, $voornaam, $email, $gsm, $hashcode);
        $persoon = $this->persoon_model->getByNaam($naam, $voornaam);
        $persoonid = $persoon->id;
        $this->load->model('inschrijving_model');

        $inschrijvingen = $this->input->post('inschrijvingen');
        if ($inschrijvingen != null) {


            foreach ($inschrijvingen as $inschrijving) {

                $optieid = $inschrijving;
                $this->inschrijving_model->schrijfIn($persoonid, $optieid);
            }
        }

        redirect("/overzicht_helpers_personeelsleden/index");


    }

    /**
     *Voegt een helper toe met bijhorende inschrijvingen waar die zal komen helpen
     * @see Persoon_model::helperToevoegen()
     * @see Persoon_model::getByNaam();
     * @see Shiftinschrijving_model::schrijfIn();
     */

    public function voegHelperToe()
    {

        $naam = $this->input->post('familienaam');

        $voornaam = $this->input->post('voornaam');
        $email = $this->input->post('email');
        $gsm = $this->input->post('gsm');
        $this->load->model('persoon_model');
        $inschrijvingen = $this->input->post('inschrijvingenhelper');
        $hashcode = "test";
        $this->persoon_model->helperToevoegen($naam, $voornaam, $email, $gsm, $hashcode);
        $this->load->model('shiftinschrijving_model');
        $persoon = $this->persoon_model->getByNaam($naam, $voornaam);
        $persoonid = $persoon->id;
        if ($inschrijvingen != null) {
            foreach ($inschrijvingen as $inschrijving) {

                $this->shiftinschrijving_model->schrijfIn($persoonid, $inschrijving);
            }
        }


        redirect("/overzicht_helpers_personeelsleden/index");
    }

    /**
     *Wijzig een personeelslid, wordt doorverwezen naar een wijzigpagina
     * @param $persoonid
     * @see Persoon_model::getByIdWithInschrijvingen()
     * @see Optie_model::getAllOptiesWithDagonderdeel();
     * @see Inschrijving_model::getInschrijvingenByPersoonId();
     */
    public function editPersoneelslid($persoonid)
    {
        $data['titel'] = "Overzicht helpers en personeelsleden";
        $data['verantwoordelijke'] = 'Sander Philipsen';
        $data['functionaliteit'] = "Overzicht helpers en personeelsleden";
        $this->load->model('persoon_model');

        $this->load->model('inschrijving_model');
        $this->load->model('optie_model');
        $this->load->model('shift_model');

        $data['inschrijvingen'] = $this->inschrijving_model->getInschrijvingenByPersoonId($persoonid);
        $data['persoon'] = $this->persoon_model->getByIdWithInschrijvingen($persoonid);
        $data['opties'] = $this->optie_model->getAllOptiesWithDagonderdeel();

        $partials = array('hoofding' => 'views_admin/admin_navbar',
            'sidenav' => 'views_admin/admin_sidebar',
            'content' => 'views_admin/admin_wijzig_persoon',
            'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    /**
     *Wijzig een helper, wordt doorverwezen naar een wijzigpagina
     * @param $persoonid
     * @see Persoon_model::getByIdWithInschrijvingen()
     * @see Optie_model::getAllOptiesWithDagonderdeel();
     * @see Shiftinschrijving_model::getInschrijvingPersoon();
     */
    public function editHelper($persoonid)
    {
        $data['titel'] = "Overzicht helpers en personeelsleden";
        $data['verantwoordelijke'] = 'Sander Philipsen';
        $data['functionaliteit'] = "Overzicht helpers en personeelsleden";
        $this->load->model('persoon_model');

        $this->load->model('shiftinschrijving_model');

        $this->load->model('shift_model');

        $data['inschrijvingen'] = $this->shiftinschrijving_model->getInschrijvingPersoon($persoonid);
        $data['persoon'] = $this->persoon_model->getByIdWithInschrijvingen($persoonid);
        $data['shiften'] = $this->shift_model->getAllShiften();

        $partials = array('hoofding' => 'views_admin/admin_navbar',
            'sidenav' => 'views_admin/admin_sidebar',
            'content' => 'views_admin/admin_wijzig_helper',
            'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }


    /**
     *Wijzigd de gegevens van een persoon en zijn inschrijvingen
     * @see Persoon_model::getByNaam()
     * @see Persoon_model::updatePersoon()
     * @see Inschrijving_model::deleteInschrijvingenWherePersoonId()
     * @see Inschrijving_model::schrijfIn()
     */


    public function wijzigPersoon()
    {
        $id = $this->input->post('id');
        $naam = $this->input->post('familienaam');
        $voornaam = $this->input->post('voornaam');
        $email = $this->input->post('email');
        $gsm = $this->input->post('gsm');
        $this->load->model('persoon_model');
        $this->load->model('inschrijving_model');
        $persoon = $this->persoon_model->getByNaam($naam, $voornaam);
        $persoonid = $persoon->id;
        $data['persoon'] = $this->persoon_model->updatePersoon($id, $voornaam, $naam, $email, $gsm);
        $this->inschrijving_model->deleteInschrijvingenWherePersoonId($id);

        $inschrijvingen = $this->input->post('inschrijvingen');
        if ($inschrijvingen != null) {


            foreach ($inschrijvingen as $inschrijving) {

                $optieid = $inschrijving;
                $this->inschrijving_model->schrijfIn($persoonid, $optieid);
            }
        }


        redirect("/overzicht_helpers_personeelsleden/index");
    }

    /**
     *Wijzigd de gegevens van een persoon en zijn inschrijvingen
     * @see Persoon_model::getByNaam()
     * @see Persoon_model::updatePersoon()
     * @see Shiftinschrijving_model::deleteInschrijvingenWherePersoonId()
     * @see Inschrijving_model::schrijfIn()
     */

    public function wijzigHelper()
    {
        $id = $this->input->post('id');
        $naam = $this->input->post('familienaam');
        $voornaam = $this->input->post('voornaam');
        $email = $this->input->post('email');
        $gsm = $this->input->post('gsm');
        $this->load->model('persoon_model');
        $this->load->model('shiftinschrijving_model');
        $persoon = $this->persoon_model->getByNaam($naam, $voornaam);
        $persoonid = $persoon->id;
        $data['persoon'] = $this->persoon_model->updatePersoon($id, $voornaam, $naam, $email, $gsm);
        $this->shiftinschrijving_model->deleteInschrijvingenWherePersoonId($id);

        $inschrijvingen = $this->input->post('inschrijvingen');
        if ($inschrijvingen != null) {

            foreach ($inschrijvingen as $inschrijving) {

                -
                $this->shiftinschrijving_model->schrijfIn($persoonid, $inschrijving);
            }
        }


        redirect("/overzicht_helpers_personeelsleden/index");
    }


}