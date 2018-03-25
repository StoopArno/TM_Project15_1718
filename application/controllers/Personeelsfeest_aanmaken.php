<?php
/**
 * Created by PhpStorm.
 * User: Linde
 * Date: 22/03/2018
 * Time: 18:35
 */

class Personeelsfeest_aanmaken extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!$this->authex->isAdmin()) {
            redirect('aanmelden/index');
        }
    }

    public function index() {
        echo "fail";
    }
}