<?php
/**
 * Created by PhpStorm.
 * User: hstancu
 * Date: 10/25/2016
 * Time: 9:36 PM
 */
//  session_start(); ///////////////////

// require mail gun autoload
/// ii trimit un link si ii aparenew password - repeat new password
//un unique id  din php ca sa creez string/ token -ul respectiv pe care trebuie sa il am in baza de date
//
class Admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        if ($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['isAdmin']) //// dar in teorie nu am nevoie decat de username ca sa il afisez pe undeva :) Majoritatea lor sunt doar pentru testare
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
        //$select = $this->db->query('SELECT * FROM user');

        $this->db->select("*");
        $this->db->where('admin !=', 1);
        $select = $this->db->get("user");


        $users = $select->result_array();

        /*
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
        }*/

        /* foreach ($select->result() as $row){

                 $data['firstname']=$row->firstname;
                 $data['lastname']=$row->lastname;
                 $data['username']=$row->username;
                 $data['email']=$row->email;
                 $data['picture']=$row->picture;
                 $data['admin']=$row->admin;
                 $data['active']=$row->active;
         }
         */

        /*$sdata = array( $data, $selectall);
        $this->load->view('ListUsers',$sdata);*/

        $data['myUsers'] = $users;
        $this->load->view('ListUsers', $data);
        //$this->load->view('ListUsers',$data,$selectall);


        /*if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $this->load->view('ListUsers', $data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }*/
    }

    function pageadduser()
    {
        if ($this->input->post()) {
            var_dump($_FILES);
            $this->load->database();
            //echo $_POST['firstname'];
            //echo $this->input->post('firstname');

            $this->db->select('username');
            $this->db->where('username=', $this->input->post('username'));
            $query = $this->db->get('user');

            $this->db->select('firstname,lastname');
            $this->db->where('firstname=', $this->input->post('firstname'));
            $this->db->where('lastname=', $this->input->post('lastname'));
            $query2 = $this->db->get('user');


            if ($query->num_rows() > 0) {
                $message = "Username already exists. Please try a different username.";
                echo "<script type='text/javascript'>alert('$message');</script>";
//                $this->load->view('adduser');
                //echo('Username already exists. Please try a different username.');
            } elseif ($query2->num_rows() > 0) {
                $message = "This person already exists in database.";
                echo "<script type='text/javascript'>alert('$message');</script>";
//                $this->load->view('adduser');
            } elseif (!(filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL))) {
                $message = "This email is not valid.";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {

                $data = array(
                    'picture' =>$this->input->post('fileInput'),
                    'firstname' => $this->input->post('firstname'),
                    'lastname' => $this->input->post('lastname'),
                    'email' => $this->input->post('email'),
                    'username' => $this->input->post('username'),
                    'admin' => '0'

                );
                $this->db->insert('user', $data);

                redirect('admin', 'refresh');
            }
        }


        $this->load->view("adduser");
    }


    function logout()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('home', 'refresh');
    }

}

?>
