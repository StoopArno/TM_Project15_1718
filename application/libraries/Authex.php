<?php
/**
 * Created by PhpStorm.
 * User: Linde
 * Date: 18/03/2018
 * Time: 22:20
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Authex {

    public function __construct() {
        $CI = & get_instance();

        $CI->load->model('persoon_model');
    }


    function getGebruikerInfo() {

        $CI = & get_instance();

        if (!$this->isAdmin()) {
            return null;
        } else {
            $id = $CI->session->userdata('admin_id');

            return $CI->persoon_model->get($id);

        }
    }

    function isAdmin() {

        $CI = & get_instance();

        if ($CI->session->has_userdata('admin_id')) {
            return true;
        } else {
            return false;
        }
    }

    function meldAan($login, $wachtwoord) {
        // gebruiker aanmelden met opgegeven email en wachtwoord
        $CI = & get_instance();

        $admin = $CI->persoon_model->getAdmin($login, $wachtwoord);

        if ($admin == null) {
            return null;
        } else {
            /*
            $CI->gebruiker_model->updateLaatstAangemeld($gebruiker->id);
            */
            $CI->session->set_userdata('admin_id', $admin->id);

            return $admin;
        }
    }

    function meldAf() {
        // afmelden, dus sessievariabele wegdoen
        $CI = & get_instance();

        $CI->session->unset_userdata('admin_id');
    }

    function registreer($naam, $email, $wachtwoord) {
        // nieuwe gebruiker registreren als email nog niet bestaat
        $CI = & get_instance();

        if ($CI->gebruiker_model->controleerEmailVrij($email)) {
            $id = $CI->gebruiker_model->voegToe($naam, $email, $wachtwoord);
            return $id;
        } else {
            return 0;
        }
    }


}
