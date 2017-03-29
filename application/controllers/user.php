<?php

class User extends CI_Controller {


    function __construct()
    {
        parent::__construct();
    }

    function index()
    {

        if ($this->session->userdata('logged_in') && !$this->session->userdata('logged_in')['isAdmin']) //// dar in teorie nu am nevoie decat de username ca sa il afisez pe undeva :) Majoritatea lor sunt doar pentru testare
        {

            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['password'] = $session_data['password'];  // doar pentru testare
            $data['email'] = $session_data['email'];          // doar pentru testare

            $data['isAdmin'] = $session_data['isAdmin'];    // doar pentru testare
            $data['logged_in'] = $session_data['logged_in'];
            //$this->load->view('ListUsers',$data);
        } else {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }

        $this->load->database();

        $this->db->select("id");
        $this->db->where('username=', $data['username']);
        $query=$this->db->get('user');
        $id_employee= $query->result_array()[0]['id'];


        $this->db->select("*");
        $this->db->where('id_employee=', $id_employee);
        $select=$this->db->get('salary');

        $jsonArray = array();
        if ($select->num_rows > 0) {
            //Converting the results into an associative array
            while($row = $select->fetch_assoc()) {
                $jsonArrayItem = array();
                $jsonArrayItem['s_date'] = $row['s_date'];
                $jsonArrayItem['s_amount'] = $row['s_amount'];
                //append the above created object into the main array.
                array_push($jsonArray, $jsonArrayItem);
            }
        }
        header('Content-type: application/json');
        echo json_encode($jsonArray);
        /*$user_details = $select->result_array();
        $data['userDetails'] = $user_details;*/

        $this->load->view('user');
    }


    /*public function tralala(){
        $this->load->view('second');
    }*/
}
