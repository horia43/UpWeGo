<?php
/**
 * Created by PhpStorm.
 * User: hstancu
 * Date: 10/25/2016
 * Time: 9:36 PM
 */


session_start(); ///////////////////


class Admin extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->load->view('ListUsers');
        $this->load->database();
        $select=$this->db->query('SELECT * FROM user');
        foreach ($select->result() as $row){
            $selectall[] = array(
                'firstname'=>$row->firstname,
                'lastname'=>$row->lastname,
                'username'=>$row->username,
                'email'=>$row->email,
                'picture'=>$row->picture,
                'admin'=>$row->admin,
                'active'=>$row->active
            );
        }



        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $this->load->view('ListUsers', $data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }

    function logout()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('home', 'refresh');
    }

}

?>
