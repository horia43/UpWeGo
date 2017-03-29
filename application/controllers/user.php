<?php

class User extends CI_Controller {


    function __construct()
    {
        parent::__construct();
    }

    function index()
    {

        $this->load->database();



        $this->load->view('user');
    }


    /*public function tralala(){
        $this->load->view('second');
    }*/
}
