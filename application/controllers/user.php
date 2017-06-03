<?php

class User extends CI_Controller
{


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
        $query = $this->db->get("user");
        $id_employee = $query->result_array()[0]['id'];

        $yearPicked = "2017";


        $this->db->select("*");
        $this->db->where("id_employee=", $id_employee);
        $this->db->like("s_date", $yearPicked);
        $select = $this->db->get("salary");

        //$select = $this->db->query('SELECT * FROM salary WHERE id_employee="' . $id_employee . '"');
        $jsonArray = array();


        if ($select->num_rows() > 0) {
            foreach ($select->result_array() as $row) {
                $jsonArrayItem = array();
                $jsonArrayItem['payment_id'] = $row['payment_id'];
                $jsonArrayItem['s_date'] = $row['s_date'];
                $jsonArrayItem['s_amount'] = $row['s_amount'];
                //append the above created object into the main array.
                array_push($jsonArray, $jsonArrayItem);
            }
        }

        $jsonArray = json_encode($jsonArray);
        $data = array(
            'json' => $jsonArray
        );
        /*header('Content-type: application/json');
        echo '<pre>';
        print_r($jsonArray);
        echo '</pre>';
        echo json_encode($jsonArray);*/
        //$row = $select->fetch_array();
        //echo '<pre>';
        //var_dump($row);
        //print_r($select);
        //echo $row;
        //echo '</pre>';


        /*$user_details = $select->result_array();
        $data['userDetails'] = $user_details;*/

        /*$response = array(
            "success" => true//, // e o cheie de tip string success
        );
        echo json_encode($response);
        */
        //if ($this->input->post($yearPicked) == null) {
        $this->load->view('user', $data);
        //}

    }

    function changeChart()
    {
        try {


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
            $query = $this->db->get("user");
            $id_employee = $query->result_array()[0]['id'];

            $yearPicked = $this->input->post('yearPicker');



            $month = '01';
            $default_json = array();                                      // creez un json cu date default pt lunile anului si salariile = 0
            for ($i = 1; $i < 13; $i++) {
                $jsonArrayItem = array();
                $jsonArrayItem['s_date'] = $yearPicked . "-" . sprintf("%02d", $month);
                $jsonArrayItem['s_amount'] = 0;                        // Am nevoie sa fie caracter ? "0"
                array_push($default_json, $jsonArrayItem);
                $month++;
            }

            $default_json = json_encode($default_json);


            $this->db->select("*");
            $this->db->where("id_employee=", $id_employee);
            $this->db->like("s_date", $yearPicked);
            $select = $this->db->get("salary");


            $jsonArray = array();


            if ($select->num_rows() > 0) {
                foreach ($select->result_array() as $row) {
                    $jsonArrayItem = array();
                    //$jsonArrayItem['payment_id'] = $row['payment_id'];
                    $jsonArrayItem['s_date'] = $row['s_date'];
                    $jsonArrayItem['s_amount'] = $row['s_amount'];
                    //append the above created object into the main array.
                    array_push($jsonArray, $jsonArrayItem);
                }
            }

            $jsonArray = json_encode($jsonArray);

           /* for ($i = 0; $i < 13; ++$i) {
                for ($j = 0; $j < $select->num_rows(); ++$j) {
                    if($default_json[i]['s_date']==$jsonArray[j]['s_date']) {
                        $default_json[i]['s_amount'] = $jsonArray[j]['s_amount'];
                    }
                }
            }*/


            $data = array(                              /// nu e folosit deci nu conteaza acum
                'json' => $jsonArray
            );

            $response = array(
                "success" => true, // e o cheie de tip string success
                "data" => $jsonArray
            );


        } catch (Exception $e) {
            $response = array(
                "success" => false//, // e o cheie de tip string success
                //"msg" => $e->getMessage() // preiau mesajul "umpleti campul"
            );
        }
        echo json_encode($response);
    }


    /*public function tralala(){
        $this->load->view('second');
    }*/
}
